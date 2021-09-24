<!DOCTYPE html> 

<html> 

    <head> 

        <title>Form response</title> 

    </head> 

    <body> 

        <p>Your favoured unit type is: <?= htmlspecialchars($_POST['unit-type'])?></p> 

        <p>Your favorite replay file is: <?= htmlspecialchars($_POST['replay']) ?></p> 

        <p>Search Result: <?= htmlspecialchars($_POST['search-unit']) ?></p> 

        <p>Your favoured infantry sub-type is: <?= htmlspecialchars($_POST['type-infantry']) ?></p> 
    </body> 

</html> 