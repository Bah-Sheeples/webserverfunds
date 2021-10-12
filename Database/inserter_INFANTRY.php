<!DOCTYPE html>

<html>

    <head> 

        <title>Form </title> 

    </head> 

    <body>
        <?php
            $server = "localhost";
            $username = "php";
            $password = "A1f2i3r4e";
            $database = "COH2UNIT"; 

            $conn = mysqli_connect($server, $username, $password, $database);
            // Check for successful connection
            if (!$conn) {
                die("Connection failed: " . mysqli_connect_error());
                }
            echo "Connected successfully";
            echo "<br/>";

            $sql = "INSERT INTO INFANTRY (name, MP_VALUE, faction, type)
                VALUES {htmlspecialchars($_POST['inf_name'])}, {htmlspecialchars($_POST[MP])}', '{htmlspecialchars($_POST['faction'])}, {htmlspecialchars($_POST['type'])};";
            $result = mysqli_query($conn, $sql);

            echo "<br/>";
            echo "{$result ? "Success!" : "Failure: " . mysqli_error($conn)}"; 
        ?>

    </body> 

</html> 
