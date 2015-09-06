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
	
	
	person = ehLista(mangas['person'])
	if person == "unknown":
		return
	
	link = ehLista(mangas["manga_link"])
	img = ehLista(mangas["img"])
	# info = ehLista(mangas["info"])
	# birthPlace = ehLista(mangas["birthPlace"])
	# birthDate = ehLista(mangas["birthDate"]) 



	print "\n\n\n"
	print "name: " + person
	print "img: " + img
	
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
