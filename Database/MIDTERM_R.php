<!DOCTYPE html>

<html>

    <head> 

        <title>Form: mid-term insert</title> 

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

            $sql = "INSERT INTO Products (product_name, num_items)
                VALUES {htmlspecialchars($_POST['prod'])}, {htmlspecialchars($_POST[num_items])}";
            $result = mysqli_query($conn, $sql);

            echo "<br/>";
            echo "{$result ? "Success!" : "Failure: " . mysqli_error($conn)}";

            //$sql = "select * from users where {htmlspecialchars($_POST['filter1'])}={htmlspecialchars($_POST['filter2'])}

        ?>
    </body>
<html>
