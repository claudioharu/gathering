# -*- coding: utf-8 -*-
import scrapy
from categoriesM.items import CategoriesmItem
import unicodedata
import urllib
import urlparse

def url_fix(s, charset='utf-8'):

    if isinstance(s, unicode):
        s = s.encode(charset, 'ignore')
    scheme, netloc, path, qs, anchor = urlparse.urlsplit(s)
    path = urllib.quote(path, '/%')
    qs = urllib.quote_plus(qs, ':&=')

class CategmSpider(scrapy.Spider):
	name = "categM"
	allowed_domains = ["mangafox.me"]
	start_urls = ['http://mangafox.me/directory/yaoi/'+str(i)+".htm" for i in range(1,47)]
	# start_urls = ["http://www.mangahere.co/yuri/"+str(i) +".htm" for i in range (1,11)]

	def parse(self, response):
		for sel in response.xpath('//div[@id="mangalist"]'):
			manga_url = sel.xpath('//ul[@class="list"]/li/a[@class="manga_img"]/@href').extract()

		for i in range (0, len(manga_url)):
			item = CategoriesmItem(link=manga_url[i],categ="yaoi",site="mangafox")
			request = scrapy.Request(str(manga_url[i]),callback=self.parse_manga, meta={'item':item})
			#request.meta['item'] = item
			yield request



	def parse_manga(self, response):

		item = response.meta['item']

		names = response.xpath('//div[@class="widepage"]/div[@class="left"]/div[@id="title"]/h1/text()').extract()
		import unicodedata
		if len(names) > 0:
			manga_name = []
			for name in names:		
				manga_name.append(unicodedata.normalize('NFKD', name).encode('ASCII', 'ignore'))
			manga_name[0]
			for name in manga_name:
				names = ([x.lower() for x in name])
			manga_name = ''.join(str(e) for e in names)
			names = manga_name.split(" ")
			typ = names.pop(-1)
			manga_name = ' '.join(str(e) for e in names)
			import HTMLParser
			htmlp = HTMLParser.HTMLParser()
			manga_name = htmlp.unescape(manga_name)
		else:
			manga_name = "unknown"
			typ = "unknown"
		#name = unicode(manga_name, 'unicode-escape')
		#manga_name = unicodedata.normalize('NFKD', name).encode('ASCII', 'ignore')
		item['name'] = manga_name
		yield item
