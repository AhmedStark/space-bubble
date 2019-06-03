import mysql.connector
import requests 
import json
import time
import os
from dotenv import load_dotenv

load_dotenv("../.env")
print(os.environ.get("DB_DATABASE"))
mydb = mysql.connector.connect(
  host="localhost",
  user="phpmyadmin",
  passwd="rootroot",
  database=os.environ.get("DB_DATABASE")
)
mycursor = mydb.cursor()

sql = "INSERT INTO records (area_id,area_name,total_tables,total_taken_tables,created_at) VALUES (%s, %s, %s, %s, %s)"

def file_get_contents(filename):
    with open(filename) as f:
        return f.read()
json_file = file_get_contents("history-demo.json")

areas = json.loads(json_file)
for area in areas:
    area_name = area['name']
    area_id = area['id']
    area_total_tables = area['totalSeats']
    for record_time,tables_taken in area['history'].items():
        val = (area_id,area_name,area_total_tables,tables_taken,record_time)
        mycursor.execute(sql,val)
mydb.commit()