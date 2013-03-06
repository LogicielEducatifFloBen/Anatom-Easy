
function initClippyWithEvent(optionArray){
    clippy.load('Links', function(agent) {
        agent.animate();
        agent.show();
        for (i=0;i<optionArray.length;i++){   
            $(optionArray[i]['item']).on(optionArray[i]['event'] , optionArray[i]['action'].call()); 
        }
    });
}
