# -*- coding: utf-8 -*-

# Scrapy settings for bakaupdates project
#
# For simplicity, this file contains only settings considered important or
# commonly used. You can find more settings consulting the documentation:
#
#     http://doc.scrapy.org/en/latest/topics/settings.html
#     http://scrapy.readthedocs.org/en/latest/topics/downloader-middleware.html
#     http://scrapy.readthedocs.org/en/latest/topics/spider-middleware.html

BOT_NAME = 'bakaupdates'

SPIDER_MODULES = ['bakaupdates.spiders']
NEWSPIDER_MODULE = 'bakaupdates.spiders'

ITEM_PIPELINES = {
    'bakaupdates.pipelines.MySQLStorePipeline': 400,
}

DOWNLOAD_TIMEOUT = 800;
DOWNLOAD_DELAY = 0.30;