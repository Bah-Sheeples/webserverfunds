import mysql.connector

mydb = mysql.connector.connect(
    host="localhost",
    user="pi",
    password="A1f2i3r4e",
    database="PROJECT2022"
)

mycursor = mydb.cursor()
user_id= "A1234"
pass_id= "1234"
sqlsel = "SELECT password FROM users WHERE (user = %s)"
mycursor.execute(sqlsel,user_id)
realpass_id=cursor.fetchone()
if realpass_id == pass_id:
    print("yes")      #accepted
else: 
    print("no")     #denied