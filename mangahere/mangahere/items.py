# -*- coding: utf-8 -*-

# Define here the models for your scraped items
#
# See documentation in:
# http://doc.scrapy.org/en/latest/topics/items.html

import scrapy


class MangahereItem(scrapy.Item):
	manga_name = scrapy.Field()
	manga_link = scrapy.Field()
	manga_img = scrapy.Field()
	manga_rate = scrapy.Field()
	manga_genre = scrapy.Field()
	manga_pos = scrapy.Field()
	manga_visual = scrapy.Field()
	manga_votes = scrapy.Field()
	manga_author = scrapy.Field()
	manga_artist = scrapy.Field()
	manga_status = scrapy.Field()
	manga_info = scrapy.Field()
