from re import X
import time
import requests
from requests.api import request
import json
from urllib.parse import urlparse
from bs4 import BeautifulSoup
from bs4.builder import HTML

from mysql.connector.errors import Error
import mysql.connector

from collections import Counter
from string import punctuation
start_time = time.time()

class seo_bridge():
    
    def __init__(self):
        self.mydb = mysql.connector.connect(host="localhost",user="root",password="",database="seobridge")
        self.url = 'https://WEBSITE.com/sitemap.xml'
        self.sitemapsoup = BeautifulSoup(requests.get(self.url).content, 'lxml')
        self.sitemapurls = self.sitemapsoup.find_all("loc")
        self.xml_urls = [sitemapurl.text for sitemapurl in self.sitemapurls]
    def bridge(self):
        for websiteurls in self.xml_urls:
            source = BeautifulSoup(requests.get(websiteurls).text, 'html.parser')
            self.insert_data(
                websiteurls, 
                self.title(source), 
                self.canonical(source), 
                self.h1(source), 
                self.h2(source), 
                self.h3(source), 
                self.h4(source), 
                self.h5(source), 
                self.h6(source),  
                self.image(source), 
                self.alt(source),
                self.language(source),
                self.robots(source)
            )
    def title(self, source):
        for titles in source.find_all('title'):         
            return titles.get_text()    
    def canonical(self, source):
        return source.find('link', {'rel': 'canonical'})['href'] 
    def image(self, source):
        imagesfinder = source.find_all('img')
        imagelist = []
        for images in imagesfinder:
                try:
                    foundedimages = images['src']
                except:
                    foundedimages = images['src'], "Don't have image"
                images = foundedimages
                imagelist.append(images)
        return json.dumps(imagelist)
    def alt(self, source):
        imagealtsfinder = source.find_all('img')
        altslist = []
        for alts in imagealtsfinder:
                try:
                    foundedalts = alts['alt']
                except:
                    foundedalts = "Alt missing"
                alts = foundedalts
                altslist.append(alts)
        return json.dumps(altslist) 
    def h1(self, source):
        return len(source.find_all('h1'))
    
    def h2(self, source):
        return len(source.find_all('h2'))    
    
    def h3(self, source):
        return len(source.find_all('h3'))      
    
    def h4(self, source):
        return len(source.find_all('h4'))     
    
    def h5(self, source):
        return len(source.find_all('h5'))  
 
    def h6(self, source):
        return len(source.find_all('h6'))
    def language(self,source):
        try:
            tag = source.html["lang"]
        except:
            tag = "You don't have language tag."
        return tag 
    def robots(self,source):
        try:
            robots = source.find("meta", {"name": "robots"})['content']
        except:
            robots = "You do not have the robots tag, your page may not be indexable."
        return robots
        
    def insert_data(self,websiteurls,title,canonical,h1,h2,h3,h4,h5,h6,image,alt,language,robots):
        mycursor = self.mydb.cursor()
        sql = "INSERT INTO analysis (analysis_url,analysis_title,analysis_canonical,analysis_h1,analysis_h2,analysis_h3,analysis_h4,analysis_h5,analysis_h6,analysis_image,analysis_imagealt,analysis_lang,analysis_robots) VALUES (%s,%s, %s,%s,%s,%s,%s,%s,%s,%s,%s,%s,%s)"
        val  =(websiteurls,title,canonical,h1,h2,h3,h4,h5,h6,image,alt,language,robots)
        mycursor.execute(sql, val)
        self.mydb.commit()
        print("1 Page crawled and inserted.")
forthes = seo_bridge()
forthes.bridge()
print("--- %s seconds ---" % (time.time() - start_time))
            

        
