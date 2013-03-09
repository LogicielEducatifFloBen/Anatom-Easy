
function sendResult(success,erreurs,temps){ 
        var score = 0;
        if(success)var score = (essaiRestants/essais)*100; 
        $(".clickable").off('click').removeClass("clickable");
        $.post(window.location.pathname+"/register", { 'success': success, 'score' :score, 'secondSpent':temps }); 
    
}
