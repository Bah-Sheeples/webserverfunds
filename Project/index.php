<!DOCTYPE html>
<html>
    <head>
    <a href="../index.html">Back to</a>
    </head>

    <body>
        <iframe name="hidden_iframe" width="0" height="0" style="border:none"></iframe>
        <form method="POST" action="out.php" target="hidden_iframe">
        
        <input type="submit" name="foo" value="A" />

        </form>

        <?php
            $name = $_POST['foo'];
            $fp = fopen("formdata.txt", "w");
            fwrite($fp," ")
            $savestring = $name
            fwrite($fp,$savestring)
            fclose($fp)
        ?>
    </body>
</html>

<!-- https://www.instructables.com/HTML-to-Python/  -->