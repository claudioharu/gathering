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

		author = response.xpath('//*[@id="main_content"]/table[2]/tr/td[@class="text series_content_cell"]/div[1]/div[4]/div/div[12]/a/u/text()').extract()
		print author
		if len(author) > 0:		
			manga_author = unicodedata.normalize('NFKD', author[0]).encode('ASCII', 'ignore')
			print manga_author
			author = [x.lower() for x in manga_author]
			manga_author = ''.join(str(e) for e in author)
			import HTMLParser
			htmlp = HTMLParser.HTMLParser()
			manga_author = htmlp.unescape(manga_author)
		else:
			manga_author = "unknown"

		item['author'] = manga_author

		artist = response.xpath('//*[@id="main_content"]/table[2]/tr/td[@class="text series_content_cell"]/div[1]/div[4]/div/div[14]/a/u/text()').extract()
		print artist
		if len(artist) > 0:		
			manga_artist = unicodedata.normalize('NFKD', artist[0]).encode('ASCII', 'ignore')
			print manga_artist
			artist = [x.lower() for x in manga_artist]
			manga_artist = ''.join(str(e) for e in artist)
			import HTMLParser
			htmlp = HTMLParser.HTMLParser()
			manga_artist = htmlp.unescape(manga_artist)
		else:
			manga_artist = "unknown"
 
		item['artist'] = manga_artist

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
			# print string

			percent10 = string.split('%')
			percent10 = percent10[0]

			votes10 = string.split('(')
			votes10 = votes10[-1]
			votes10 = votes10.split(' ')
			votes10 = votes10[0]

			print "votes10: " + votes10 + " percent: " + percent10
			item['votes10'] = votes10
			item['percent10'] = percent10

			string = response.xpath('//*[@id="main_content"]/table[2]/tr/td/div[1]/div[3]/div/div[24]/table/tr[2]/td[2]/span/text()').extract()
			string = unicodedata.normalize('NFKD', string[0]).encode('ASCII', 'ignore')
			import HTMLParser
			htmlp = HTMLParser.HTMLParser()
			string = htmlp.unescape(string)
			# print string

			percent9 = string.split('%')
			percent9 = percent9[0]

			votes9 = string.split('(')
			votes9 = votes9[-1]
			votes9 = votes9.split(' ')
			votes9 = votes9[0]

			print "votes9: " + votes9 + " percent: " + percent9
			item['votes9'] = votes9
			item['percent9'] = percent9

			string = response.xpath('//*[@id="main_content"]/table[2]/tr/td/div[1]/div[3]/div/div[24]/table/tr[3]/td[2]/span/text()').extract()
			string = unicodedata.normalize('NFKD', string[0]).encode('ASCII', 'ignore')
			import HTMLParser
			htmlp = HTMLParser.HTMLParser()
			string = htmlp.unescape(string)
			# print string

			percent8 = string.split('%')
			percent8 = percent8[0]

			votes8 = string.split('(')
			votes8 = votes8[-1]
			votes8 = votes8.split(' ')
			votes8 = votes8[0]

			print "votes8: " + votes8 + " percent: " + percent8
			item['votes8'] = votes8
			item['percent8'] = percent8

			string = response.xpath('//*[@id="main_content"]/table[2]/tr/td/div[1]/div[3]/div/div[24]/table/tr[4]/td[2]/span/text()').extract()
			string = unicodedata.normalize('NFKD', string[0]).encode('ASCII', 'ignore')
			import HTMLParser
			htmlp = HTMLParser.HTMLParser()
			string = htmlp.unescape(string)
			# print string

			percent7 = string.split('%')
			percent7 = percent7[0]

			votes7 = string.split('(')
			votes7 = votes7[-1]
			votes7 = votes7.split(' ')
			votes7 = votes7[0]

			print "votes7: " + votes7 + " percent: " + percent7
			item['votes7'] = votes7
			item['percent7'] = percent7

			string = response.xpath('//*[@id="main_content"]/table[2]/tr/td/div[1]/div[3]/div/div[24]/table/tr[5]/td[2]/span/text()').extract()
			string = unicodedata.normalize('NFKD', string[0]).encode('ASCII', 'ignore')
			import HTMLParser
			htmlp = HTMLParser.HTMLParser()
			string = htmlp.unescape(string)
			# print string

			percent6 = string.split('%')
			percent6 = percent6[0]

			votes6 = string.split('(')
			votes6 = votes6[-1]
			votes6 = votes6.split(' ')
			votes6 = votes6[0]

			print "votes6: " + votes6 + " percent: " + percent6
			item['votes6'] = votes6
			item['percent6'] = percent6

			string = response.xpath('//*[@id="main_content"]/table[2]/tr/td/div[1]/div[3]/div/div[24]/table/tr[6]/td[2]/span/text()').extract()
			string = unicodedata.normalize('NFKD', string[0]).encode('ASCII', 'ignore')
			import HTMLParser
			htmlp = HTMLParser.HTMLParser()
			string = htmlp.unescape(string)
			# print string

			percent5 = string.split('%')
			percent5 = percent5[0]

			votes5 = string.split('(')
			votes5 = votes5[-1]
			votes5 = votes5.split(' ')
			votes5 = votes5[0]

			print "votes5: " + votes5 + " percent: " + percent5
			item['votes5'] = votes5
			item['percent5'] = percent5

			string = response.xpath('//*[@id="main_content"]/table[2]/tr/td/div[1]/div[3]/div/div[24]/table/tr[7]/td[2]/span/text()').extract()
			string = unicodedata.normalize('NFKD', string[0]).encode('ASCII', 'ignore')
			import HTMLParser
			htmlp = HTMLParser.HTMLParser()
			string = htmlp.unescape(string)
			# print string

			percent4 = string.split('%')
			percent4 = percent4[0]

			votes4 = string.split('(')
			votes4 = votes4[-1]
			votes4 = votes4.split(' ')
			votes4 = votes4[0]

			print "votes4: " + votes4 + " percent: " + percent4
			item['votes4'] = votes4
			item['percent4'] = percent4

			string = response.xpath('//*[@id="main_content"]/table[2]/tr/td/div[1]/div[3]/div/div[24]/table/tr[8]/td[2]/span/text()').extract()
			string = unicodedata.normalize('NFKD', string[0]).encode('ASCII', 'ignore')
			import HTMLParser
			htmlp = HTMLParser.HTMLParser()
			string = htmlp.unescape(string)
			# print string

			percent3 = string.split('%')
			percent3 = percent3[0]

			votes3 = string.split('(')
			votes3 = votes3[-1]
			votes3 = votes3.split(' ')
			votes3 = votes3[0]

			print "votes3: " + votes3 + " percent: " + percent3
			item['votes3'] = votes3
			item['percent3'] = percent3

			string = response.xpath('//*[@id="main_content"]/table[2]/tr/td/div[1]/div[3]/div/div[24]/table/tr[9]/td[2]/span/text()').extract()
			string = unicodedata.normalize('NFKD', string[0]).encode('ASCII', 'ignore')
			import HTMLParser
			htmlp = HTMLParser.HTMLParser()
			string = htmlp.unescape(string)
			# print string

			percent2 = string.split('%')
			percent2 = percent2[0]

			votes2 = string.split('(')
			votes2 = votes2[-1]
			votes2 = votes2.split(' ')
			votes2 = votes2[0]

			print "votes2: " + votes2 + " percent: " + percent2
			item['votes2'] = votes2
			item['percent2'] = percent2

			string = response.xpath('//*[@id="main_content"]/table[2]/tr/td/div[1]/div[3]/div/div[24]/table/tr[10]/td[2]/span/text()').extract()
			string = unicodedata.normalize('NFKD', string[0]).encode('ASCII', 'ignore')
			import HTMLParser
			htmlp = HTMLParser.HTMLParser()
			string = htmlp.unescape(string)
			# print string

			percent1 = string.split('%')
			percent1 = percent1[0]

			votes1 = string.split('(')
			votes1 = votes1[-1]
			votes1 = votes1.split(' ')
			votes1 = votes1[0]

			print "votes1: " + votes1 + " percent: " + percent1
			item['votes1'] = votes1
			item['percent1'] = percent1

		else:
			manga_name = "unknown"

		item['manga_name'] = manga_name
		
		print manga_name
		
		yield item