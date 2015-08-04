# -*- coding: utf-8 -*-

# Define here the models for your scraped items
#
# See documentation in:
# http://doc.scrapy.org/en/latest/topics/items.html

import scrapy


class MyanimeliststatsItem(scrapy.Item):
	# define the fields for your item here like:
	# name = scrapy.Field()
	manga_name = scrapy.Field()
	manga_link = scrapy.Field()
	reading = scrapy.Field()
	completed = scrapy.Field()
	onHold = scrapy.Field()
	dropped = scrapy.Field()
	planToRead = scrapy.Field()
	showAll = scrapy.Field()
	total = scrapy.Field()
