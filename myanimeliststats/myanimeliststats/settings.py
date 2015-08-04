# -*- coding: utf-8 -*-

# Scrapy settings for myanimeliststats project
#
# For simplicity, this file contains only settings considered important or
# commonly used. You can find more settings consulting the documentation:
#
#     http://doc.scrapy.org/en/latest/topics/settings.html
#     http://scrapy.readthedocs.org/en/latest/topics/downloader-middleware.html
#     http://scrapy.readthedocs.org/en/latest/topics/spider-middleware.html

BOT_NAME = 'myanimeliststats'

SPIDER_MODULES = ['myanimeliststats.spiders']
NEWSPIDER_MODULE = 'myanimeliststats.spiders'
OWNLOAD_HANDLERS = {
  's3': None,
}
# ITEM_PIPELINES = {
#     'myanimeliststats.pipelines.MySQLStorePipeline': 400,
# }
# DOWNLOAD_TIMEOUT = 800;
# DOWNLOAD_DELAY = 0.80;