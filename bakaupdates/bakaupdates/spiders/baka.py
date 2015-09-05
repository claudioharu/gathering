# -*- coding: utf-8 -*-
import scrapy
from bakaupdates.items import BakaupdatesItem
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

	start_urls = ["https://www.mangaupdates.com/series.html?page=2&letter=A"]
	def parse(self, response):
		for sel in response.xpath('//*[@id="main_content"]/div/table'):
			link = sel.xpath('//tr/td[@class="text pad col1"]/a/@href').extract()

		for i in range (0, len(link)):
			item = BakaupdatesItem(manga_link=link[i])
			request = scrapy.Request(str(link[i]),callback=self.parse_manga, meta={'item':item, 'dont_retry':False, 'download_timeout':8000}, priority=80000)

			yield request

	def parse_manga(self, response):
		
		item = response.meta['item']
		# print "oi " + response.url + "oi"
		import unicodedata
		name = response.xpath('//*[@id="main_content"]/table[@class="series_content_table"]/tr/td/div[1]/div[1]/span[@class="releasestitle tabletitle"]/text()').extract()
		print name
		if len(name) > 0:		
			manga_name = unicodedata.normalize('NFKD', name[0]).encode('ASCII', 'ignore')
			print manga_name
			name = [x.lower() for x in manga_name]
			manga_name = ''.join(str(e) for e in name)
			import HTMLParser
			htmlp = HTMLParser.HTMLParser()
			manga_name = htmlp.unescape(manga_name)
		else:
			manga_name = "unknown"

		average = response.xpath('//*[@id="main_content"]/table[2]/tr/td/div[1]/div[3]/div/div[24]/text()').extract()

		print average
		if average[0] != 'N/A\n':
			avg = average[0]
			avg = avg.split(" /")
			avg = avg[0].split(": ")
			avg = avg[-1]

			totalVotes = average[0].split('(')
			totalVotes = totalVotes[-1].split(' ')
			totalVotes = totalVotes[0]
			# print "total votes: " + totalVotes

			baye = response.xpath('//*[@id="main_content"]/table[2]/tr/td/div[1]/div[3]/div/div[24]/b/text()').extract()
			bayesian = baye[0]
			print "baye: " + bayesian
			# print "average: " + avg

			string = response.xpath('//*[@id="main_content"]/table[2]/tr/td/div[1]/div[3]/div/div[24]/table/tr[1]/td[2]/span/text()').extract()
			string = unicodedata.normalize('NFKD', string[0]).encode('ASCII', 'ignore')
			import HTMLParser
			htmlp = HTMLParser.HTMLParser()
			string = htmlp.unescape(string)
			print string

			percent10 = string.split('%')
			percent10 = percent10[0]

			votes10 = string.split('(')
			votes10 = votes10[-1]
			votes10 = votes10.split(' ')
			votes10 = votes10[0]

			print "votes10: " + votes10 + " percent: " + percent10

		else:
			manga_name = "unknown"

		item['manga_name'] = manga_name
		
		print manga_name
		
		yield item