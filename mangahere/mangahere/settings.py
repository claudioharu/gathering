# -*- coding: utf-8 -*-

# Scrapy settings for mangahere project
#
# For simplicity, this file contains only settings considered important or
# commonly used. You can find more settings consulting the documentation:
#
#     http://doc.scrapy.org/en/latest/topics/settings.html
#     http://scrapy.readthedocs.org/en/latest/topics/downloader-middleware.html
#     http://scrapy.readthedocs.org/en/latest/topics/spider-middleware.html

BOT_NAME = 'mangahere'

SPIDER_MODULES = ['mangahere.spiders']
NEWSPIDER_MODULE = 'mangahere.spiders'
DOWNLOAD_HANDLERS = {
  's3': None,
}
ITEM_PIPELINES = {
    'mangahere.pipelines.MySQLStorePipeline': 400,
}
