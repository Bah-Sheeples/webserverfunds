<!DOCTYPE html> 

<html> 

    <head> 

        <title>Form response</title> 

    </head> 

    <body> 

        <p>Your favoured unit type is: <?= htmlspecialchars($_GET['unit-type'])?></p> 

        <p>Your favorite replay file is: <?= htmlspecialchars($_GET['replay']) ?></p> 

        <p>Search Result: <?= htmlspecialchars($_GET['search-unit']) ?></p> 

        <p>Your favoured infantry sub-type is: <?= htmlspecialchars($_GET['type-infantry']) ?></p> 
    </body> 

    <p><?= var_dump($_GET) ?></p>
    <p><?= var_dump($_POST) ?></p>

</html> 