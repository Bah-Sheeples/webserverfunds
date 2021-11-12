<!DOCTYPE html> 

<html> 

    <head> 

        <title>Form response</title> 

    </head> 

    <body> 
        <?php
            $raw = `./bme280`;
            $deserialized = json_decode($raw);
            echo "Current bme280 status -"
            echo "Temperature: $deserialized->temperature"; 
            echo "Pressure: $deserialized->pressure"; 
            echo "Altitude: $deserialized->altitude";  
        ?>
    </body> 

</html> 