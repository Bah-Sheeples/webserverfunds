<!DOCTYPE html>

<html>

    <head> 

        <title><a href="../index.html">Back to Main page</a></title> 
    </head> 

    <body>
        <?php
            $server = "localhost";
            $username = "pi";
            $password = "A1f2i3r4e";
            $database = "PROJECT2022"; 

            $conn = mysqli_connect($server, $username, $password, $database);
            // Check for successful connection
            if (!$conn) {
                die("Connection failed: " . mysqli_connect_error());
                }
            echo "Connected successfully";
            echo "<br/>";
            
            $light=htmlspecialchars($_POST["light"]);
            $motor=htmlspecialchars($_POST["motor"]);

            $sql = "Update light Set Status={$light}";
            $result = mysqli_query($conn, $sql);
            
            $sqla = "Update motor Set Status={$motor}";
            $result = mysqli_query($conn, $sqla);

            echo $sql;
            echo "<br/>";
            echo $sqla;

        ?>

    </body> 

</html> 
