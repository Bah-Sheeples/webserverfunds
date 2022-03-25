<!DOCTYPE html>

<html>

    <head> 

        <title><a href="../index.html">Back to Main page</a></title> 
    </head> 

    <body>
        <?php
            $server = "localhost";
            $username = "php";
            $password = "A1f2i3r4e";
            $database = "PROJECT2022"; 

            $conn = mysqli_connect($server, $username, $password, $database);
            // Check for successful connection
            if (!$conn) {
                die("Connection failed: " . mysqli_connect_error());
                }
            echo "Connected successfully";
            echo "<br/>";

            $motor=htmlspecialchars($_POST["motor"]);
            $light=htmlspecialchars($_POST["light"]);
        
            $sql = "Update Light Set LightLVL={$light}";
            $result = mysqli_query($conn, $sql);


        ?>

    </body> 

</html> 
