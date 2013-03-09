
var mot="";
var motCaseInsensitive="";
var chrono=0;
var essais=8;
var essaiRestants=8;
var lettreRestantes=0;

function startPendu(niveau,mots){
    $("table img").hide();
    
    mot=mots[niveau][Math.floor(Math.random()*mots[niveau].length)]; 
    showSecretWord(mot);
    motCaseInsensitive=removeAccent(mot);
    
    var abc=new Array("a", "b", "c", "d", "e", "f", "g", "h", "i", "j", "k", "l", "m", "n", "o", "p", "q", "r", "s", "t", "u", "v", "w", "x", "y", "z");
    var container= $("#penduGame"); 
    for(i=0;i<abc.length;i++){
        container.children("#letters-container")
                 .append($('<span>'+abc[i]+'</span>')
                     .addClass("pendu-letters")
                     .addClass("clickable")
                     .click(function(){
                        clickLetter($(this));
                     } )
                 )
        ;
    }
    setTimeout(function() {startChrono();}, 1000);
}

function clickLetter(letterdiv){
    var letter=letterdiv.html();
    letterdiv.off('click').removeClass("clickable");
    var letterFound=false;
    for (var i = 0, len = motCaseInsensitive.length; i < len; i++) {
        if(motCaseInsensitive[i]==letter){
            //lettre trouvé
            letterFound=true;
            lettreRestantes--;
            //réveler lettre
            $("#secret-word-container span").eq(i).html(mot[i]); 
        }
    }
    if(!letterFound){
        //lettres non-trouvées
        if(essaiRestants<5 && essaiRestants!=2){ 
            $('table img[name="'+(essaiRestants)+'"]').hide();
        }
        essaiRestants--;
        $('table img[name="'+essaiRestants+'"]').show();
    }
    if(essaiRestants<1){ 
        endGame(false,8,chrono);
    }
    if(lettreRestantes<1){
        var erreur=essais-essaiRestants;
        endGame(true,erreur,chrono);
    }
} 

function endGame(success,erreurs,temps){
        $(".clickable").off('click').removeClass("clickable");
        if(success){
            alert("gagné !!");
        }else{
            alert("perdu :(");
        
        }
    
}
function showSecretWord(){
    var containerContent=$('<div id="letter-container"></div>');
    for (var i = 0, len = mot.length; i < len; i++) {
        if(mot[i]==" "){
             containerContent.append('<span class="blank"> </span>');
        }else{
            lettreRestantes++;
            containerContent.append('<span class="letter">_</span');
        }
    } 
    $("#secret-word-container").html(containerContent);
}

function removeAccent(s){
    var r=s.toLowerCase();
    r = r.replace(new RegExp("\\s", 'g')," ");
    r = r.replace(new RegExp("[àáâãäå]", 'g'),"a");
    r = r.replace(new RegExp("æ", 'g'),"ae");
    r = r.replace(new RegExp("ç", 'g'),"c");
    r = r.replace(new RegExp("[èéêë]", 'g'),"e");
    r = r.replace(new RegExp("[ìíîï]", 'g'),"i");
    r = r.replace(new RegExp("ñ", 'g'),"n");
    r = r.replace(new RegExp("[òóôõö]", 'g'),"o");
    r = r.replace(new RegExp("œ", 'g'),"oe");
    r = r.replace(new RegExp("[ùúûü]", 'g'),"u");
    r = r.replace(new RegExp("[ýÿ]", 'g'),"y");
    r = r.replace(new RegExp("\\W", 'g')," ");
    return r;
} 
function startChrono(){
    chrono++;
    setTimeout(function() {startChrono();}, 1000);
} 
             