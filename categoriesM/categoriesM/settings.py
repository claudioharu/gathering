# -*- coding: utf-8 -*-

# Scrapy settings for categoriesM project
#
# For simplicity, this file contains only settings considered important or
# commonly used. You can find more settings consulting the documentation:
#
#     http://doc.scrapy.org/en/latest/topics/settings.html
#     http://scrapy.readthedocs.org/en/latest/topics/downloader-middleware.html
#     http://scrapy.readthedocs.org/en/latest/topics/spider-middleware.html

BOT_NAME = 'categoriesM'

SPIDER_MODULES = ['categoriesM.spiders']
NEWSPIDER_MODULE = 'categoriesM.spiders'

ITEM_PIPELINES = {
	'categoriesM.pipelines.MySQLStorePipeline': 400,
}

DOWNLOAD_TIMEOUT = 800;
DOWNLOAD_DELAY = 0.40;
