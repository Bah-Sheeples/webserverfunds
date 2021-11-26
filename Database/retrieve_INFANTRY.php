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
            echo "<br/>";

            $inf_name=htmlspecialchars($_POST["inf_name"]);
            $faction=htmlspecialchars($_POST["faction"]);
            $type=htmlspecialchars($_POST["type"]);

            // if ($inf_name == "" && isset($faction, $type)) {
            //     $sql = "SELECT * FROM INFANTRY";
            // } elseif ($inf_name =="" && isset($type)) {
            //     $sql = "SELECT * FROM INFANTRY WHERE type='$type'";
            // } elseif ($inf_name == "" && isset($faction)) {
            //     $sql = "SELECT * FROM INFANTRY WHERE type='$type'";
            // } elseif ($inf_name == "") {
            //     $sql = "SELECT * FROM INFANTRY WHERE faction='$faction' type='$type'";
            // } elseif (isset($faction)) {
            //     $sql = "SELECT * FROM INFANTRY WHERE name='$inf_name' type='$type'";
            // } elseif (isset($faction,$type)) {
            //     $sql = "SELECT * FROM INFANTRY WHERE name='$inf_name'";
            // } elseif (isset($type)) {
            //     $sql = "SELECT * FROM INFANTRY WHERE name='$inf_name' faction='$faction'";
            // } else {
            //     $sql = "SELECT * FROM INFANTRY WHERE name='$inf_name' faction='$faction' type='$type'";
            // }

            $sql = "SELECT * FROM INFANTRY;
            $result = mysqli_query($conn, $sql);

            foreach($result as $row) {
                echo "id: {$row["id"]} | Name: {$row["name"]} | MP_VALUE: {$row["MP_VALUE"]} | Faction: {$row["faction"]} | Type: {$row["type"]} <br/>"; 
            }

            //$sql = "select * from users where {htmlspecialchars($_POST['filter1'])}={htmlspecialchars($_POST['filter2'])}

        ?>
    </body>
</html>

