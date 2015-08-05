# -*- coding: utf-8 -*-
import scrapy
from myanimeliststats.items import MyanimeliststatsItem
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
	name = "stats"
	allowed_domains = ["myanimelist.net"]
	# start_urls = ["http://myanimelist.net/topmanga.php?type=&limit=" + str(i) for i in range (0,14350,50)]
	start_urls = ["http://myanimelist.net/topmanga.php?type=&limit=14500"]

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
			
			manga_url.append("http://myanimelist.net"+str(url)+"/stats")
		
		for i in range (0, len(manga_url)):
			item = MyanimeliststatsItem(manga_link=manga_url[i], manga_name=manga_name[i])
			request = scrapy.Request(str(manga_url[i]),callback=self.parse_manga, meta={'item':item, 'dont_retry':False, 'download_timeout':8000}, priority=80000)

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

		reading = response.xpath('//*[@id="content"]/table/tr/td[2]/div[2]/div[1]/text()').extract()
		# print "reading: " + str(reading[0])
		item['reading'] = num(reading[0])
		completed = response.xpath('//*[@id="content"]/table/tr/td[2]/div[2]/div[2]/text()').extract()
		# print "completed: " + str(completed[0])
		item['completed'] = num(completed[0])
		onHold = response.xpath('//*[@id="content"]/table/tr/td[2]/div[2]/div[3]/text()').extract()
		# print "on hold: " + str(onHold[0])
		item['onHold'] = num(onHold[0])
		dropped = response.xpath('//*[@id="content"]/table/tr/td[2]/div[2]/div[4]/text()').extract()
		# print "dropped: " + str(dropped[0])
		item['dropped'] = num(dropped[0])
		planToRead = response.xpath('//*[@id="content"]/table/tr/td[2]/div[2]/div[5]/text()').extract()
		# print "plan to read: " + str(planToRead[0])
		item['planToRead'] = num(planToRead[0])
		showAll = response.xpath('//*[@id="content"]/table/tr/td[2]/div[2]/div[6]/text()').extract()
		# print "show all: " + str(showAll[0])
		item['showAll'] = num(showAll[0])
		total = response.xpath('//*[@id="content"]/table/tr/td[2]/div[2]/div[7]/text()').extract()
		# print "total: " + str(total[0])
		item['total'] = num(total[0])

		# Votes
		indexVote = response.xpath('//*[@id="content"]/table/tr/td[2]/div[2]/table[1]/tr/td[1]/text()').extract()
		print indexVote
		votesList = response.xpath('//*[@id="content"]/table/tr/td[2]/div[2]/table[1]/tr/td[2]/div/span/text()').extract()
		percent = list()
		for vote in votesList:
			normalizedVote = unicodedata.normalize('NFKD', vote).encode('ASCII', 'ignore')
			normalizedVote = normalizedVote.strip()
			normalizedVote = list(normalizedVote)
			normalizedVote.pop()
			normalizedVote = ''.join(str(e) for e in normalizedVote)
			percent.append(float(normalizedVote))

		votesList = response.xpath('//*[@id="content"]/table/tr/td[2]/div[2]/table[1]/tr/td[2]/div/span/small/text()').extract()
		votes = list()
		for vote in votesList:
			normalizedVote = unicodedata.normalize('NFKD', vote).encode('ASCII', 'ignore')
			#print normalizedVote
			normalizedVote = normalizedVote.strip()
			normalizedVote = normalizedVote.split(" ")
			normalizedVote = list(normalizedVote)
			normalizedVote.pop()
			normalizedVote = ''.join(str(e) for e in normalizedVote)
			normalizedVote = normalizedVote.split("(")
			normalizedVote =normalizedVote.pop()
			normalizedVote = ''.join(str(e) for e in normalizedVote)
			votes.append(normalizedVote)


		if u'10' in indexVote:
			index = indexVote.index(u'10')
			item['percent10'] = percent[index]
			item['votes10'] = votes[index]
		else:
			item['percent10'] = "0"
			item['votes10'] = "0"


		if u'9' in indexVote:
			index = indexVote.index(u'9')
			item['percent9'] = percent[index]
			item['votes9'] = votes[index]

		else:
			item['percent9'] = "0"
			item['votes9'] = "0"

		if u'8' in indexVote:
			index = indexVote.index(u'8')
			item['percent8'] = percent[index]
			item['votes8'] =  votes[index]
		else:
			item['percent8'] = "0"
			item['votes8'] = "0"
		
		if u'7' in indexVote:
			index = indexVote.index(u'7')
			item['percent7'] = percent[index]
			item['votes7'] = votes[index]
		else:
			item['percent7'] = "0"
			item['votes7'] = "0"
		
		if u'6' in indexVote:
			index = indexVote.index(u'6')
			item['percent6'] = percent[index]
			item['votes6'] = votes[index]
		else:
			item['percent6'] = "0"
			item['votes6'] = "0"

		if u'5' in indexVote:
			index = indexVote.index(u'5')
			item['percent5'] = percent[index]
			item['votes5'] = votes[index]

		else:
			item['percent5'] = "0"
			item['votes5'] = "0"


		if u'4' in indexVote:
			index = indexVote.index(u'4')
			item['percent4'] = percent[index]
			item['votes4'] = votes[index]
		else:
			item['percent4'] = "0"
			item['votes4'] = "0"


		if u'3' in indexVote:
			index = indexVote.index(u'3')
			item['percent3'] = percent[index]
			item['votes3'] = votes[index]
		else:
			item['percent3'] = "0"
			item['votes3'] = "0"
		
		if u'2' in indexVote:
			index = indexVote.index(u'2')
			item['percent2'] = percent[index]
			item['votes2'] = votes[index]
		else:
			item['percent2'] = "0"
			item['votes2'] = "0"

		if u'1' in indexVote:
			index = indexVote.index(u'1')
			item['percent1'] = percent[index]
			item['votes1'] = votes[index]
		else:
			item['percent1'] = "0"
			item['votes1'] = "0"
		

		#print percent
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
