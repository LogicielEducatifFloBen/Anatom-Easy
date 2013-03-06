
function initClippyWithEvent(optionArray){
    clippy.load('Links', function(agent) {
        agent.show();
        agent.animate();
        for (i=0;i<optionArray.length;i++){   
            $(optionArray[i]['item']).on(optionArray[i]['event'] , optionArray[i].action ); 
        }
    });
}
