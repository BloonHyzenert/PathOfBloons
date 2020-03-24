function afficher_donnees(str_retour) {
    //$('#plateau_jeu').empty();

    if (str_retour.mode === 'choix_chemin') {
        //Display choix du chemin
    } else if (str_retour.mode === 'combat') {
        //Display mode combat
    }
}

$(document).ready(function() {

    var int_niveau = 0;
    var obj_hero = obj_monstre = {};
    $('#choose_path button').on('click', function() {
        $.ajax({
            url : '../ajaxTraitement.php',
            type : 'POST', 
            data : {
                niveau: int_niveau,
                choix: $(this).val(),
                hero: obj_hero,
                monstre: obj_monstre
            },
            dataType : 'JSON',
            success : function(str_retour) {
                int_niveau++;
                obj_hero = str_retour.hero;
                console.log(str_retour);
                afficher_donnees(str_retour);
            },
            error : function(resultat, statut, erreur) {
                console.log(erreur);
            }
        });
    });
});