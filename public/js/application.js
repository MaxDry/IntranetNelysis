/*Javacript principal de l'application */


//Permet de rendre les lignes des tables clickable
$(document).ready(function ($) {
    //Ligne table clickable
    $(".clickable-row").on("click", "td:gt(0)", function () {
        window.location = $(this).parent().data("href");
    });
})