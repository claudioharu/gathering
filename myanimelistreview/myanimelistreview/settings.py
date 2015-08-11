# -*- coding: utf-8 -*-

# Scrapy settings for myanimelistreview project
#
# For simplicity, this file contains only settings considered important or
# commonly used. You can find more settings consulting the documentation:
#
#     http://doc.scrapy.org/en/latest/topics/settings.html
#     http://scrapy.readthedocs.org/en/latest/topics/downloader-middleware.html
#     http://scrapy.readthedocs.org/en/latest/topics/spider-middleware.html

BOT_NAME = 'myanimelistreview'

SPIDER_MODULES = ['myanimelistreview.spiders']
NEWSPIDER_MODULE = 'myanimelistreview.spiders'



# Configure item pipelines
# See http://scrapy.readthedocs.org/en/latest/topics/item-pipeline.html
ITEM_PIPELINES = {
	'myanimelistreview.pipelines.MySQLStorePipeline': 400,
}

DOWNLOAD_TIMEOUT = 800;
DOWNLOAD_DELAY = 0.50;

