/*Javacript principal de l'application */


//Permet de rendre les lignes des tables clickable
$(document).ready(function($) {
    //Ligne table clickable
    $(".clickable-row").on("click", function () {
        window.location = $(this).data("href");
    });
})

//supression
$("[id^='delete_']").on("click", function() {
    var id = $(this).attr("id").split("_",3);
    var entity = id[1];
    var lineUpValue = id[2];
    console.log(id);

    switch (entity) {
        case 'lineUp':
          entite = "équipe"
          break;
        case 'news':
            entite = "article"
            break;
        case 'task':
            entite = "tâche"
            break;
        case 'membres':
            entite = "membre"
            break;
      
        }
        if( entite == 'membre')
        {
            if ( confirm( "Êtes-vous sur de vouloir supprimer ce " + entite + " ?" ) ) {
                deleteEntitiesSelected(entity, lineUpValue);
            }
        }else{
            if ( confirm( "Êtes-vous sur de vouloir supprimer cette " + entite + " ?" ) ) {
                deleteEntitiesSelected(entity, lineUpValue);
            } 
        }
        
   
});

function deleteEntitiesSelected(entity, entityValue)
{
    var data = {
        value : entityValue
    };

    var url = "/admin/" + entity + "/delete";
    $.ajax({
        url: url,
        type: 'DELETE',
        data: data,
        success: function(result) {
            if (result.result == 1) {
                    $(".form_edit").fadeOut(1500, function() {
                    document.location.href="/admin/" + entity;
                });
                
            }
            
        }
    });
    
}
