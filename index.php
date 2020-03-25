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
    <div id="plateau_jeu">
        <p id="titre">Bienvenu dans notre super jeu. Veuillez choisir un personnage parmit les 3 proposés :</p>
        <div id="choice_path">
            <div id="hero">
                <div id="titre">Hero</div>
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
                    <div class="row">
                        <img class="icon" src="./ressources/epee.png"></img>
                        <div class="text">12</div>
                    </div>
                    <div class="row">
                        <img class="icon" src="./ressources/critique.png"></img>
                        <div class="text">12</div>
                    </div>
                    <div class="row">
                        <img class="icon" src="./ressources/bouclier.png"></img>
                        <div class="text">12</div>
                    </div>
                    <div class="row">
                        <img class="icon" src="./ressources/esquive.png"></img>
                        <div class="text">12</div>
                    </div>
                </div>
            </div>
            <img class="image" alt="guerrier" src="./ressources/guerrier.jpg"></img>
            <img class="image" alt="mage" src="./ressources/mage.jpg"></img>
            <img class="image" alt="pretre" src="./ressources/pretre.jpg"></img>
            <div id="monstre">
                <div id="titre">Monstre</div>
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
                    <div class="row">
                        <img class="icon" src="./ressources/epee.png"></img>
                        <div class="text">12</div>
                    </div>
                    <div class="row">
                        <img class="icon" src="./ressources/critique.png"></img>
                        <div class="text">12</div>
                    </div>
                    <div class="row">
                        <img class="icon" src="./ressources/bouclier.png"></img>
                        <div class="text">12</div>
                    </div>
                    <div class="row">
                        <img class="icon" src="./ressources/esquive.png"></img>
                        <div class="text">12</div>
                    </div>
                </div>
            </div>
        </div>
        <form id="choose_path" type="POST" action="#">
            <button class="blur" type="button" value="0">Guerrier</button>
            <button class="blur" type="button" value="1">Mage</button>
            <button class="blur" type="button" value="2">Prêtre</button>
        </form>
        <p id='message'></p>
    </div>


    <script src="js/index.js"></script>
    <script type="text/javascript" src="js/healthBar.js"></script>
</body>
</html>
