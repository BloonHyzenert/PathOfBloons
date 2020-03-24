<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
    <title>DowlGosper</title>
</head>

<body>
    <h1>DowlGosper</h1>

    <div id="plateau_jeu">
        <p>Bienvenu dans notre super jeu. Veuillez choisir parmit les 3 personnages :</p>
        <ul>
            <li>Le guerrier</li>
            <li>Le mage</li>
            <li>Le bougnoule</li>
        </ul>
    </div>

    <form id="choose_path" type="POST" action="#">
        <button type="button" value="0">Gauche</button>
        <button type="button" value="1">Milieu</button>
        <button type="button" value="2">Droite</button>
    </form>

    <script src="js/index.js"></script>
</body>
</html>
