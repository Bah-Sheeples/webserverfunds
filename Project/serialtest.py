#!/usr/bin/env python
import serial

ser = serial.Serial (
    port='/dev/ttyAMA0',
    baudrate = 2400,
    parity=serial.PARITY_NONE,
    stopbits=serial.STOPBITS_ONE,
    bytesize=serial.EIGHTBITS,
)

while True:
    ser.write(0x9D)