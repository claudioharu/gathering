# -*- coding: utf-8 -*-
import scrapy
from categories.items import CategoriesItem
import unicodedata
import urllib
import urlparse

def url_fix(s, charset='utf-8'):

    if isinstance(s, unicode):
        s = s.encode(charset, 'ignore')
    scheme, netloc, path, qs, anchor = urlparse.urlsplit(s)
    path = urllib.quote(path, '/%')
    qs = urllib.quote_plus(qs, ':&=')

class CategSpider(scrapy.Spider):
    name = "categ"
    allowed_domains = ["mangahere.co"]
    # start_urls = ['http://www.mangahere.co/action/']
    start_urls = ["http://www.mangahere.co/seinen/"+str(i) +".htm" for i in range (1,66)]

    def parse(self, response):

        for sel in response.xpath('//div[@class="directory_list"]'):
            manga_url = sel.xpath('//ul/li/div[@class="manga_text"]/div[@class="title"]/a/@href').extract()

        for i in range (0, len(manga_url)):
            item = CategoriesItem(link=manga_url[i],categ="seinen",site="mangahere")
            request = scrapy.Request(str(manga_url[i]),callback=self.parse_manga, meta={'item':item})
            #request.meta['item'] = item
            yield request

        # nextPage = "http://www.mangahere.co/action/"
        # next = response.xpath('/html/body/section/article/div/div[2]/div[2]/div/a[13]/@href').extract()
        # if len (next) == 0:
        #     return
        # if "javascript:void(0);" in next:
        #     return
        # nextPage = nextPage + str(next[0])
        # req_next = scrapy.Request(nextPage)
        # yield req_next

    def parse_manga(self, response):

        item = response.meta['item']

        #item['manga_link'] = response.url
        #Arrumar nome
        import unicodedata
        name = response.xpath('//div[@class="box_w clearfix"]/h1[@class="title"]/text()').extract()
        print name
        if len(name) > 0:       
            manga_name = unicodedata.normalize('NFKD', name[0]).encode('ASCII', 'ignore')
            print manga_name
            name = [x.lower() for x in manga_name]
            manga_name = ''.join(str(e) for e in name)
            import HTMLParser
            htmlp = HTMLParser.HTMLParser()
            manga_name = htmlp.unescape(manga_name)
        else:
            manga_name = "unknown"
        #name = unicode(manga_name, 'unicode-escape')
        #manga_name = unicodedata.normalize('NFKD', name).encode('ASCII', 'ignore')
        item['name'] = manga_name
        yield item
