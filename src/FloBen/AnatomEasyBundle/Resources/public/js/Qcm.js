function Qcm (){


	this.questionArray  = new Array();
	self                = this;
	this.coursUrl       = '';
	
	
	this.StartQcm = function(coursUrl){
	
		$("#verify").click(function() {
		  self.Verify();
		});
		this.coursUrl=coursUrl;	
		$.each(this.questionArray,function(numQuestion,question){
	
			$("#question_container").append(self.constructQuestion(numQuestion,question));
			$("#question_container").append("<br>");
              
			  

		});
		
	}
	
	this.constructQuestion = function (numQuestion,question){
		
			var newQuestion =$("<div class="+numQuestion+">").addClass("question");
			$.each( question, function( key, value ) {
				
				switch(key){
					case 'intitule': newQuestion.append("<h1>"+value+'</h1>');
									break;
					case 'choix': 	
				
									for(i=0;i<value.length;i++){
											var newInput = $("<span>"+i+".</span><input type=radio name="+numQuestion+" value="+i+">"+"<h2>"+value[i]+"</h2>").addClass(key);
											newQuestion.append(newInput);
												newQuestion.append("<br>");
									};
									
									break;
							
					case 'reponse':			var newReponse = $("<input type=hidden name='reponse' value="+value+">");
											newQuestion.append(newReponse);
											newQuestion.append("<br>");
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
	
	this.Verify = function(){
		
		$(".correction").remove();
		$(".question").each(function( key, value ) {
			
			var choix = $(this).children('input:checked').val();
			var reponse = $(this).children('input[name=reponse]').val();
			
			if(choix == undefined){
				var divCorrect= $("<span class='correction' style='color:blue'> Tu n'as pas r\351pondu \340 la question, si tu ne sais pas, va revoir <a href="+self.coursUrl+">ton cours </a> et essai encore </span>");
				$(this).append(divCorrect);
			}else if(choix == reponse){
					var divCorrect= $("<span class='correction' style='color:green'>Bravo, c\'est la bonne r\351ponse</span>");
					$(this).append(divCorrect);
			
			}else{
			
					var divCorrect= $("<span class='correction' style='color:red'>Tu t'es tromp\351, la bonne r\351ponse est : "+reponse+"</span>");
					
					$(this).append(divCorrect);
			}
	
	
	});
 }
 
 }
