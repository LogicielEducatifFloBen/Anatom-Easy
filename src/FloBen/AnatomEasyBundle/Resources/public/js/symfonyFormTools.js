

function showForm(prototypeId,add) {
    // On récupère la balise <div> en question qui contient l'attribut « data-prototype » qui nous intéresse.
    var $container = $('div#'+prototypeId);

    if(!add){
        var $prototype = $($container.attr('data-prototype').replace(/__name__label__/g, '').replace(/__name__/g, ''));
        $container.append($prototype);
    }else{
        var $lienAjout = $('<a href="#" class="btn btn-success" id="ajout_'+prototypeId+'" class="btn"><i class="icon-plus icon-white"></i>Ajouter</a>');
        $container.append($lienAjout);

        // On ajoute un nouveau champ à chaque clic sur le lien d'ajout.
        $lienAjout.click(function(e) {
            ajouter($container);
            e.preventDefault(); // évite qu'un # apparaisse dans l'URL
            return false;
        });
        
        // On définit un compteur unique pour nommer les champs qu'on va ajouter dynamiquement
        var index = $container.find(':input').length;

        // On ajoute un premier champ directement s'il n'en existe pas déjà un (cas d'un nouvel article par exemple).
        if (index == 0) {
            ajouter($container);
        } else {
            // Pour chaque catégorie déjà existante, on ajoute un lien de suppression
            $container.children('div').each(function() {
                ajouterLienSuppression($(this));
            });
        }
        
        // La fonction qui ajoute un formulaire Categorie
        function ajouter($container) {
            // Dans le contenu de l'attribut « data-prototype », on remplace :
            // - le texte "__name__label__" qu'il contient par le label du champ
            // - le texte "__name__" qu'il contient par le numéro du champ
            var $prototype = $($container.attr('data-prototype').replace(/__name__label__/g, 'n°' + (index+1))
                                                                .replace(/__name__/g, index));

            // On ajoute au prototype un lien pour pouvoir supprimer la catégorie
            ajouterLienSuppression($prototype);

            // On ajoute le prototype modifié à la fin de la balise <div>
            $container.append($prototype);

            // Enfin, on incrémente le compteur pour que le prochain ajout se fasse avec un autre numéro
            index++;
        }

        // La fonction qui ajoute un lien de suppression d'une catégorie
        function ajouterLienSuppression($prototype) {
            // Création du lien
            $lienSuppression = $('<a href="#" class="btn btn-danger">Supprimer</a>');

            // Ajout du lien
            $prototype.append($lienSuppression);

            // Ajout du listener sur le clic du lien
            $lienSuppression.click(function(e) {
                $prototype.remove();
                e.preventDefault(); // évite qu'un # apparaisse dans l'URL
                return false;
            });
        }
    }
}
    

