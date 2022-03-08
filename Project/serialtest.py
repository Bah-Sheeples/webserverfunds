#!/usr/bin/env python

ser = serial.Serial (
    port='/dev/ttyAMA0',
    baudrate = 2400,
    parity=serial.PARITY_NONE,
    stopbits=serial.STOPBITS_ONE,
    byesize=serial.EIGHTBITS,
    timeout=1
)

ser.write(0x0F)
ser.write(0xF0)
ser.write(0xE0)