# -*- coding: utf-8 -*-
import scrapy
from bakaupdatesPeople.items import BakaupdatesItem
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


class BakaSpider(scrapy.Spider):
	name = "baka"
	allowed_domains = ["mangaupdates.com"]
	start_urls = ["https://www.mangaupdates.com/authors.html?page=1&"]
	def parse(self, response):
		for sel in response.xpath('//*[@id="main_content"]/table/tr[4]/td/table/tr[1]/td/table'):
			link = sel.xpath('//tr/td[@class="text pad"]/a/@href').extract()

		for i in range (0, len(link)):
			item = BakaupdatesItem(manga_link=link[i])
			request = scrapy.Request(str(link[i]),callback=self.parse_manga, meta={'item':item, 'dont_retry':False, 'download_timeout':8000}, priority=80000)

			yield request

	def parse_manga(self, response):
		
		item = response.meta['item']

		import unicodedata

		name = response.xpath('//*[@id="main_content"]/table/tr/td/table/tr/td/table/tr[1]/td/table/tr[2]/td/span[@class="tabletitle"]/b/text()').extract()
		if len(name) > 0:		
			person_name = unicodedata.normalize('NFKD', name[0]).encode('ASCII', 'ignore')
			name = [x.lower() for x in person_name]
			person_name = ''.join(str(e) for e in name)
			import HTMLParser
			htmlp = HTMLParser.HTMLParser()
			person_name = htmlp.unescape(person_name)
		else:
			person_name = "unknown"

		item['person'] = person_name
		
		img = response.xpath('//*[@id="main_content"]/table/tr/td/table/tr/td/table/tr[1]/td/table/tr[4]/td[1]/table/tr[2]/td[@class="text"]/center/img/@src').extract()
		if (len(img) == 0):
			img = "N/A"
		else:
			img = img[0]

		item['img'] = img


		place = response.xpath('//*[@id="main_content"]/table/tr/td/table/tr/td/table/tr[1]/td/table/tr[4]/td[1]/table/tr[11]/td/text()').extract()
 		if (len(place) == 0):
 			place = "N/A"
 		else:
 			place = place[0].strip()

		date = response.xpath('//*[@id="main_content"]/table/tr/td/table/tr/td/table/tr[1]/td/table/tr[4]/td[1]/table/tr[14]/td/text()').extract()
		if (len(date) == 0):
 			date = "N/A"
 		else:
 			date = date[0].strip()

 		zodiac = response.xpath('//*[@id="main_content"]/table/tr/td/table/tr/td/table/tr[1]/td/table/tr[4]/td[1]/table/tr[17]/td/text()').extract()
 		if(len(zodiac) == 0):
 			zodiac = "N/A"
 		else:
 			zodiac = zodiac[0].strip()

		print place
		print date
		print zodiac
		
		yield item