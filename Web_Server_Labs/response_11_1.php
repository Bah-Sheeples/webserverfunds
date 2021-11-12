<!DOCTYPE html> 

<html> 
    <head> 

        <title>Form response</title> 
        <h1><a href="Web_Server_Labs/Web_Lab11.html">Web Lab 11, GPIO</a></li></h1>
    </head> 

    <body> 
        <?php
            $led=(int)($_POST["ledset"]);
            `gpio write 0 {$led}`;
        ?>
    </body> 

</html> 