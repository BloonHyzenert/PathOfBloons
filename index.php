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
        <div id="enTete">
            <div class="coin">Niveau <p id="niveau" class="coinNumber"> 0</p></div>
            <p id="titre">Bienvenue dans notre super jeu. Veuillez choisir un personnage parmit les 3 proposés :</p>
            <div class="coin">Etage <p id="etage" class="coinNumber"> 0</p></div>
        </div>
        <form id="choice_path" type="POST" action="#">
            <div class="choice" id="gauche">
                <div id="hero">
                    <div class="titre2">Hero</div>
                    <div class="container">
                        <div class="col-md-12">
                            <div class="health-box">
                                <div class="health-bar-red"></div>
                                <div class="health-bar-blue"></div>
                                <div class="health-bar"></div>
                                <div class="health-bar-text" id="pv"></div>
                            </div>
                        </div>
                    </div>
                    <div class="container">
                        <div class="col-md-12">
                            <div class="energie-box">
                                <div class="energie-bar-red"></div>
                                <div class="energie-bar-blue"></div>
                                <div class="energie-bar"></div>
                                <div class="energie-bar-text" id="energie"></div>
                            </div>
                        </div>
                    </div>
                    <div id="stat">
                        <div class="row">
                            <img class="icon" src="./ressources/epee.png"></img>
                            <div class="text" id="attaque">12</div>
                        </div>
                        <div class="row">
                            <img class="icon" src="./ressources/critique.png"></img>
                            <div class="text" id="critique">12</div>
                        </div>
                        <div class="row">
                            <img class="icon" src="./ressources/bouclier.png"></img>
                            <div class="text" id="defense">12</div>
                        </div>
                        <div class="row">
                            <img class="icon" src="./ressources/esquive.png"></img>
                            <div class="text" id="esquive">12</div>
                        </div>
                    </div>
                </div>
                <img class="image" alt="guerrier" src="./ressources/guerrier.jpg"></img>
                <button class="blur" type="button" value="0">Guerrier</button>
            </div>
            <div class="choice" id="milieu">
                <img class="image" alt="mage" src="./ressources/mage.jpg"></img>
                <button class="blur" type="button" value="1">Mage</button>
            </div>
            <div class="choice" id="droite">
            <div id="monstre">
                <div class="titre2">Monstre</div>
                <div class="container">
                    <div class="col-md-12">
                        <div class="health-box">
                            <div class="health-bar-red"></div>
                            <div class="health-bar-blue"></div>
                            <div class="health-bar"></div>
                            <div class="health-bar-text" id="pvMonstre"></div>
                        </div>
                    </div>
                </div>
                <div class="container">
                    <div class="col-md-12">
                        <div class="energie-box">
                            <div class="energie-bar-red"></div>
                            <div class="energie-bar-blue"></div>
                            <div class="energie-bar"></div>
                            <div class="energie-bar-text" id="energieMonstre"></div>
                        </div>
                    </div>
                </div>
                <div id="stat">
                    <div class="row">
                        <img class="icon" src="./ressources/epee.png"></img>
                        <div class="text" id="attaqueMonstre">12</div>
                    </div>
                    <div class="row">
                        <img class="icon" src="./ressources/critique.png"></img>
                        <div class="text" id="critiqueMonstre">12</div>
                    </div>
                    <div class="row">
                        <img class="icon" src="./ressources/bouclier.png"></img>
                        <div class="text" id="defenseMonstre">12</div>
                    </div>
                    <div class="row">
                        <img class="icon" src="./ressources/esquive.png"></img>
                        <div class="text" id="esquiveMonstre">12</div>
                    </div>
                </div>
            </div>
                <img class="image" alt="pretre" src="./ressources/pretre.jpg"></img>
                <button class="blur" type="button" value="2">Prêtre</button>
            </div>
        </form>
        <p id='message'></p>
    </div>


    <script src="js/index.js"></script>
    <script type="text/javascript" src="js/healthBar.js"></script>
</body>
</html>
