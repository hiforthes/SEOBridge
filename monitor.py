from xml import dom
from mysql.connector.errors import Error
import mysql.connector
import requests
from requests.api import request
import json
from urllib.parse import urlparse
from bs4 import BeautifulSoup
from bs4.builder import HTML


mydb = mysql.connector.connect(
    host="localhost", user="root", password="", database="seobridge")
mycursor = mydb.cursor()
mycursor.execute("SELECT * FROM backlink_monitor")
myresult = mycursor.fetchall()
for x in myresult:
    url = x[1]
    domain = x[2]
    source = BeautifulSoup(requests.get(url).text, 'html.parser')
    try:
        robots = source.find("meta", {"name": "robots"})['content']
    except:
        robots = "N/A"
    mylist = []
    for mytag in source.find_all('a', href=True):
        a = mytag['href']
        mylist.append(a)
    if domain in mylist:
        y = "Alive"
    else:
        y = "Not Alive"
    sql = "UPDATE backlink_monitor SET backlink_alive = '"+y+"', backlink_robots = '"+robots+"' where backlink_url = '"+url+"'"
    mycursor.execute(sql)
    mydb.commit()

       
        
    
 