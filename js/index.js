function afficher_donnees() {
    console.log('jaffiche des données yikes');
}

$(document).ready(function() {

    var int_niveau = 0;

    $('#choose_path button').on('click', function() {
        $.ajax({
            url : '../index.php',
            type : 'POST', 
            data : {
                niveau: int_niveau
            },
            dataType : 'JSON',
            success : function(str_retour) {
                afficher_donnees();
            },
            error : function(resultat, statut, erreur){
                // Gestion de l'erreur;
            }
        });
    });
});