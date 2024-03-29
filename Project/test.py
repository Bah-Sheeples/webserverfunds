#!/usr/bin/env python

import datetime
import serial
import time
import mysql.connector
import flask
import requests
import RPi.GPIO as GPIO

GPIO.setwarnings(False)
GPIO.setmode(GPIO.BOARD)
GPIO.setup(32, GPIO.OUT)

phone = '+15146648168' # <-- Enter your own phone number here
smsmsg = 'Motion Sensor Triggered.'
apikey = 'textbelt' # <-- Change to your API key, if desired. Currently 1text/Day.


def send_textbelt_sms(phone, msg, apikey):
    """
    Sends an SMS through the Textbelt API.
    :param phone: Phone number to send the SMS to.
    :param msg: SMS message. Should not be more than 160 characters.
    :param apikey: Your textbelt API key. 'textbelt' can be used for free for 1 SMS per day.
    :returns: True if the SMS could be sent. False otherwise.
    :rtype: bool
    """
    result = True
    json_success = False
    # Attempt to send the SMS through textbelt's API and a requests instance.
    try:
        resp = requests.post('https://textbelt.com/text', {
            'phone': phone,
            'message': msg,
            'key': apikey,
        })
    except:
        result = False
    # Extract boolean API result
    if result:
        try:
            json_success = resp.json()["success"]
        except:
            result = False
    # Evaluate if the SMS was successfully sent.
    if result:
        if not json_success:
            result = False;
    # Give the result back to the caller.
    return result
mydb = mysql.connector.connect(
    host="localhost",
    user="pi",
    password="xx",
    database="PROJECT2022"
)
ser = serial.Serial (
    port='/dev/ttyUSB0',
    baudrate = 2400,
    parity=serial.PARITY_NONE,
    stopbits=serial.STOPBITS_ONE,
    bytesize=serial.EIGHTBITS
)
#initializations
x=1
y=1
IR = True
drawer_stat=0
light_stat=0
while True: 
    # ser.write(0x01)
    # print("Hi")
    tmsg_id = ser.read()
    msg_id=tmsg_id[0]   #value is stored in an byte.
    # print(msg_id)
    if msg_id == 2:     #Reading matrix data
        ser.write(b"\x02")    #Ready to read
        user_id = ser.read_until(b'\x0A')    #Reading user ID. Terminated by NUL (0x0A) character
        pass_id = ser.read_until(b'\x0A')    #Reading Password
        user_id = user_id.decode('UTF-8')
        pass_id = pass_id.decode('UTF-8')
        user_id = user_id.rstrip("\n")       #remove trailer
        pass_id = pass_id.rstrip("\n")  
        str(user_id)    #these might be redundant, but the code works. 
        str(pass_id)
        print("Matrix:")
        print("User = ",user_id)
        print(user_id)
        print("Pass = ",pass_id)
        print(pass_id)
        mycursor = mydb.cursor()
        sqlsel = "SELECT password FROM users WHERE (user = '%s')"%user_id   #Select Database for user==user_id
        print(sqlsel)
        try:    #first execute sqlsel
            print("try executing")
            mycursor.execute(sqlsel)
            print("cursor success")
            tpass_id = mycursor.fetchall()    #takes database value, and stores into an array.
            print(tpass_id)
            realpass_id=tpass_id[0]
            print(realpass_id)
            realpass_id=realpass_id[0]
            print(realpass_id)
            print("Database Password: ",realpass_id)
            if realpass_id == pass_id:
                print("try but success")
                ser.write(b"\x01")     #accepted
                IR = False
                GPIO.output(32, GPIO.LOW)
            else: 
                print("try but failed")
                ser.write(b"\x02")     #denied
                IR = True
                GPIO.output(32, GPIO.HIGH)
        except:     #if user doesn't exist(aka error detected) try: 
            print("try failed.")
            ser.write(b"\x02")         #invalid username. Denied anyways.
            IR = True
            GPIO.output(32, GPIO.HIGH)           
        finally:
            mycursor.close()
    elif msg_id == 0x03:    #IR Logs. 
        if IR == True:
            now1= datetime.datetime.now()
            now = str(now1)
            IR_LOG = open('IR_LOG.txt','a')
            IR_LOG.write("IR Sensor Tripped: ")
            IR_LOG.write(now)
            IR_LOG.write("\n")
            IR_LOG.close()
            # Attempt to send the SMS message.
            if send_textbelt_sms(phone, smsmsg, apikey):
                print('SMS message successfully sent!')
            else:
                print('Could not send SMS message.')
        else: 
            pass
        ser.write(b"\x02")  
    elif msg_id == 0x04: #Light Set. 
        ser.write(b"\x02")    #Ready to read
        mydb.close()
        mydb = mysql.connector.connect(
            host="localhost",
            user="pi",
            password="A1f2i3r4e",
            database="PROJECT2022"
        )
        mycursor = mydb.cursor()
        sqllight = "SELECT status FROM light"
        mycursor.execute(sqllight)
        t_light = mycursor.fetchone()[0]
        if t_light==1:
            ser.write(b"\x01")  #ON
            # print("Light On")
        else: 
            ser.write(b"\x02")  #OFF
            # print("Light Off")

        mycursor.close()
    elif msg_id ==0x05:     #Light Level Logs
        ser.write(b"\x02")    #Ready to read
        light_level= ser.read(1)
        y-=1
        if y==0:
            int_val = int.from_bytes(light_level,"big") #Conversion
            int_val = (int_val / 255)*100
            now1= datetime.datetime.now()
            now = str(now1)
            a = str(round(int_val,2))   #2 decimal numbers.
            print("level: %s",a)
            lightfile = open('Light_Level.txt','w')
            lightfile.write("Light Level: ")
            lightfile.write(a)
            lightfile.write("%, Time:")
            lightfile.write(now)
            lightfile.close()
            y+=1000
    elif msg_id == 0x07: #Motor
        ser.write(b"\x02")    #Ready to read
        mydb.close()
        mydb = mysql.connector.connect(
            host="localhost",
            user="pi",
            password="A1f2i3r4e",
            database="PROJECT2022"
        )
        mycursor = mydb.cursor()
        sqlmotor = "SELECT status FROM motor"
        mycursor.execute(sqlmotor)
        t_motor = mycursor.fetchone()[0]
        if drawer_stat==t_motor:    #nothing changed
            ser.write(b"\x01") 
        else:   
            print("Drawer Stat:", drawer_stat)
            print("t_motor stat:", t_motor)
            drawer_stat = t_motor
            print("Motor Status:", t_motor)
            if t_motor==1:
                ser.write(b"\x03")  #move open
                print("Open")
            else: 
                ser.write(b"\x02")  #move close
                print("Close")
        mycursor.close()

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

