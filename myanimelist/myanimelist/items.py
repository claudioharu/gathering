# -*- coding: utf-8 -*-

# Define here the models for your scraped items
#
# See documentation in:
# http://doc.scrapy.org/en/latest/topics/items.html

import scrapy


class MyanimelistItem(scrapy.Item):
	# define the fields for your item here like:
	# name = scrapy.Field()
	manga_link = scrapy.Field()
	manga_name = scrapy.Field()
	manga_img = scrapy.Field()
	manga_rank = scrapy.Field()
	manga_score = scrapy.Field()
	manga_popularity = scrapy.Field()
	manga_members = scrapy.Field()
	manga_favorites = scrapy.Field()
	manga_background = scrapy.Field()
	manga_background = scrapy.Field()
	manga_recommend = scrapy.Field()
