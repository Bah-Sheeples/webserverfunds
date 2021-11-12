<!DOCTYPE html> 

<html> 
    <head> 

        <title>Form response</title> 

    </head> 

    <body> 
        <?php
            $led=(int)($_POST["ledset"]);
            `gpio write 0 {$led}`;


        ?>
    </body> 

</html> 