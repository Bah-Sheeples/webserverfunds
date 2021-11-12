<!DOCTYPE html> 

<html> 

    <head> 

        <title>Form response</title> 

    </head> 

    <body> 
        <?php
            $raw = `./bme280`;
            $deserialized = json_decode($raw);
            echo "Current bme280 status -";
            echo "<br/>";
            echo "Temperature: $deserialized->temperature"; 
            echo "<br/>";
            echo "Pressure: $deserialized->pressure"; 
            echo "<br/>";
            echo "Altitude: $deserialized->altitude";  
        ?>
    </body> 

</html> 