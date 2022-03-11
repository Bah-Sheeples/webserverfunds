#!/usr/bin/env python
import serial

ser = serial.Serial (
    port='/dev/ttyUSB0',
    baudrate = 2400,
    parity=serial.PARITY_NONE,
    stopbits=serial.STOPBITS_ONE,
    bytesize=serial.EIGHTBITS
)

x=0
while True:
    ser.write(b"2")
    x+=1
    if x==5
        break
print("Done")