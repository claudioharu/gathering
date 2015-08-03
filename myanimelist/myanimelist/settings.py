# -*- coding: utf-8 -*-

# Scrapy settings for myanimelist project
#
# For simplicity, this file contains only settings considered important or
# commonly used. You can find more settings consulting the documentation:
#
#     http://doc.scrapy.org/en/latest/topics/settings.html
#     http://scrapy.readthedocs.org/en/latest/topics/downloader-middleware.html
#     http://scrapy.readthedocs.org/en/latest/topics/spider-middleware.html

BOT_NAME = 'myanimelist'

SPIDER_MODULES = ['myanimelist.spiders']
NEWSPIDER_MODULE = 'myanimelist.spiders'
DOWNLOAD_HANDLERS = {
  's3': None,
}
ITEM_PIPELINES = {
    'myanimelist.pipelines.MySQLStorePipeline': 400,
}
DOWNLOAD_TIMEOUT = 800;
DOWNLOAD_DELAY = 0.80;