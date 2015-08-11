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
	
	
	name = ehLista(mangas['name'])
	if name == "unknown":
		return
		
	site = ehLista(mangas["site"])
	categ = ehLista(mangas["categ"])

	#print "\n\n\n"
	#print name
	#print votes
	
	#Define insercao dos tempos no banco de dados
	add_mangas= "INSERT INTO MangasCategories (name, site, categorie) VALUES (%s, %s, %s)"

	args = (name, site, categ)

	#Insere dados do jogo no banco
	cursor = connection.cursor()
	cursor.execute(add_mangas, args)
	connection.commit()


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


