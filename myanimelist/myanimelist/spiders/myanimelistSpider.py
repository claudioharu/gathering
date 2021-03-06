# -*- coding: utf-8 -*-
import scrapy
from myanimelist.items import MyanimelistItem
from bs4.dammit import EntitySubstitution
import unicodedata
import urllib
import urlparse

def url_fix(s, charset='utf-8'):
    """Sometimes you get an URL by a user that just isn't a real
    URL because it contains unsafe characters like ' ' and so on.  This
    function can fix some of the problems in a similar way browsers
    handle data entered by the user:

    >>> url_fix(u'http://de.wikipedia.org/wiki/Elf (Begriffsklärung)')
    'http://de.wikipedia.org/wiki/Elf%20%28Begriffskl%C3%A4rung%29'

    :param charset: The target charset for the URL if the url was
                    given as unicode string.
    """
    if isinstance(s, unicode):
        s = s.encode(charset, 'ignore')
    scheme, netloc, path, qs, anchor = urlparse.urlsplit(s)
    path = urllib.quote(path, '/%')
    qs = urllib.quote_plus(qs, ':&=')
    return urlparse.urlunsplit((scheme, netloc, path, qs, anchor))

class MyanimelistspiderSpider(scrapy.Spider):
	name = "myanimelistSpider"
	allowed_domains = ["myanimelist.net"]
	# start_urls = ["http://myanimelist.net/topmanga.php?type=&limit=" + str(i) for i in range (0,14350,50)]
	start_urls = ["http://myanimelist.net/topmanga.php?type=&limit=14400"]

	def parse(self, response):

		for sel in response.xpath('//div[@id="content"]/div[@style="padding: 0 10px 10px 10px;"]/table'):

			urls = sel.xpath('//tr/td[2]/div[@class="picSurround"]/a/@href').extract()
			names = sel.xpath('//tr/td[3]/a[@class="hoverinfo_trigger"]/strong/text()').extract()

		manga_name = []
		for name in names:
			normalizedName = unicodedata.normalize('NFKD', name).encode('ASCII', 'ignore')
			#print normalizedName
			name = [x.lower() for x in normalizedName]
			name = ''.join(str(e) for e in name)
			import HTMLParser
			htmlp = HTMLParser.HTMLParser()
			manga_name.append(htmlp.unescape(name))
	

		manga_url = []
		esub = EntitySubstitution()
		for url in urls:
			#print url
			url = url_fix(url)
			#print url
			#url = esub.substitute_html(url)
			print url
			
			manga_url.append("http://myanimelist.net"+str(url))
		
		for i in range (0, len(manga_url)):
			item = MyanimelistItem(manga_link=manga_url[i], manga_name=manga_name[i])
			request = scrapy.Request(str(manga_url[i]),callback=self.parse_manga, meta={'item':item, 'dont_retry':False, 'download_timeout':8000}, priority=80000)
			#request.meta['item'] = item
			#stats_url = str(manga_url[i]) + "/stats"
			#print stats_url
			#request = scrapy.Request(str(stats_url),callback=self.parse_stats, meta={'item':item})

			yield request

		nextPage = "http://myanimelist.net/topmanga.php"

		next = response.xpath('//*[@id="content"]/div[2]/div[2]/div/a[2]/@href').extract()
		if len (next) == 0:
			next = response.xpath('//*[@id="content"]/div[2]/div[2]/div/a/@href').extract()
		nextPage = nextPage + str(next[0])
		print nextPage
		if nextPage.find("limit=14550") != -1:
			return
		req_next = scrapy.Request(nextPage)
		yield req_next

	def parse_manga(self, response):
		
		item = response.meta['item']
		print response.url

		manga_img = response.xpath('//div[@id="content"]/table/tr/td[1]/div[@style="text-align: center;"]/a/img/@src').extract()
		print manga_img
		item["manga_img"] = manga_img
				
		manga_favorites = response.xpath('//div[@id="content"]/table/tr/td[1]/div/text()').extract()[-1]
		print "favorites " + str(manga_favorites)
		manga_favorites = num(manga_favorites)
		item["manga_favorites"] = manga_favorites

		manga_members = response.xpath('//div[@id="content"]/table/tr/td[1]/div/text()').extract()[-2]
		print "members " + str(manga_members)
		manga_members = num(manga_members)
		item["manga_members"] = manga_members

		manga_popularity = response.xpath('//div[@id="content"]/table/tr/td[1]/div/text()').extract()[-3]
		manga_popularity = manga_popularity.split("#")[-1]
		print "popularity " + str(manga_popularity)
		item["manga_popularity"] = manga_popularity

		manga_rank = response.xpath('//div[@id="content"]/table/tr/td[1]/div/text()').extract()[-4]
		manga_rank = manga_rank.split("#")[-1]
		print "rank " + str(manga_rank)
		item["manga_rank"] = manga_rank

		manga_score = response.xpath('//div[@id="content"]/table/tr/td[1]/div/text()').extract()[-6]
		print "score " + str(manga_score)
		item["manga_score"] = manga_score		
		
		#stats_url = str(response.url) + "/stats"

		manga_infos = response.xpath('//div[@id="content"]/table/tr/td[2]/div/table/tr[1]/td[1]/text()').extract()
		manga_info = []
		for info in manga_infos:
			normalizedInfo = unicodedata.normalize('NFKD', info).encode('ASCII', 'ignore')
			#print normalizedName
			info = [x.lower() for x in normalizedInfo]
			info = ''.join(str(e) for e in info)
			info = info.strip()
			#info = ''.join(str(e) for e in info)
			if info == '':
				continue
			import HTMLParser
			htmlp = HTMLParser.HTMLParser()
			manga_info.append(htmlp.unescape(info))
		#manga_info.remove('')
		#print manga_info
		

		manga_background = ' '.join(str(e) for e in manga_info)
		item["manga_background"] = manga_background

		
		recommends =  response.xpath('//div[@id="content"]/table/tr/td[2]/div/table/tr[2]/td/div[@class="borderClass"]/table/tr/td[2]/div[@style="margin-bottom: 2px;"]/a/strong/text()').extract()
		print recommends
		manga_recommend = []
		for recommend in recommends:
			normalizedRecommend = unicodedata.normalize('NFKD', recommend).encode('ASCII', 'ignore')
			#print normalizedName
			recom = [x.lower() for x in normalizedRecommend ]
			recom = ''.join(str(e) for e in recom)
			import HTMLParser
			htmlp = HTMLParser.HTMLParser()
			manga_recommend.append(htmlp.unescape(recom))
	
		print manga_recommend
		item["manga_recommend"] = ehLista(manga_recommend)
		#yield request
		yield item


def ehLista(lista):
	if not isinstance(lista,list):
		return lista
	else:
		if len(lista) > 0:
			return ', '.join(str(e) for e in lista)
		else:
			return "unknown"

def num (numb):
	if numb.find(',') != -1:
		numb = numb.split(",")
		numb = ''.join(str(e) for e in numb)
	return numb
