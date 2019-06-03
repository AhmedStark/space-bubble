import mysql.connector
import requests 
import json
import time
import os
from dotenv import load_dotenv
print("Creating demo database")
mapStartString = "<template><area-map :id=\"id\" v><div slot=\"map\">"
mapEndString = "</div></area-map></template><script>export default {\nprops:{\nid:{type:String},\nnav:{type:Array}\n}\n}\n</script>"

load_dotenv("../.env")
print(os.environ.get("DB_DATABASE"))
mydb = mysql.connector.connect(
  host="localhost",
  user="phpmyadmin",
  passwd="rootroot",
  database=os.environ.get("DB_DATABASE")
)
mycursor = mydb.cursor()
def file_get_contents(filename):
    with open(filename) as f:
        return f.read()
def makeMapFile (startString,endString,mapString,id):
    f = open("../resources/js/components/maps/map-"+str(id)+".vue", "w")
    f.write(startString+mapString+endString)
    f.close()
json_file = file_get_contents("demo.json")
area_json_file = file_get_contents("demo-areas.json")

buildings = json.loads(json_file)["buildings"]
sql = "INSERT INTO buildings (name,id) VALUES (%s, %s)"
sqlLevel = "INSERT INTO levels (name,id,building_id) VALUES (%s, %s,%s)"
sqlArea = "INSERT INTO areas (name,id,level_id) VALUES (%s, %s,%s)"

print("Creating buildings...")
print("Creating levels...")

levels_number = 0
print("Creating demo map files...")
for building in buildings:
    val = (building['name'],building['id'])
    mycursor.execute(sql,val)
    
    for level in building['levels']:
        lvlVal = (level['name'],level['id'],building['id'])
        mycursor.execute(sqlLevel,lvlVal)
        svg_file = file_get_contents(level['map_file']).replace("<?xml version=\"1.0\" encoding=\"UTF-8\" standalone=\"no\"?>","")
        makeMapFile(mapStartString,mapEndString,svg_file,level['id'])
        levels_number += 1

print(str(len(buildings))+" buildings created.")
print(str(levels_number)+" levels created.")

areas = json.loads(area_json_file)

print("Creating areas...")

tables_number = 0
for area in areas:
    val = (area['name'],area['id'],area['levelID'])
    mycursor.execute(sqlArea,val)
    tables_number += area['totalTables']
    r=requests.get("http://localhost:8000/store-many?area_id="+str(area['id'])+"&&quantity="+str(area['totalTables']))

mydb.commit()
print(str(len(areas))+" areas created.")
print("Creating tables(desks)...")
for area in areas:
    d=requests.get("http://localhost:8000/busy-tables/"+str(area['id'])+"/"+str(area['takenTables']))
print(str(tables_number)+" tables/desks created.")
