# -*- coding: utf-8 -*-

# Define here the models for your scraped items
#
# See documentation in:
# http://doc.scrapy.org/en/latest/topics/items.html

import scrapy


class BakaupdatesItem(scrapy.Item):
	manga_name = scrapy.Field()
	manga_link = scrapy.Field()
	author = scrapy.Field()
	artist = scrapy.Field()
	avg = scrapy.Field()
	bayesian = scrapy.Field()
	totalVotes = scrapy.Field()
	votes1 = scrapy.Field()
	votes2 = scrapy.Field()
	votes3 = scrapy.Field()
	votes4 = scrapy.Field()
	votes5 = scrapy.Field()
	votes6 = scrapy.Field()
	votes7 = scrapy.Field()
	votes8 = scrapy.Field()
	votes9 = scrapy.Field()
	votes10 = scrapy.Field()
	percent1 = scrapy.Field()
	percent2 = scrapy.Field()
	percent3 = scrapy.Field()
	percent4 = scrapy.Field()
	percent5 = scrapy.Field()
	percent6 = scrapy.Field()
	percent7 = scrapy.Field()
	percent8 = scrapy.Field()
	percent9 = scrapy.Field()
	percent10 = scrapy.Field()
