function afficher_donnees(arr_retour) {
    
    afficher_message(arr_retour.message);
    
    $('.spell1').css('display','none');
    $('.spell2').css('display','none');
    $('.spell3').css('display','none');
    $('#milieu button').css('background-color','#025309');
    $('#droite button').css('background-color','#025309');
    $('#droite button').css('display','flex');
    $('#gauche button').attr('title', '');
    $('#milieu button').attr('title', '');
    $('#droite button').attr('title', '');
    if (arr_retour.mode === 'choix_hero') {
        //Display choix du hero
        $('#niveau').html(0);
        $('#etage').html(arr_retour.niveau);
        applyChange(0, 100,'','xp');
        $('#titre').html('Bienvenue dans notre super jeu. Veuillez choisir un personnage parmis les 3 proposés :');

        $('.spell1').css('display','block');
        $('.spell2').css('display','block');
        $('.spell3').css('display','block');

        $('img[alt="guerrier"]').attr('src', './ressources/guerrier.jpg');
        $('#gauche button').html('Guerrier');
        $('img[alt="mage"]').attr('src', './ressources/mage.jpg');
        $('#milieu button').html('Mage');
        $('img[alt="pretre"]').attr('src', './ressources/pretre.jpg');
        $('#droite button').html('Pretre');
        $('#monstre').css('display','none');
        $('#hero').css('display','none');
        $('img[alt="pretre"]').css('display','block');
        $('img[alt="guerrier"]').css('display','block');


    } else if (arr_retour.mode === 'choix_chemin') {
        // Display choix du chemin
        $('#niveau').html(arr_retour.hero.int_niveau);
        $('#etage').html(arr_retour.niveau);
        applyChange(arr_retour.hero.int_experience, 100,'','xp');

        $('#titre').html('Vous arrivez à une intersection, 3 choix s\'offrent à vous !<br>' +
        'Allez vous choisir la facilité et choisir l\'évènement, ou risquerez vous votre vie pour la gloire et la vie éternelle ?!');

        $('img[alt="guerrier"]').attr('src', './ressources/evenement.jpg');
        $('#gauche button').html('Evenement');
        $('img[alt="mage"]').attr('src', './ressources/' + arr_retour.monstre_1.str_image);
        $('#milieu button').html(arr_retour.monstre_1.str_nom);
        $('img[alt="pretre"]').attr('src', './ressources/' + arr_retour.monstre_2.str_image);
        $('#droite button').html(arr_retour.monstre_2.str_nom);
        $('#monstre').css('display','none');
        $('#hero').css('display','none');
        $('img[alt="pretre"]').css('display','block');
        $('img[alt="guerrier"]').css('display','block');

    } else if (arr_retour.mode === 'combat') {
        // Display mode combat
        $('#niveau').html(arr_retour.hero.int_niveau);
        $('#etage').html(arr_retour.niveau);
        $('#titre').html('Le terrifiant ' + arr_retour.monstre.str_nom + ' vous attaque !!!!');

        //$('#message').html(arr_retour.message['message']);

        $('img[alt="mage"]').attr('src', './ressources/' + arr_retour.monstre.str_image);
        $('#monstre').css('display','block');
        $('#hero').css('display','block');
        $('img[alt="pretre"]').css('display','none');
        $('img[alt="guerrier"]').css('display','none');
        $('#attaque').html(arr_retour.hero.int_attaque);
        $('#defense').html(arr_retour.hero.int_defense);
        $('#critique').html(arr_retour.hero.int_critique);
        $('#esquive').html(arr_retour.hero.int_esquive);
        applyChange(arr_retour.hero.int_pv_actuel, arr_retour.hero.int_pv,'<img class="iconPV" src="./ressources/pointvie.svg"></img>','pv');
        switch(arr_retour.hero.str_nom){
            case "Guerrier":
                $('.energie-bar').css('background-color','#cc0000');
                applyChange(arr_retour.hero.int_rage, 100,'<img class="iconPV" src="./ressources/energie.png"></img>','energie');
                if(arr_retour.hero.arr_sorts[1].int_cooldown > arr_retour.hero.arr_sorts[1].int_cd_done){
                    $('#milieu button').css('background-color','gray');
                }
                if(arr_retour.hero.arr_sorts[2] != null){
                    if(arr_retour.hero.arr_sorts[2].int_cooldown > arr_retour.hero.arr_sorts[2].int_cd_done){
                        $('#droite button').css('background-color','gray');
                    }
                    else if( 3 > arr_retour.hero.arr_sorts[2].int_cd_done){
                        $('#droite button').css('background-color','red');
                    }
                }
                break;
            case "Mage":
                $('.energie-bar').css('background-color','#0f5291');
                applyChange(arr_retour.hero.int_mana_actuel, arr_retour.hero.int_mana_max,'<img class="iconPV" src="./ressources/energie.png"></img>','energie');
                if(arr_retour.hero.int_mana_actuel < 40){
                    $('#milieu button').css('background-color','gray');
                }
                if(arr_retour.hero.arr_sorts[2] != null){
                    if(arr_retour.hero.arr_sorts[2].int_cooldown > arr_retour.hero.arr_sorts[2].int_cd_done){
                        $('#droite button').css('background-color','gray');
                    }
                }
                break;
            case "Pretre":
                $('.energie-bar').css('background-color','gold');
                applyChange(arr_retour.hero.int_foi_actuel, arr_retour.hero.int_foi_max,'<img class="iconPV" src="./ressources/energie.png"></img>','energie');
                if(arr_retour.hero.int_foi_actuel < 50){
                    $('#milieu button').css('background-color','gray');
                }
                if(arr_retour.hero.arr_sorts[2] != null){
                    if(arr_retour.hero.arr_sorts[2].int_cooldown > arr_retour.hero.arr_sorts[2].int_cd_done){
                        $('#droite button').css('background-color','gray');
                    }
                }
                break;
        }
        $('#attaqueMonstre').html(arr_retour.monstre.int_attaque);
        $('#defenseMonstre').html(arr_retour.monstre.int_defense);
        $('#critiqueMonstre').html(arr_retour.monstre.int_critique);
        $('#esquiveMonstre').html(arr_retour.monstre.int_esquive);
        
        applyChange(arr_retour.monstre.int_pv_actuel, arr_retour.monstre.int_pv,'<img class="iconPV" src="./ressources/pointvie.svg"></img>','pvMonstre');
        //applyChange(arr_retour.monstre.int_pv_actuel, arr_retour.monstre.int_pv,'<img class="iconPV" src="./ressources/energie.png"></img>','energieMonstre');
        $('#energieMonstre').html('');
        $('#gauche button').html('<img class="iconSpell" src="' + arr_retour.hero.arr_sorts[0].str_image + '" title="'+arr_retour.hero.arr_sorts[0].str_effet+'"></img>'+arr_retour.hero.arr_sorts[0].str_nom);
        $('#gauche button').attr('title', arr_retour.hero.arr_sorts[0].str_effet);
        $('#milieu button').html('<img class="iconSpell" src="' + arr_retour.hero.arr_sorts[1].str_image + '" title="'+arr_retour.hero.arr_sorts[1].str_effet+'"></img>'+arr_retour.hero.arr_sorts[1].str_nom);
        $('#milieu button').attr('title', arr_retour.hero.arr_sorts[1].str_effet);
        if(arr_retour.hero.arr_sorts[2] != null){
            $('#droite button').html('<img class="iconSpell" src="' + arr_retour.hero.arr_sorts[2].str_image + '" title="'+arr_retour.hero.arr_sorts[2].str_effet+'"></img>'+arr_retour.hero.arr_sorts[2].str_nom);
            $('#droite button').attr('title', arr_retour.hero.arr_sorts[2].str_effet);

        }else{
            $('#droite button').css('display','none');
            $('#droite button').html('');
        }
    }
    
}

function afficher_message(str,time = 2000){
    $('#message').css('display','flex');
    $('#message div').html(str);
    $('#message').fadeOut(time);
    setTimeout(function(){ $('#message').css('display','none'); }, time);
}

$(document).ready(function() {

    var int_niveau = 0;
    var id_monstre1 = id_monstre2 = id_monstre = 0;
    var str_mode = 'choix_hero';
    var obj_hero = obj_monstre = {};
    var obj_data = {};

    $('#choice_path div button').on('click', function() {

        if(str_mode === 'choix_hero') {
            obj_data = {
                'niveau': int_niveau,
                'choix': $(this).val(),
                'mode': str_mode,
            };
        } else if(str_mode === 'choix_chemin') {

            if($(this).val() === '1') {
                id_monstre = id_monstre1
            } else if($(this).val() === '2') {
                id_monstre = id_monstre2;
            }

            obj_data = {
                'niveau': int_niveau,
                'choix': $(this).val(),
                'id_monstre': id_monstre, 
                'hero': obj_hero,
                'mode': str_mode,
            };  
        } else {
            obj_data = {
                'niveau': int_niveau,
                'choix': $(this).val(),
                'hero': obj_hero,
                'monstre': obj_monstre,
                'mode': str_mode
            };
        }

        $.ajax({
            url : '../ajaxTraitement.php',
            type : 'POST', 
            data : obj_data,
            dataType : 'JSON',
            success : function(arr_retour) {
                int_niveau = arr_retour.niveau;
                obj_hero = arr_retour.hero;
                obj_monstre = arr_retour.monstre;
                str_mode = arr_retour.mode;
                id_monstre1 = arr_retour.m_id1;
                id_monstre2 = arr_retour.m_id2;
                afficher_donnees(arr_retour);
            },
            error : function(resultat, statut, erreur) {
                console.log(erreur);
            }
        });
    });
});