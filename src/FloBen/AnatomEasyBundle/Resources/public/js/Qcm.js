function Qcm (){


	this.questionArray  = '';
	self                = this;
	this.coursUrl       = '';
	this.chrono			= 0;
	
	this.StartQcm = function(tabQuestions,coursUrl){
		
		self.questionArray = tabQuestions;
		self.coursUrl=coursUrl;	
		
		$("#verify").click(function() {
		  self.Verify();
		  $('html,body').animate({scrollTop: 0}, 'slow');
		});
		$("#generate").click(function() {
		  self.generate();
		  $('html,body').animate({scrollTop: 0}, 'slow');
		});
		
		self.generate();
	}
	
	this.generate = function(){
		$('#question_container').empty();
		this.chrono=0;
		self.startChrono();
		for(var i = 0; i < 7 ; i++){
			var question=self.questionArray[Math.floor(Math.random()*self.questionArray.length)]; 
			
			$("#question_container").append(self.constructQuestion(i,question));
			$("#question_container").append("<br>");
		
		}
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
		
	
	this.AddQuestion = function(intitule, choix, reponse){
		
	var question = {
				"intitule": intitule,
				"choix": choix,
				"reponse": reponse
				};
		this.questionArray.push(question);
	
	
	}



	this.startChrono = function(){
	
		this.chrono++;
		setTimeout(function() {self.startChrono();}, 1000);
	}
	
	this.Verify = function(){
		
		$(".correction").remove();
		var nbRight = 0;
		var nbWrong = 0;
		var nbNoAnswer = 0;
		
		
		$(".question").each(function( key, value ) {
			
			var choix = $(this).children('input:checked').val();
			var reponse = $(this).children('input[name=reponse]').val();
			
			if(choix == undefined){
				var divCorrect= $("<span class='correction' style='color:blue'> Tu n'as pas r\351pondu \340 la question, si tu ne sais pas, va revoir <a href="+self.coursUrl+">ton cours </a> et essai encore </span>");
				$(this).append(divCorrect);
				nbNoAnswer ++;
			}else if(choix == reponse){

				var divCorrect= $("<span class='correction' style='color:green'>Bravo, c\'est la bonne r\351ponse!</span>");
				$(this).append(divCorrect);
				nbRight++;


			}else{
		
				var divCorrect= $("<span class='correction' style='color:red'>Tu t'es tromp\351, la bonne r\351ponse est : "+reponse+"<a href="+self.coursUrl+">( ton cours )</a> </span>");
				nbWrong++;
				$(this).append(divCorrect);
			}
        
		});
	
	if(agentTest!=null){
		agentTest.stop();
		agentTest.speak("Tu as r\351pondu en "+this.chrono+" secondes et tu as "+nbRight+" r\351ponses correctes sur 7, consulte tes erreurs");
					   
	}
	var score = ((nbRight)*100)/7;
	$.post(window.location.pathname+"/register", {'score' :score, 'secondSpent':this.chrono }); 


 }
 
 }
