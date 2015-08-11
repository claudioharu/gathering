# -*- coding: utf-8 -*-

# Scrapy settings for categories project
#
# For simplicity, this file contains only settings considered important or
# commonly used. You can find more settings consulting the documentation:
#
#     http://doc.scrapy.org/en/latest/topics/settings.html
#     http://scrapy.readthedocs.org/en/latest/topics/downloader-middleware.html
#     http://scrapy.readthedocs.org/en/latest/topics/spider-middleware.html

BOT_NAME = 'categories'

SPIDER_MODULES = ['categories.spiders']
NEWSPIDER_MODULE = 'categories.spiders'


# Configure item pipelines
# See http://scrapy.readthedocs.org/en/latest/topics/item-pipeline.html
ITEM_PIPELINES = {
	'categories.pipelines.MySQLStorePipeline': 400,
}

DOWNLOAD_TIMEOUT = 800;
DOWNLOAD_DELAY = 0.80;
