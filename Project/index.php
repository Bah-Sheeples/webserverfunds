<!DOCTYPE html>

<html>
    <head>
        <div> <a href="../index.html">INDEX</a></li></div>
        <title>Controller</title>
        <script>
            function openfile(){
                const xhttp = new XMLHttpRequest();
                xhttp.onload = function(){
                    document.getElementById("read").innerHTML = this.responseText;
                }
                xhttp.open("POST", "project.php");
                xhttp.send();
                
            }

            function openfile(){
                const xhttp = new XMLHttpRequest();
                xhttp.onload = function(){
                    document.getElementById("read").innerHTML = this.responseText;
                }
                xhttp.open("POST", "dht.php", true);
                xhttp.send();
                
            }
        </script>
    </head>



    <body>
        <form action="" method="POST" target="__blank">
            <p>
                <label for="light">Lights:</label>
                <select id="light" name="light">
                <option value="1">ON</option>
                <option value="0">OFF</option>
                </select>
            </p>
            <p>
                <label for="motor">Drawer:</label>
                <select id="motor" name="motor">
                <option value="1">OPEN</option>
                <option value="0">CLOSE</option>
                </select>
            </p>
            <input type="submit">
            </form>
        
        <p id="hidden" style="display:none"></p>
        <button type="button" onclick="openfile()">DHT Check</button>


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
            //echo "Connected successfully";
            //echo "<br/>";
            
            $light=htmlspecialchars($_POST["light"]);
            $motor=htmlspecialchars($_POST["motor"]);

            $sql = "Update light Set Status={$light}";
            $result = mysqli_query($conn, $sql);
            
            $sqla = "Update motor Set Status={$motor}";
            $result = mysqli_query($conn, $sqla);

            // echo $sql;
            // echo "<br/>";
            // echo $sqla;

        ?>
    </body>

</html>