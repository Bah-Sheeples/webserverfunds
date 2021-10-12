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

            echo 'value: {htmlspecialchars($_POST["inf_name"])}';
            //$sql = "inf_name: {htmlspecialchars($_POST["inf_name"])}";
            //echo $sql;
            // "INSERT INTO INFANTRY (name, MP_VALUE, faction, type) VALUES ({htmlspecialchars($_POST['inf_name'])},{htmlspecialchars($_POST['MP'])}, {htmlspecialchars($_POST['faction'])}, {htmlspecialchars($_POST['type'])});";
            //$sql = "INSERT INTO INFANTRY (name, MP_VALUE, faction, type) VALUES ({htmlspecialchars($_POST['inf_name'])}, {htmlspecial
            // $result = mysqli_query($conn, $sql);

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
