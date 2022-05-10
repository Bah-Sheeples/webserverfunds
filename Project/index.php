<!DOCTYPE html>

<html>
    <head>
        <div> <a href="../index.html">INDEX</a></li></div>
        <title>Controller</title>
        <script>
            
            function openfile2(){
                const xhttp = new XMLHttpRequest();
                xhttp.onload = function(){
                    document.getElementById("read").innerHTML = this.responseText;
                }
                xhttp.open("GET", "Light_Level.txt", true);
                xhttp.send();
                
            }

            function openfile(){
                const xhttp = new XMLHttpRequest();
                xhttp.onload = function(){
                    document.getElementById("read").innerHTML = this.responseText;
                }
                xhttp.open("GET", "DHT_LOG.txt", true);
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
        

        <p>DHT Values</p>
        <p id="read">Temporary Values</p>
        <button type="button" onclick="openfile()">DHT Check</button>
        
        <p>Light Values</p>
        <p id="read">Temporary Values</p>
        <button type="button" onclick="openfile2()">Light Check</button>

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