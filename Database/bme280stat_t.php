
<?php
    $raw = `./bme280`;
    $deserialized = json_decode($raw);
    echo "Temperature: $deserialized->temperature"; 
?>
