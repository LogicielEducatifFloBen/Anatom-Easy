var chrono=0; 
    function sendResult(success,scoreF){
            if(agentTest!=null){
                agentTest.speak("Une nouvelle partie va bientôt commencer !");
            }  
            $(".clickable").off('click').removeClass("clickable");
            $.post(window.location.pathname+"/register", { 'success': success, 'score' :scoreF, 'secondSpent':chrono }); 
            setTimeout(function() {document.location.reload(true)}, 15000); 
    }
    
$(document).ready(function() { 
    setTimeout(function() {startChrono();}, 1000);
    
});

function startChrono(){
    chrono++;
    setTimeout(function() {startChrono();}, 1000);
}


