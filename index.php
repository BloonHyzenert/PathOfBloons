<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <link rel="stylesheet" type="text/css" href="css/healthBar.css">
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
    <title>Path of Bloons</title>
</head>

<body>
    <h1>Path of Bloons</h1>
        <div id="hero">
            <div class="container">
            <div class="col-md-12">
                <div class="health-box">
                    <div class="health-bar-red"></div>
                    <div class="health-bar-blue"></div>
                    <div class="health-bar"></div>
                    <div class="health-bar-text"></div>
                </div>
            </div>
            </div>
            <div id="stat">
                <div>
                    <img class="icon" src="./ressources/epee.png"></img>
                    <p>12</p>
                </div>
                <div>
                    <img class="icon" src="./ressources/critique.png"></img>
                    <p>100%</p>
                </div>
                <div>
                    <img class="icon" src="./ressources/bouclier.png"></img>
                    <p>5</p>
                </div>
                <div>
                    <img class="icon" src="./ressources/esquive.png"></img>
                    <p>30</p>
                </div>
            </div>
        </div>

    <div id="plateau_jeu">
        <p id="titre">Bienvenu dans notre super jeu. Veuillez choisir parmit les 3 personnages :</p>
    <div id="choice_path">
        <img class="image" src="./ressources/guerrier.jpg"></img>
        <img class="image" src="./ressources/mage.jpg"></img>
        <img class="image" src="./ressources/pretre.jpg"></img>
    </div>
    <form id="choose_path" type="POST" action="#">
        <button class="blur" type="button" value="0">Guerrier</button>
        <button class="blur" type="button" value="1">Mage</button>
        <button class="blur" type="button" value="2">Prêtre</button>
    </form>
    </div>


    <script src="js/index.js"></script>
    <script type="text/javascript" src="js/healthBar.js"></script>
</body>
</html>
