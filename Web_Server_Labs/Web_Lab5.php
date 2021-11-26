<!DOCTYPE html>
<html>

    <head>
    <div> <a href="../index.html">INDEX</a></li></div>    
    Lab 5</head>

    <body>

        <h1>
            Your Current User Agent is:
        </h1>

        <p><?= var_dump($_SERVER) ?> </p>
        <div>
            <?= htmlspecialchars($_SERVER['HTTP_USER_AGENT'])?>

        </div>

    </body>

</html>