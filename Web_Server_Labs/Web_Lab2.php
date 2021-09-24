<!DOCTYPE html>
<html>
    <head>
        <title>Forms for Web Lab 2</title>
    </head>
    <h1>
        Forms for Web Lab 2
    </h1>
    <h2>
        Company of Heroes 2, Survey Poll
    </h2>
    <body>

        <form action="response_2_1.php" method="GET">
            <label for="fname" hidden>First Name:</label>
            <input type="text" id="fname" pattern="[A-Za-z0-9]" title="Letters Only" hidden>  
            <label for="lname" hidden>Last Name:</label>
            <input type="text" id="lname" pattern="[A-Za-z]" title="Letters Only" hidden>

            <input type="submit" hidden>


        <p>Choose a favorite Unit Type
            <input type="radio" id="infantry" name="unit-type" value="Infantry">
            <label for="unit-type">Infantry</label>
            <input type="radio" id="team-weapon" name="unit-type" value="Team Weapons">
            <label for="unit-type">Team Weapon</label>
            <input type="radio" id="vehicles" name="unit-type" value="Vehicle">
            <label for="unit-type">Vehicles</label>
        </p>

        <p>
            <label for="replays">Submit your favorite replay</label>
            <input type="file" id="replays" name="replay">
        </p>

        <p>
            <label for="search-unit">Write your specific favorite unit</label>
            <input type="text" id="search-unit" name="search-unit" pattern="[a-zA-Z0-9]+" title="No Special Characters">
        </p>
        <p>
            <label for="type-infantry">Choose a Archetype:</label>
            <select id="type-infantry" name="type-infantry">
            <option value="Generalist">Generalist</option>
            <option value="Elite Infantry">Elite Infantry</option>
            <option value="AT Infantry">Anti-Tank Infantry</option>
            <option value="Sneaky Infantry">Sneaky Infantry</option>
            </select>
            <input type="submit">
        </p>
        </form>


        <p><?= var_dump($_GET) ?></p>
        <p><?= var_dump($_POST) ?></p>

    </body>








</html>