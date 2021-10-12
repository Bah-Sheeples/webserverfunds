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
            $database = "COH2UNIT"; 

            $conn = mysqli_connect($server, $username, $password, $database);
            // Check for successful connection
            if (!$conn) {
                die("Connection failed: " . mysqli_connect_error());
                }
            echo "Connected successfully";
            echo "<br/>";

            $inf_name=htmlspecialchars($_POST["inf_name"]);
            $MP=htmlspecialchars($_POST["MP"]);
            $faction=htmlspecialchars($_POST["faction"]);
            $type=htmlspecialchars($_POST["type"]);

        
            $sql = "INSERT INTO INFANTRY (name, MP_VALUE, faction, type) VALUES ({$inf_name}, {$MP}, {$faction}, {$type});";
            $result = mysqli_query($conn, $sql);

            // echo "<br/>";
            // echo "{$result ? "Success!" : "Failure: " . mysqli_error($conn)}"; 

            // $sql2 = "SELECT * FROM INFANTRY";
            // $rez = mysqli_query($conn, $sql2);

            // foreach($rez as $row) {
            //     echo "id: {$row["id"]} | Name: {$row["name"]} | MP_VALUE: {$row["MP_VALUE"]} | Faction: {$row["faction"]} | Type: {$row["type"]} <br/>"; 
            // }

        ?>

    </body> 

</html> 
