# -*- coding: utf-8 -*-

# Define your item pipelines here
#
# Don't forget to add your pipeline to the ITEM_PIPELINES setting
# See: http://doc.scrapy.org/en/latest/topics/item-pipeline.html

import mysql.connector

def connect():
	
	connection = mysql.connector.connect(host='localhost',database='mangas',user='root',password='123456')
	
	if connection.is_connected():
		print "Conectado a MANGAS."
	
	return connection

def ehLista(lista):
	if not isinstance(lista,list):
		return lista
	else:
		if len(lista) >0:
			return lista[0]
		else:
			return "unknown"
def canConvert(value):
	try:
		int(value)
		return True
	except ValueError:
		print "pode não"
		return False

def insert_mangas(connection, mangas):
	
	
	# name = ehLista(mangas['manga_name'])
	# if name == "unknown":
	# 	return
	
	link = ehLista(mangas["manga_link"])
	# votes1 = ehLista(mangas["votes1"])
	# votes2 = ehLista(mangas["votes2"])
	# votes3 = ehLista(mangas["votes3"])
	# votes4 = ehLista(mangas["votes4"])
	# votes5 = ehLista(mangas["votes5"])
	# votes6 = ehLista(mangas["votes6"])
	# votes7 = ehLista(mangas["votes7"])
	# votes8 = ehLista(mangas["votes8"])
	# votes9 = ehLista(mangas["votes9"])
	# votes10 = ehLista(mangas["votes10"])
	# percent1 = ehLista(mangas["percent1"])
	# percent2 = ehLista(mangas["percent2"])
	# percent3 = ehLista(mangas["percent3"])
	# percent4 = ehLista(mangas["percent4"])
	# percent5 = ehLista(mangas["percent5"])
	# percent6 = ehLista(mangas["percent6"])
	# percent7 = ehLista(mangas["percent7"])
	# percent8 = ehLista(mangas["percent8"])
	# percent9 = ehLista(mangas["percent9"])
	# percent10 = ehLista(mangas["percent10"])


	#print "\n\n\n"
	#print name
	#print votes
	
	#Define insercao dos tempos no banco de dados
	# add_mangas= "INSERT INTO MangaMyanimelist_Stats (name, link, votes1, votes2, votes3, votes4, votes5, votes6, votes7, votes8, votes9, votes10, percent1, percent2, percent3, percent4, percent5, percent6, percent7, percent8, percent9, percent10) VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s)"

	# args = (name, link,  votes1, votes2, votes3, votes4, votes5, votes6, votes7, votes8, votes9, votes10, percent1, percent2, percent3, percent4, percent5, percent6, percent7, percent8, percent9, percent10)

	# #Insere dados do jogo no banco
	# cursor = connection.cursor()
	# cursor.execute(add_mangas, args)
	# connection.commit()


#Armazena o item coletado no banco
class MySQLStorePipeline(object):
	
	def __init__(self):
		self.connection = connect()

	
	def process_item(self, item, spider):
		#print "EUEUEUEUEUEUEUEUEUEUU"	 
		insert_mangas(self.connection, item)
		#return item
		
	def close_spider(self, spider):
	
		#Fecha conexao com o banco de dados
		self.connection.close()
		if self.connection.is_connected():
			print "Ainda esta conectado a MANGAS."
		else:
			print "Desconectado de MANGAS"
		print
