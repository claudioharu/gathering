# -*- coding: utf-8 -*-
import scrapy
from mangahere.items import MangahereItem

def ehLista(lista):
	if not isinstance(lista,list):
		return lista
	else:
		if len(lista) >0:
			return lista[0]
		else:
			return "unknown"

class MangahereSpider(scrapy.Spider):
	name = "mangahereSpider"
	allowed_domains = ["mangahere.co"]
	#start_urls = ["http://www.mangahere.co/directory/264.htm?name.az"]
	start_urls = ["http://www.mangahere.co/directory/"+str(i)+".htm?name.za" for i in range (1,406)]
	#start_urls.append("http://www.mangahere.co/directory/")
	

	def parse(self, response):

		for sel in response.xpath('//div[@class="directory_list"]'):
			
			manga_url = sel.xpath('//ul/li/div[@class="manga_text"]/div[@class="title"]/a/@href').extract()
			#item['manga_link'] = manga_name
			manga_views = sel.xpath('//ul/li/div[@class="manga_text"]/p[3]/text()').extract()
			manga_rat = sel.xpath('//ul/li/div[@class="manga_text"]/p[1]/span/text()').extract()
		
		for i in range (0, len(manga_url)):
			item = MangahereItem(manga_link=manga_url[i],manga_visual=manga_views[i],manga_rate=manga_rat[i])
			request = scrapy.Request(str(manga_url[i]),callback=self.parse_manga, meta={'item':item})
			#request.meta['item'] = item
			yield request

		#print len(manga_url)
		#yield item

	def parse_manga(self, response):

		item = response.meta['item']
		
		#item['manga_link'] = response.url
		#Arrumar nome
		import unicodedata
		name = response.xpath('//div[@class="box_w clearfix"]/h1[@class="title"]/text()').extract()
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
		#name = unicode(manga_name, 'unicode-escape')
		#manga_name = unicodedata.normalize('NFKD', name).encode('ASCII', 'ignore')
		item['manga_name'] = manga_name
	
		rank = response.xpath('//div[@class="manga_detail_top clearfix"]/ul[@class="detail_topText"]/li[8]/text()').extract()
		item['manga_pos'] = rank

		genre = response.xpath('//div[@class="manga_detail_top clearfix"]/ul[@class="detail_topText"]/li[4]/text()').extract()
		item['manga_genre'] = genre

		img = response.xpath('//div[@class="manga_detail_top clearfix"]/img/@src').extract()
		item['manga_img'] = img

		info = response.xpath('//div[@class="manga_detail_top clearfix"]/ul[@class="detail_topText"]/li[9]/p[@id="show"]/text()').extract()
		if len(info) == 0:
			info = response.xpath('//div[@class="manga_detail_top clearfix"]/ul[@class="detail_topText"]/li[10]/p[@id="show"]/text()').extract()
		if len(info) == 0:
			info = response.xpath('//div[@class="manga_detail_top clearfix"]/ul[@class="detail_topText"]/li[11]/p[@id="show"]/text()').extract()
		item['manga_info'] = info

		author = response.xpath('//div[@class="manga_detail_top clearfix"]/ul[@class="detail_topText"]/li[5]/a/text()').extract()	
		item['manga_author'] = author

		artist = response.xpath('//div[@class="manga_detail_top clearfix"]/ul[@class="detail_topText"]/li[6]/a/text()').extract()
		item['manga_artist'] = artist

		status = response.xpath('//div[@class="manga_detail_top clearfix"]/ul[@class="detail_topText"]/li[7]/text()').extract()
		status = ehLista(status)
		item['manga_status'] = status

		votes = response.xpath('//div[@class="manga_detail_top clearfix"]/ul[@class="detail_topText"]/li[@id="rate"]/span[@class="ml5"]/text()').extract()
		#print votes
		votes = votes[0].split("(")[1]
		votes =  votes.split(" vote")[0]

		item['manga_votes'] = votes

		yield item

