/*Javacript principal de l'application */


//Permet de rendre les lignes des tables clickable
$(document).ready(function($) {
    //Ligne table clickable
    $(".clickable-row").on("click", "td:gt(0)", function () {
        window.location = $(this).parent().data("href");
    });
})


//gestion des affichages des membres
document.getElementById('members_test_include').style.visibility=(false)?'visible':'hidden';
//Lors du click sur voir les membres en test
$("#members-test").on("click", function() {
    document.getElementById('members').style.visibility=(false)?'visible':'hidden';
    document.getElementById('members_test_include').style.visibility=(true)?'visible':'hidden';
});