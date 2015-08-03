# -*- coding: utf-8 -*-

# Scrapy settings for teste project
#
# For simplicity, this file contains only settings considered important or
# commonly used. You can find more settings consulting the documentation:
#
#     http://doc.scrapy.org/en/latest/topics/settings.html
#     http://scrapy.readthedocs.org/en/latest/topics/downloader-middleware.html
#     http://scrapy.readthedocs.org/en/latest/topics/spider-middleware.html

BOT_NAME = 'teste'

SPIDER_MODULES = ['teste.spiders']
NEWSPIDER_MODULE = 'teste.spiders'
DOWNLOAD_HANDLERS = {
  's3': None,
}
ITEM_PIPELINES = {
    'teste.pipelines.MySQLStorePipeline': 300,
}
