# -*- coding: utf-8 -*-
import scrapy
from mangahost.items import MangahostItem

class MangahostspiderSpider(scrapy.Spider):
	name = "mangahostSpider"
	allowed_domains = ["br.mangahost.com"]
	start_urls = ["http://br.mangahost.com/mangas/page/"+str(i) for i in range(1,89)]
	#start_urls = ["http://br.mangahost.com/mangas/page/1"]
	def parse(self, response):

		for sel in response.xpath('//div[@class="list clearfix"]'):

			manga_url = sel.xpath('//div[@class="thumbnail"]/div/a/@href').extract()
			#item['manga_link'] = manga_name		
			lastUrls = response.xpath('//div[@class="thumbnail reset-margin-right"]/div/a/@href').extract()
		

		manga_url = manga_url + lastUrls
		#print len(manga_url )
		for i in range (0, len(manga_url)):
			item = MangahostItem(manga_link=manga_url[i])
			request = scrapy.Request(str(manga_url[i]),callback=self.parse_manga, meta={'item':item})
			yield request

	def parse_manga(self, response):

		item = response.meta['item']
	

		import unicodedata
		import HTMLParser
		name = response.xpath('//div[@id="page"]/section[@class="clearfix"]/header/div[@class="title-widget"]/h1[@class="entry-title"]/text()').extract()
		#print name
		
		if len(name) > 0:		
			manga_name = unicodedata.normalize('NFKD', name[0]).encode('ASCII', 'ignore')
			print manga_name
			name = [x.lower() for x in manga_name]
			manga_name = ''.join(str(e) for e in name)
			
			htmlp = HTMLParser.HTMLParser()
			manga_name = htmlp.unescape(manga_name)
		else:
			manga_name = "unknown"
		
		item['manga_name'] = manga_name

		img = response.xpath('//div[@id="page"]/section[@class="clearfix"]/div[@class="clearfix margin-bottom-20"]/img/@src').extract()
		item['manga_img'] = img

		itensList = response.xpath('//div[@id="page"]/section[@class="clearfix"]/div[@class="clearfix margin-bottom-20"]/div[@class="pull-left"]/div[@class="clearfix margin-bottom-20"]/ul[@class="unstyled descricao pull-left clearfix"]/li/strong/text()').extract()
		#print itensList
		
		
		if "Tipo: " in itensList:
			index = itensList.index("Tipo: ")+1
			typ = response.xpath('//div[@id="page"]/section[@class="clearfix"]/div[@class="clearfix margin-bottom-20"]/div[@class="pull-left"]/div[@class="clearfix margin-bottom-20"]/ul[@class="unstyled descricao pull-left clearfix"]/li['+ str(index) + ']/text()').extract()
		else: 
			typ = []

		if "Status: " in itensList:
			index = itensList.index("Status: ")+1
			status = response.xpath('//div[@id="page"]/section[@class="clearfix"]/div[@class="clearfix margin-bottom-20"]/div[@class="pull-left"]/div[@class="clearfix margin-bottom-20"]/ul[@class="unstyled descricao pull-left clearfix"]/li['+ str(index) + ']/text()').extract()
		else:
			status = []

		if "Autor: " in itensList:
			index = itensList.index("Autor: ")+1
			author = response.xpath('//div[@id="page"]/section[@class="clearfix"]/div[@class="clearfix margin-bottom-20"]/div[@class="pull-left"]/div[@class="clearfix margin-bottom-20"]/ul[@class="unstyled descricao pull-left clearfix"]/li['+ str(index) + ']/text()').extract()
		else:
			author = []
			
		if "Desenho (Art): " in itensList:
			index = itensList.index("Desenho (Art): ")+1
			artist = response.xpath('//div[@id="page"]/section[@class="clearfix"]/div[@class="clearfix margin-bottom-20"]/div[@class="pull-left"]/div[@class="clearfix margin-bottom-20"]/ul[@class="unstyled descricao pull-left clearfix"]/li['+ str(index) + ']/text()').extract()
		else:
			artist = []

		if "Categoria(s): " in itensList:
			index = itensList.index("Categoria(s): ")+1
			genre = response.xpath('//div[@id="page"]/section[@class="clearfix"]/div[@class="clearfix margin-bottom-20"]/div[@class="pull-left"]/div[@class="clearfix margin-bottom-20"]/ul[@class="unstyled descricao pull-left clearfix"]/li['+ str(index) + ']/a/text()').extract()
		else:
			genre = ["unknown"]

		if "Ano: " in itensList:
			index = itensList.index("Ano: ")+1
			released =response.xpath('//div[@id="page"]/section[@class="clearfix"]/div[@class="clearfix margin-bottom-20"]/div[@class="pull-left"]/div[@class="clearfix margin-bottom-20"]/ul[@class="unstyled descricao pull-left clearfix"]/li['+ str(index) + ']/text()').extract()
		else:
			released = 0

		if len(typ) > 0:			
			typ = unicodedata.normalize('NFKD', typ[0]).encode('ASCII', 'ignore')
			typ = [x.lower() for x in typ]
			typ = ''.join(str(e) for e in typ)
			htmlp = HTMLParser.HTMLParser()
			typ = htmlp.unescape(typ)
		else:
			typ = "unknown"		
		#print typ
		item['manga_type'] = typ


		if len(status) > 0:			
			status = unicodedata.normalize('NFKD', status[0]).encode('ASCII', 'ignore')
			status = [x.lower() for x in status]
			status = ''.join(str(e) for e in status)
			htmlp = HTMLParser.HTMLParser()
			status = htmlp.unescape(status)
		else:
			status = "unknown"		

		item['manga_status'] = status
		#print status


		
		if len(author) > 0:			
			author = unicodedata.normalize('NFKD', author[0]).encode('ASCII', 'ignore')
			author = [x.lower() for x in author]
			author = ''.join(str(e) for e in author)
			htmlp = HTMLParser.HTMLParser()
			author = htmlp.unescape(author)
		else:
			author = "unknown"		

		item['manga_author'] = author
		#print author

		
		if len(artist) > 0:			
			artist = unicodedata.normalize('NFKD', artist[0]).encode('ASCII', 'ignore')
			artist = [x.lower() for x in artist]
			artist = ''.join(str(e) for e in artist)
			htmlp = HTMLParser.HTMLParser()
			artist = htmlp.unescape(artist)
		else:
			artist = "unknown"		

		item['manga_artist'] = artist
		#print artist


		genre = ', '.join(str(e) for e in genre)
		item['manga_genre'] = genre		
		#print genre
		
		
		#print released	
		item['manga_released'] = released

		indexString = response.xpath('//div[@id="page"]/section[@class="clearfix"]/div[@class="clearfix margin-bottom-20"]/div[@class="pull-left"]/div[@class="clearfix margin-bottom-20"]/div[@class="options"]/div[@class="stars_rating"]/div[@class="post-ratings"]/span/div/text()').extract()
		#print indexString
		string = response.xpath('//div[@id="page"]/section[@class="clearfix"]/div[@class="clearfix margin-bottom-20"]/div[@class="pull-left"]/div[@class="clearfix margin-bottom-20"]/div[@class="options"]/div[@class="stars_rating"]/div[@class="post-ratings"]/span/div/strong/text()').extract()
		if " de 5" in indexString:
			index = indexString.index(" de 5")-1
			rate = string[index]
			pos = rate.find(",")
			print "rate: " + str(rate)
			if pos != -1:
				rate = list(rate)		
				rate[pos] = "."
				rate = ''.join(str(e) for e in rate)
			
		else:
			rate = "0.0"
		
		if " votos" in indexString:
			index = indexString.index(" votos")
			votos = string[index]
		else:
			votos = "0"

		#print rate
		item['manga_rate'] = rate		
		item['manga_votes'] = votos

		views = response.xpath('//div[@id="page"]/section[@class="clearfix"]/div[@class="clearfix margin-bottom-20"]/div[@class="pull-left"]/div[@class="clearfix margin-bottom-20"]/div[@class="options"]/div[@class="stars_rating"]/small[@class="muted"]/text()').extract()
		views = views[0].split(" ")[0]		
		pos = views.find(".")
		if pos != -1:
			views = list(views)
			views.pop(pos)
			views = ''.join(str(e) for e in views)
		#print views
		item['manga_visual'] = views

		info = response.xpath('//div[@id="page"]/section[@class="clearfix"]/div[@class="clearfix margin-bottom-20"]/div[@class="pull-left"]/article[@class="well clearfix"]/div[@id="divSpdInText"]/p/text()').extract()
		if len(info) > 0:			
			info = unicodedata.normalize('NFKD', info[0]).encode('ASCII', 'ignore')
			info = [x.lower() for x in info]
			info = ''.join(str(e) for e in info)
			htmlp = HTMLParser.HTMLParser()
			info = htmlp.unescape(info)
		else:
			info = "unknown"		

		#print info
		item['manga_info'] = info
		yield item
