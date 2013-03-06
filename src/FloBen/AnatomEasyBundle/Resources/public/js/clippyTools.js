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
function clippyAgent(optionArray){
    clippy.load('Merlin', function(agent) {
        agent.moveTo($("body").width()-200,100); 
        agentTest=agent;
        setupEvent(optionArray); 
    });
}
function animateAgent(){
    agentTest.animate()
    setTimeout("animateAgent()",(Math.floor(Math.random()*40000)+5000) );	 
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
    setTimeout("animateAgent()",'5000');  
}

//lance la bonne anim d'aide
function agentEvent(event){
    var option;
    if(event.data==undefined){option=event;}
    else {option=event.data;}
    var action=option.action;
    if(agentTest!=null){
        if(option.timeout==undefined) {option.timeout='1';}
        if(option.gotoElement){  
            var position = $(option.item).position(); 
            agentTest.moveTo(position.left+$(option.item).width()-200,position.top-$(window).scrollTop());
            option.timeout= (parseInt(option.timeout)+4000)+"";
        }
        if(action =="speak"){
            setTimeout(function(){agentTest.speak(option.speech);},option.timeout,event);	  
        }else{
            
        } 
    }
}



