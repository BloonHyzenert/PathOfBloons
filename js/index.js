function afficher_donnees() {
    console.log('jaffiche des données yikes');
}

$(document).ready(function() {

    var int_niveau = 0;

    $('#choose_path button').on('click', function() {
        $.ajax({
            url : '../Class/ajaxTraitement.php',
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
            error : function(resultat, statut, erreur){
                // Gestion de l'erreur;
            }
        });
    });
});