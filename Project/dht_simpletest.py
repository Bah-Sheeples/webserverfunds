# SPDX-FileCopyrightText: 2021 ladyada for Adafruit Industries
# SPDX-License-Identifier: MIT

import adafruit_dht

# Initial the dht device, with data pin connected to:
DHT_SENSOR = Adafruit_DHT.DHT22
DHT_PIN = 6

# you can pass DHT22 use_pulseio=False if you wouldn't like to use pulseio.
# This may be necessary on a Linux single board computer like the Raspberry Pi,
# but it will not work in CircuitPython.
# dhtDevice = adafruit_dht.DHT22(board.D18, use_pulseio=False)

while True:
    humidity, temperature = Adafruit_DHT.read_retry(DHT_SENSOR, DHT_PIN)

    if humidity is not None and temperature is not None:
        print("Temp={0:0.1f}*C  Humidity={1:0.1f}%".format(temperature, humidity))
    else:
        print("Failed to retrieve data from humidity sensor")

        DHT_LOG = open('DHT_LOG.txt','w')
        DHT_LOG.write("Temp: {:.1f} C    Humidity: {}% ".format(temperature, humidity))
        DHT_LOG.write("\n")
        DHT_LOG.close()

    
    time.sleep(2.0)

# https://learn.adafruit.com/dht-humidity-sensing-on-raspberry-pi-with-gdocs-logging/python-setup 