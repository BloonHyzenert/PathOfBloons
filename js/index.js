function afficher_donnees(arr_retour) {
    //$('#plateau_jeu').empty();

    if (arr_retour.mode === 'choix_chemin') {
        //Display choix du chemin
        $('#titre').html('Vous arrivez à une intersection, 3 choix s\'offre à vous !<br>' +
        'Allez vous choisir la facilité et choisir l\'évènement, ou risquerez vous votre vie pour la glorie et la vie éternel ?!');
        $('img[alt="guerrier"]').attr('src', './ressources/evenement.jpg');
        $('img[alt="mage"]').attr('src', './ressources/' + arr_retour.monstre1);
        $('img[alt="pretre"]').attr('src', './ressources/' + arr_retour.monstre2);
    } else if (arr_retour.mode === 'combat') {
        //Display mode combat
        $('#titre').html('Le terifiant ' + arr_retour.monstre.str_nom + ' vous attaque !!!!');
        $('img[alt="Mage"]').attr('src', arr_retour.monstre.str_image);
    }
}

$(document).ready(function() {

    var int_niveau = 0;
    var str_mode = 'choix_hero';
    var obj_hero = obj_monstre = {};

    $('#choose_path button').on('click', function() {
        $.ajax({
            url : '../ajaxTraitement.php',
            type : 'POST', 
            data : {
                niveau: int_niveau,
                choix: $(this).val(),
                hero: obj_hero,
                monstre: obj_monstre,
                mode: str_mode
            },
            dataType : 'JSON',
            success : function(arr_retour) {
                int_niveau = arr_retour.niveau;
                obj_hero = arr_retour.hero;
                obj_monstre = arr_retour.monstre;
                str_mode = arr_retour.mode;

                afficher_donnees(arr_retour);
            },
            error : function(resultat, statut, erreur) {
                console.log(erreur);
            }
        });
    });
});