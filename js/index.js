function afficher_donnees(arr_retour) {
    
    $('#niveau').html(arr_retour.hero.int_niveau);
    $('#etage').html(arr_retour.niveau);
    $('.spell1').css('display','none');
    $('.spell2').css('display','none');
    $('.spell3').css('display','none');
    $('#message').css('display','flex');

    if (arr_retour.mode === 'choix_hero') {
        //Display choix du hero


    } else if (arr_retour.mode === 'choix_chemin') {
        // Display choix du chemin
        $('#titre').html('Vous arrivez à une intersection, 3 choix s\'offre à vous !<br>' +
        'Allez vous choisir la facilité et choisir l\'évènement, ou risquerez vous votre vie pour la gloire et la vie éternel ?!');

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
        $('#titre').html('Le terifiant ' + arr_retour.monstre.str_nom + ' vous attaque !!!!');

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
                applyChange(arr_retour.hero.int_rage, 100,'<img class="iconPV" src="./ressources/energie.png"></img>','energie');
                break;
            case "Mage":
                applyChange(arr_retour.hero.int_mana, 100,'<img class="iconPV" src="./ressources/energie.png"></img>','energie');
                break;
            case "Pretre":
                applyChange(arr_retour.hero.int_foi, 100,'<img class="iconPV" src="./ressources/energie.png"></img>','energie');
                break;
        }
        //$("#pv").html("<img class=\"iconPV\" src=\"./ressources/pointvie.svg\"></img>" + arr_retour.hero.int_pv_actuel + "/" + arr_retour.hero.int_pv);
        //$("#energie").html("<img class=\"iconPV\" src=\"./ressources/energie.png\"></img>" + arr_retour.hero.int_pv_actuel + "/" + arr_retour.hero.int_pv);
        $('#attaqueMonstre').html(arr_retour.monstre.int_attaque);
        $('#defenseMonstre').html(arr_retour.monstre.int_defense);
        $('#critiqueMonstre').html(arr_retour.monstre.int_critique);
        $('#esquiveMonstre').html(arr_retour.monstre.int_esquive);
        
        applyChange(arr_retour.monstre.int_pv_actuel, arr_retour.monstre.int_pv,'<img class="iconPV" src="./ressources/pointvie.svg"></img>','pvMonstre');
        applyChange(arr_retour.monstre.int_pv_actuel, arr_retour.monstre.int_pv,'<img class="iconPV" src="./ressources/energie.png"></img>','energieMonstre');
        //$("#pvMonstre").html("<img class=\"iconPV\" src=\"./ressources/pointvie.svg\"></img>" + arr_retour.monstre.int_pv_actuel + "/" + arr_retour.monstre.int_pv);
        //$("#energieMonstre").html("<img class=\"iconPV\" src=\"./ressources/energie.png\"></img>" + arr_retour.monstre.int_pv_actuel + "/" + arr_retour.monstre.int_pv);
        
        $('#gauche button').html('<img class="iconSpell" src="./ressources/justice.png" title="'+arr_retour.hero.arr_sorts[0].str_effet+'"></img>'+arr_retour.hero.arr_sorts[0].str_nom);
        $('#milieu button').html('<img class="iconSpell" src="./ressources/justice.png" title="'+arr_retour.hero.arr_sorts[1].str_effet+'"></img>'+arr_retour.hero.arr_sorts[1].str_nom);
        $('#droite button').html('XXXXXX'/*arr_retour.hero.arr_sorts[2].str_nom*/);
    }
    $('#message').fadeOut(2000);
    setTimeout(function(){ $('#message').css('display','none'); }, 2000);
    
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