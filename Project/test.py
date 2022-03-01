#!/usr/bin/env python

import datetime
import serial
import time
import mysql.connector
import flask

mydb = mysql.connector.connect(
    host="localhost",
    user="pi",
    password="A1f2i3r4e",
    database="PROJECT2022"
)
ser = serial.Serial (
    port='/dev/serial0',
    baudrate = 2400,
    parity=serial.PARITY_NONE,
    stopbits=serial.STOPBITS_ONE,
    bytesize=serial.EIGHTBITS,
)


while True: 
    mycursor = mydb.cursor()
    sqla = "SELECT status FROM lights   
    mycursor.execute(sqla)
    tlights = mycursor.fetchone()
    lights = tlights[0]
    cursor.close()
    sqlb = "SELECT status FROM motor   
    mycursor.execute(sqlb)
    tmotor = mycursor.fetchone()
    motor = tmotor[0]
    cursor.close()

    tmsg_id = ser.read()
    msg_id=tmsg_id[0]   #value is stored in an array.
    if msg_id == 2:     #Reading matrix data
        ser.write(2)    #Ready to read
        user_id = ser.readline()    #Reading user ID. Terminated by NUL (0x00) character
        pass_id = ser.readline()    #Reading Password
        mycursor = mydb.cursor()
        sqlsel = "SELECT password FROM users WHERE (user = '%s')"%user_id   #Select Database for user==user_id
        try:    #first execute sqlsel
            mycursor.execute(sqlsel)
            tpass_id=mycursor.fetchone()    #takes database value, and stores into an array.
            realpass_id=tpass_id[0] 
            if realpass_id == pass_id:
                ser.write(0x0A)     #accepted
            else: 
                ser.write(0x0D)     #denied
        except:     #if user doesn't exist(aka error detected) try: 
            ser.write(0x0D)         #invalid username. Denied anyways.           
        finally:
            cursor.close()
    # elif msg_id == 0x03:    #IR Logs. 
    #     now= datetime.datetime.now()
    #     mycursor = mydb.cursor()
    #     sqlin= "INSERT INTO ir_log (date) VALUES (%s)" 
    #     mycursor.execute(sqlin, now)
    #     mydb.commit()
        # cursor.close()
    # elif msg_id == 0x04: 
    #     ser.write(2)    #Ready to read
    #     mycursor = mydb.cursor()
    #     mycursor.execute("SELECT * FROM light_input")
    #     light_val= mycursor.fetchone()
    #     ser.write(light_val)
        # cursor.close()
    elif msg_id ==0x05:     #Light Level Logs
        ser.write(2)    #Ready to read
        light_level= ser.read()
        int_val = int.from_bytes(light_level,"little")
        now= datetime.datetime.now()
        a = int_val / 255
        sqlin= "INSERT INTO light_log (level,time) VALUES (%d,%s)" 
        mycursor.execute(sqlin, light_level,now)
        cursor.close()



# try,except, finally
# https://www.programiz.com/python-programming/exception-handling#:~:text=Python%20Exception%20Handling%20Using%20try%2C%20except%20and%20finally,with%20else%20clause.%20...%206%20Python%20try...finally.%20
# Serial
# https://maker.pro/pic/tutorial/introduction-to-python-serial-ports#:~:text=1%20open%20%28%29%20%E2%80%93%20This%20will%20open%20the,function%20to%20the%20serial%20port%20More%20items...%20 
# Time
# 

