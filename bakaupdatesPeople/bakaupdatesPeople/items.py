# -*- coding: utf-8 -*-

# Define here the models for your scraped items
#
# See documentation in:
# http://doc.scrapy.org/en/latest/topics/items.html

import scrapy


class BakaupdatesItem(scrapy.Item):
	manga_link = scrapy.Field()
	person = scrapy.Field()
	info = scrapy.Field()
	img = scrapy.Field()
	birthPlace = scrapy.Field() 
	birthDate = scrapy.Field()
	zodiac = scrapy.Field()
	gender = scrapy.Field()
	numOfSeries = scrapy.Field()
	