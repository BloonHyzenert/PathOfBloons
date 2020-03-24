function afficher_donnees() {
    $('#plateau_jeu').empty();

    console.log('jaffiche des données yikes');
}

$(document).ready(function() {

    var int_niveau = 0;

    $('#choose_path button').on('click', function() {
        $.ajax({
            url : '../ajaxTraitement.php',
            type : 'POST', 
            data : {
                niveau: int_niveau,
                choix: $(this).val()
            },
            dataType : 'JSON',
            success : function(str_retour) {
                int_niveau++;
                afficher_donnees();
            },
            error : function(resultat, statut, erreur) {
                console.log(erreur);
                // Gestion de l'erreur;
            }
        });
    });
});