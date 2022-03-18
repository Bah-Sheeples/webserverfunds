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
    port='/dev/ttyUSB0',
    baudrate = 2400,
    parity=serial.PARITY_NONE,
    stopbits=serial.STOPBITS_ONE,
    bytesize=serial.EIGHTBITS
)
x=1
y=1

while True: 
    # ser.write(0x01)
    print("Reading Message ID:")
    tmsg_id = ser.read()
    print(tmsg_id)
    msg_id=tmsg_id[0]   #value is stored in an array.
    print(msg_id)
    if msg_id == 2:     #Reading matrix data
        ser.write(b"\x02")    #Ready to read
        user_id = ser.read_until(b'\x0A')    #Reading user ID. Terminated by NUL (0x0A) character
        pass_id = ser.read_until(b'\x0A')    #Reading Password
        user_id = user_id.decode('UTF-8')
        pass_id = pass_id.decode('UTF-8')
        # str(user_id,"utf-8")
        # str(pass_id,"utf-8")
        print("Matrix:")
        print("User = ",user_id)
        print(user_id)
        print("Pass = ",pass_id)
        print(pass_id)
        mycursor = mydb.cursor()
        sqlsel = "SELECT password FROM users WHERE (user = '%s')"%user_id   #Select Database for user==user_id
        print(sqlsel)
        try:    #first execute sqlsel
            mycursor.execute(sqlsel)
            tpass_id=mycursor.fetchone()    #takes database value, and stores into an array.
            realpass_id=tpass_id[0] 
            print("Database Password")
            print(realpass_id)
            if realpass_id == pass_id:
                ser.write(b"\x01")     #accepted
            else: 
                ser.write(b"\x02")     #denied
        except:     #if user doesn't exist(aka error detected) try: 
            ser.write(b"\x02")         #invalid username. Denied anyways.           
        finally:
            mycursor.close()
            break   #remove.
    elif msg_id == 0x03:    #IR Logs. 
        now1= datetime.datetime.now()
        now = str(now1)
        IR_LOG = open('IR_LOG.txt','a')
        IR_LOG.write("IR Sensor Tripped: ")
        IR_LOG.write(now)
        IR_LOG.write("\n")
        IR_LOG.close()
        
    # elif msg_id == 0x04: #Light Set. 
    #     ser.write(2)    #Ready to read
    #     mycursor = mydb.cursor()
    #     mycursor.execute("SELECT * FROM light_input")
    #     light_valt= mycursor.fetchone()
        # light_val= light_valt[0]
    #     ser.write(light_val)
        # mycursor.close()
    elif msg_id ==0x05:     #Light Level Logs
        print("Light Log")
        ser.write(b"\x02")    #Ready to read
        light_level= ser.read(1)
        y-=1
        if y==0:
            int_val = int.from_bytes(light_level,"big")
            int_val = (int_val / 255)*100
            now1= datetime.datetime.now()
            now = str(now1)
            a = str(round(int_val,2))
            print("level: %s",a)
            lightfile = open('Light_Level.txt','a')
            lightfile.write("Light Level: ")
            lightfile.write(a)
            lightfile.write("%, Time:")
            lightfile.write(now)
            lightfile.write("\n")
            lightfile.close()
            y+=50
        
    # mycursor = mydb.cursor()
    # sqla = "SELECT status FROM lights"
    # mycursor.execute(sqla)
    # tlights = mycursor.fetchone()
    # set_light = tlights[0]
    # sqlb = "SELECT status FROM motor"
    # mycursor.execute(sqlb)
    # tmotor = mycursor.fetchone()
    # set_motor = tmotor[0]
    # mycursor.close()


# try,except, finally
# https://www.programiz.com/python-programming/exception-handling#:~:text=Python%20Exception%20Handling%20Using%20try%2C%20except%20and%20finally,with%20else%20clause.%20...%206%20Python%20try...finally.%20
# Serial
# https://maker.pro/pic/tutorial/introduction-to-python-serial-ports#:~:text=1%20open%20%28%29%20%E2%80%93%20This%20will%20open%20the,function%20to%20the%20serial%20port%20More%20items...%20 
# Time
# 

