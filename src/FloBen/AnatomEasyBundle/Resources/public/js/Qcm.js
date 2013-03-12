function Qcm (){


	this.questionArray  = new Array();
	self                = this;
	
	this.StartQcm = function(){
	
		
		$.each(this.questionArray,function(numQuestion,question){
	
			$("#question_container").append(self.constructQuestion(numQuestion,question)).addClass("question "+numQuestion);
			$("#question_container").append("<br>");
              
			  
			 /**  <div id="question_0" class="div_questionnaire" >
			qu'elle est votre sexe : <br />
			Homme : <INPUT type=radio name="sexe" value="M">
			<br>Femme : <INPUT type=radio name="sexe" value="F">
			<br/><button onClick="ouvrir_fermer('response_0','question_0');">J'ai fini!</button>
		</div>**/
		});
		
	}
	
	this.constructQuestion = function (numQuestion,question){
	
			var newQuestion =$("<div>");
			$.each( question, function( key, value ) {
				
				switch(key){
					case 'intitule': newQuestion.append("<h1>"+value+'</h1>').addClass(key);
									break;
					case 'choix': 	
				
									for(i=0;i<value.length;i++){
											newQuestion.append( "<input type=radio name="+numQuestion+" value="+i+">"+"<h2>"+value[i]+"</h2>").addClass(key);
												newQuestion.append("<br>");
									};
									
									break;
							
					case 'reponse': alert(value);
									break;
				}
				
			});
		return newQuestion;
	}
		/*	container.children("#question-container")
                 .append($('<h1>'+abc[i]+'</h1>')
                     .addClass("pendu-letters")
                     .addClass("clickable")
                     .click(function(){
                        clickLetter($(this));
                     } )
              )
			  
			   <div id="question_0" class="div_questionnaire" >
			qu'elle est votre sexe : <br />
			Homme : <INPUT type=radio name="sexe" value="M">
			<br>Femme : <INPUT type=radio name="sexe" value="F">
			<br/><button onClick="ouvrir_fermer('response_0','question_0');">J'ai fini!</button>
		</div>*/
	
	
	
	this.AddQuestion = function(intitule, choix, reponse){
		
	var question = {
				"intitule": intitule,
				"choix": choix,
				"reponse": reponse
				};
		this.questionArray.push(question);
	
	
	}



	function startChrono(){
		chrono++;
		setTimeout(function() {startChrono();}, 1000);
	}
 }