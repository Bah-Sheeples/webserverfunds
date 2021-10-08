<!DOCTYPE html>

<html>

    <head> 

        <title>Form: select</title> 

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
            echo "<br/>"

            $sql = "SELECT * FROM INFANTRY";
            $result = mysqli_query($conn, $sql);

            foreach($result as $row) {
                echo "id: {$row["id"]} | Name: {$row["name"]} | MP_VALUE: {$row["MP_VALUE"]} | Faction: {$row["faction"]} | Type: {$row["type"]} <br/>"; 
            }

            //$sql = "select * from users where {htmlspecialchars($_POST['filter1'])}={htmlspecialchars($_POST['filter2'])}

        ?>
    </body>
<html>

