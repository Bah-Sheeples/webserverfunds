import RPi.GPIO

GPIO.setmode(GPIO.BCM)
GPIO.setup(29,GPIO.OUT)
GPIO.output(29,GPIO.HIGH)