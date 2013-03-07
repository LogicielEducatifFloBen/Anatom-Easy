/**
 *      exemple
 *                            
 *   var optionArray= new Array();
 *   clippyAgent(optionArray);
 * optionArray[0]= {item:'#devoir',event:'mouseover', action: 'speak', speech: 'test'};
 *          
 * optionArray[1]= {item:'#devoir',event:'mouseover', action: 'speak', speech: 'test2', timeout:'1000'};
 *          
 *          //affiché une fois au chargement
 * optionArray[2]= { action: 'speak', speech: 'test3',timeout:'2000'}; 
 
 *   clippyAgent(optionArray);
 */

agentTest=null;
function clippyAgent(optionArray,welcomeMsg, startAnimateAt){
    clippy.load('Merlin', function(agent) {
        agent.moveTo($("body").width()-200,200); 
        agentTest=agent;
        if(startAnimateAt==undefined){startAnimateAt='5000';}
        
        if(welcomeMsg==undefined){welcomeMsg="Bienvenue !";} 
        agentTest.speak(welcomeMsg) 
        setTimeout(function(){startAnimateAgent(optionArray);},startAnimateAt,optionArray);
    });
}

function startAnimateAgent(optionArray){ 
    setupEvent(optionArray); 
     animateAgentLoop() ;	 
} 

function animateAgentLoop(){
    agentTest.animate();
    setTimeout("animateAgentLoop()",(Math.floor(Math.random()*20000)+10000) );	 
}
//instancie les evennements
function setupEvent(optionArray){
    if(agentTest==null){return;}
    for (var i=0;i<optionArray.length;i++){
        if(optionArray[i].item==undefined){optionArray[i].item="body";}
        if(optionArray[i].event==undefined){
            agentEvent(optionArray[i]);
        }else{
            $(optionArray[i].item).bind(optionArray[i].event, optionArray[i], agentEvent);
        }
    }  
}

//lance la bonne anim d'aide
function agentEvent(event){
    var option;
    if(event.data==undefined){option=event;}
    else {option=event.data;}
    var action=option.action;
    if(agentTest!=null){
        if(option.timeout==undefined) {option.timeout='1';}
        var position = $(option.item).position(); 
        if(option.gotoElement){ 
            if(option.xPos==undefined) {option.xPos= -200;}
            agentTest.stop(); 
            agentTest.moveTo(position.left+$(option.item).width()+option.xPos,position.top-$(window).scrollTop());
            option.timeout= (parseInt(option.timeout)+4000)+"";
        }
        if(action =="speak"){ 
            setTimeout(function(){
                agentTest.stop();
                agentTest.stopCurrent();
                agentTest.speak(option.speech);  
            },option.timeout,option);	  
        }else{
            
        } 
    }
}



