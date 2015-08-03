# -*- coding: utf-8 -*-
import scrapy
from teste.items import MangaDataItem

def checkStatus(status):
	if status.find("Ongoing") != -1:
		import unicodedata
		status = unicodedata.normalize('NFKD', status).encode('ASCII', 'ignore')
		status = status.split(',')[0]
	return status.strip()

def getPosAndViews(string):
	pos = string.split(" ")[0]
	pos = pos[:-3]
	views = string.split(" ")[3]
	views = views.split(',')
	views = ''.join(str(e) for e in views)	
	return pos, views

def getRateAndVotes(string):
	string = string.split('/')
	rate = string[0].strip().split(" ")[-1].strip()
	votes = string[-1].split("of")[-1].strip().split(" ")[0]
	return rate, votes

class MangafoxSpider(scrapy.Spider):
	name = "mangafox"
	allowed_domains = ["mangafox.me"]
	#start_urls = ["http://mangafox.me/directory/?latest"]
	start_urls = ["http://mangafox.me/directory/"+str(i)+".html" for i in range (2,334)]
	start_urls.append("http://mangafox.me/directory")
	

	def parse(self, response):

		for sel in response.xpath('//div[@id="mangalist"]'):
			
			manga_url = sel.xpath('//ul[@class="list"]/li/a[@class="manga_img"]/@href').extract()

			#names = sel.xpath('//ul[@class="list"]/li/div[@class="manga_text"]/a[@class="title"]/text()').extract()
			#manga_name = []
			#for name in names:
			#	import HTMLParser
			#	htmlp = HTMLParser.HTMLParser()
			#	manga_name.append( htmlp.unescape(name))
						
			#manga_rat = sel.xpath('//ul[@class="list"]/li/div[@class="manga_text"]/p/span[@class="rate"]/text()').extract()

		for i in range (0, len(manga_url)):
			
			#print manga_rat[i]
			item = MangaDataItem(manga_link=manga_url[i])
			request = scrapy.Request(str(manga_url[i]),callback=self.parse_manga, meta={'item':item})
			
			yield request

		#print len(manga_url)
		#yield item

	def parse_manga(self, response):
		#print response.url
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
		
		item['manga_name'] = manga_name
		item['manga_type'] = typ
		

		img = response.xpath('//div[@class="widepage"]/div[@class="left"]/div[@id="series_info"]/div[@class="cover"]/img/@src').extract()
		item['manga_img'] = img

		released = response.xpath('//div[@class="widepage"]/div[@class="left"]/div[@id="title"]/table/tr[2]/td[1]/a/text()').extract()
		item['manga_released'] = released
		
		author = response.xpath('//div[@class="widepage"]/div[@class="left"]/div[@id="title"]/table/tr[2]/td[2]/a/text()').extract()
		if len(author) == 0:
			author.append("unknown")		
		item['manga_author'] = author
		
		artist = response.xpath('//div[@class="widepage"]/div[@class="left"]/div[@id="title"]/table/tr[2]/td[3]/a/text()').extract()
		if len(artist) == 0:
			artist.append("unknown")		
		item['manga_artist'] = artist 

		genre = response.xpath('//div[@class="widepage"]/div[@class="left"]/div[@id="title"]/table/tr[2]/td[4]/a/text()').extract()
		if len(genre) == 0:
			genre.append("unknown")
		genre = ', '.join(str(e) for e in genre) 
		item['manga_genre'] = genre
		#print genre
		import unicodedata
		infos = response.xpath('//div[@class="widepage"]/div[@class="left"]/div[@id="title"]/p/text()').extract()
		manga_info = []
		for info in infos:
			manga_info.append( unicodedata.normalize('NFKD', info).encode('ASCII', 'ignore'))
		info = ' '.join(str(e) for e in manga_info)
		item['manga_info'] = info
		#print info

		status = response.xpath('//div[@class="widepage"]/div[@class="left"]/div[@id="series_info"]/div[@class="data"]/span/text()').extract()[0]
		status = checkStatus(status)	
		item['manga_status'] = status	
		#print status
		if status.find("Completed") != -1:
			string = response.xpath('//div[@class="widepage"]/div[@class="left"]/div[@id="series_info"]/div[@class="data"]/span/text()').extract()[1]
		else:
			string = response.xpath('//div[@class="widepage"]/div[@class="left"]/div[@id="series_info"]/div[@class="data"]/span/text()').extract()[3]

		string = string.strip()

		if string.find("Unknown") == -1:
			pos, views = getPosAndViews(string) 
		else:
			pos, views = "0", "0"
		#print "pos: " + str(pos) + " views: " + str (views)
		
		item['manga_pos'] = pos
		item['manga_visual'] = views
		
		string = response.xpath('//div[@class="widepage"]/div[@class="left"]/div[@id="series_info"]/div[@class="data"]/span/text()').extract()
		
		if status.find("Completed") != -1:
			string = string[2]
		else:
			string = string[4]
		
		print string
		rate, votes = getRateAndVotes(string)
		#print "votes: " + votes + " rate: " + rate
 
		item['manga_votes'] = votes
		item['manga_rate'] = rate
		
		yield item


