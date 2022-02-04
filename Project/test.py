#!/usr/bin/env python

import serial
import time
import mysql.connector
from datetime import date

mydb = mysql.connector.connect(
    host="localhost",
    user="pi",
    password="A1f2i3r4e",
    database="COH2UNIT"
)
ser = serial.Serial (
    port='/dev/ttyAMA0',
    baudrate = 2400,
    parity=serial.PARITY_NONE
    stopbits=serial.STOPBITS_ONE,
    byesize=serial.EIGHTBITS,
    timeout=1
)

light_val=0x0F

while 1:

    msg_id = ser.read(1)
    if msg_id == 0x02:
        user_id = ser.read(8)
        pass_id = ser.read(8)
        mycursor = mydb.cursor()
        sqlsel = "SELECT * FROM users WHERE user = %s password =%s"
        try:
            mycursor.execute(sqlsel,user_id,pass_id)
            auth_user = 0x0A    #accepted
            break
        except: 
            auth_user = 0x0D    #denied
        ser.write(auth_user)     
    elif msg_id == 0x03:
        today= date.today()
        mycursor = mydb.cursor()
        sqlin= "INSERT INTO ir_log (date) VALUES (%s)" 
        mycursor.execute(sqlin, today)
        mydb.commit()
    elif msg_id == 0x04: 
        mycursor = mydb.cursor()
        mycursor.execute("SELECT * FROM light_input")
        light_val= mycursor.fetchone()
        ser.write(light_val)
    elif msg_id ==0x05:
        light_level= ser.read(1)
        sqlin= "INSERT INTO light_log (level) VALUES (%s)" 
        mycursor.execute(sqlin, light_level)
        
    


# try,except, finally
# https://www.programiz.com/python-programming/exception-handling#:~:text=Python%20Exception%20Handling%20Using%20try%2C%20except%20and%20finally,with%20else%20clause.%20...%206%20Python%20try...finally.%20
# Serial
# https://maker.pro/pic/tutorial/introduction-to-python-serial-ports#:~:text=1%20open%20%28%29%20%E2%80%93%20This%20will%20open%20the,function%20to%20the%20serial%20port%20More%20items...%20 
# Time
# 

