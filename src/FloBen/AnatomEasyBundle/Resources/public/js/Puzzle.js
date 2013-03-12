function startPuzzle(level,imgPath){
    
    
    var nbShuffle=5;
    var NCaseW=4;
    var NCaseH=3;
    
    var width=800;
    var height=600; 
    if (level.indexOf("CE1") >= 0) 
    {  
        nbShuffle=5; 
        NCaseW=3;
        NCaseH=2; 
    }
    else if (level.indexOf("CE2") >= 0) 
    {
        nbShuffle=5;
        NCaseW=4;
        NCaseH=3; 
    }
    else if (level.indexOf("CM1") >= 0) 
    {
        nbShuffle=20;
        NCaseW=4;
        NCaseH=3; 
    }
    else if (level.indexOf("CM2") >= 0) 
    {
        nbShuffle=30;
        NCaseW=5;
        NCaseH=4; 
    }

 /*
#P0 { background-position:0 0; }
#P1 { background-position:-100px 0; }
#P2 { background-position:-200px 0; }
#P3 { background-position:-300px 0; }
#P4 { background-position:-400px 0; }*/

    var containerName="photo";
    $("#"+containerName).css("width",width+"px").css("height",height+ "px");
    var k=0;
    for(i=0;i<NCaseH;i++){
        
        for(j=0;j<NCaseW;j++){//<div class="dbx-box" id="P'+k+'"><a href="javascript:void(null)" class="dbx-handle">'+k+'</a></div>
            var box=$('<div></div>').attr('class','dbx-box')
                                    .attr('id','P'+k)
                                    .append($('<a></a>').attr('href','javascript:void(null)')
                                                        .attr('class','dbx-handle'));
            var bckgrndPos=''+(j==0 ? '0 ' : '-'+Math.round(j*width/NCaseW)+'px ')+(i==0 ? '0' : '-'+Math.round(i*height/NCaseH)+'px'); 
            box.css("background-position",bckgrndPos)
               .css("background-image",imgPath) 
               .css("background-size",width+'px '+height+'px')
            ; 
            $("#"+containerName).append(box);
            k++;
        } 
    }    
			    //<div class="dbx-box" id="P0"><a href="javascript:void(null)" class="dbx-handle">0</a></div>
    //initialise the docking boxes manager
    var manager = new dbxManager(
	    'photoswap',			// session ID [/-_a-zA-Z0-9/]
	    'yes',					// enable box-ID based dynamic groups ['yes'|'no']
	    'yes',					// hide source box while dragging ['yes'|'no']
	    'link'					// toggle button element type ['link'|'button']
	    );


    //create new docking boxes group
    var group = new dbxGroup(
	    containerName, 				// container ID [/-_a-zA-Z0-9/]
	    'freeform', 			// orientation ['vertical'|'horizontal'|'freeform'|'freeform-insert'|'confirm'|'confirm-insert']
	    '7', 					// drag threshold ['n' pixels]
	    'yes',					// restrict drag movement to container/axis ['yes'|'no']
	    '15', 					// animate re-ordering [frames per transition, or '0' for no effect]
	    'no', 					// include open/close toggle buttons ['yes'|'no']
	    '',		 				// default state ['open'|'closed']

	    '', 										// word for "open", as in "open this box"
	    '', 										// word for "close", as in "close this box"
	    'fait un glisser-déposer pour bouger cette pièce', 	// sentence for "move this box" by mouse
	    '', 										// pattern-match sentence for "(open|close) this box" by mouse
	    'utilise les flèches de ton clavier pour bouger cette pièce',	// sentence for "move this box" by keyboard
	    '',  										// pattern-match sentence-fragment for "(open|close) this box" by keyboard
	    '%mytitle%  [%dbxtitle%]',					// pattern-match syntax for title-attribute conflicts

	    '',											// confirm dialog sentence for "selection okay"
	    ''											// confirm dialog sentence for "selection not okay"
	    );




    //use the rules engine to prevent diagonal movement
    group.setRule('NESW');





    //get the collection of box elements, which in this case is all DIVs inside the group
    //to use for changing the background so we can change the picture picture around
    var boxes = group.container.getElementsByTagName('div');

    //create an array of the pieces in order to reset with
    //and create an empty array for shuffling the pieces
    //which we'll populate on demand each time
    var shuffling = [], resetting = [];
    for(var i=0; i<NCaseW*NCaseH; i++)
    {
	    resetting.push('P' + i);
    }

    //create a busy flag to prevent reset and shuffle happening at the same time
    var busy = false;

    //create a variable to store the ID of the primary box of each reset insert action
    var primaryID = null;






    //use onboxdrag to record the primary box of each insertion action
    //and to hide the success message in response to any movement
    //(this will catch shuffle and restore, as well as manual actions)
    manager.onboxdrag = function()
    {
	    //record the primary box ID
	    primaryID = this.getID(this.sourcebox);
	
	    //hide the success message
	    document.getElementById('congratulations').style.display = 'none';
	    return true;
    };





    //reset function uses insert() to place the pieces in order
    //by moving each piece to the end of the group
    //we use the primary box ID reference we saved from onboxdrag
    //so that we only handle the onafteranimate of that one
    //because it will fire for all the ones that get displaced as well
    function reset()
    {
	    //if the busy flag is true ignore this action
	    if(busy) { return; }
	
	    //set the busy flag
	    busy = true;
	
	    //reset the piece pointer 
	    var pointer = 0;
	
	    //if the reset occurs with animation then firefox stops after a few pieces 
	    //for no explicable reason ... the code is fine, every other browser is fine, 
	    //firefox is just being stupid; so set it 0 to temporarily disable it
	    group.resolution = 1;
	
	    //create an onafteranimate handler
	    manager.onafteranimate = function()
	    {
		    //if this is the primary box
		    if(primaryID == this.getID(this.sourcebox))
		    {
			    //increase the piece pointer
			    pointer ++;
			
			    //if there are more pieces to move
			    if(pointer < resetting.length)
			    {
				    //insert the next piece at the end of the group
				    group.insert(resetting[pointer], false);
			    }
			
			    //otherwise we're done
			    else
			    {
				    //clear the busy flag
				    busy = false;
				
				    //and restore the animation resolution
				    group.resolution = 15;
			    }
		    }
	    }

	    //insert the first piece at the end of the group
	    group.insert(resetting[pointer], false);
    }






    //shuffle function randomly moves the pieces around and works in a similar way to reset
    //but the special situation here is where we have to handle a swap operation that fails
    //which it can do under a few different circumstances
    //(for more info see: http://www.brothercake.com/site/resources/scripts/dbx/setup6/)
    function shuffle()
    {
	    //if the busy flag is true ignore this action
	    if(busy) { return; }
	
	    //set the busy flag
	    busy = true;
	
	    //reset the piece pointe
	    var pointer = 0;
	
	    //create an onafteranimate handler
	    manager.onafteranimate = function()
	    {
		    //if this is the primary box
		    if(primaryID == this.getID(this.sourcebox))
		    {
			    //increase the piece pointer
			    pointer += 2;
			
			    //if there are more pieces to move
			    if(pointer < shuffling.length)
			    {
				    //try to swap the next two pieces, and while it fails just increase the pointer and try again
				    //clear the busy flag in case this happens at the end of a shuffle routine
				    //if we reach the pointer's limit then just abandon this shuffle
				    while(!(group.swap(shuffling[pointer], shuffling[pointer + 1], false)))
				    {
					    busy = false;
					    pointer += 2;
					    if(pointer >= shuffling.length)
					    {
						    break;
					    }
				    }
			    }
			
			    //otherwise we're done
			    else
			    {
				    //clear the busy flag
				    busy = false;
			    }
		    }
	    }

	    //try to swap the first two pieces, and while it fails just increase the pointer and try again
	    //clear the busy flag in case this happens at the end of a shuffle routine
	    //if we reach the pointer's limit then just abandon this shuffle
	    while(!(group.swap(shuffling[pointer], shuffling[pointer + 1], false)))
	    {
		    busy = false;
		    pointer += 2;
		    if(pointer >= shuffling.length)
		    {
			    break;
		    }
	    }
    }





    //store the previous state before each swap
    //so that we don't congratulate for picking the first piece up
    //and then immediately putting it down again!
    var laststate = '';

    //create an onstatechange function to detect when the picture is complete
    manager.onstatechange = function()
    {
	    //save the state string and remove the name part
	    //then strip it of the "+" symbols we don't need
	    var state = this.state.split('=')[1].replace(/\+/g, '');

	    //if the laststate is empty, save it to laststate immediately
	    if(laststate == '') { laststate = state; }

	    //hide the success message
	    document.getElementById('congratulations').style.display = 'none';

	    //if the state is correct, then the string
	    //will be the same as the resetting array when joined
	    if(state == resetting.join())
	    {
		    //so show the success message, but not if the busy flag is true
		    //(otherwise we'll be congratulating pressing the "reset" button!)
		    //and also not if the state is the same as the last state
		    //(so you don't get it just by picking up and dropping the first image)
		    if(!busy && state != laststate)
		    {
			    document.getElementById('congratulations').style.display = 'block';
			    reset();
			    sendResult(true,100);
		    }
	    }

	    //save the state to last state
	    laststate = state;

	    //don't save the cookie state
	    return false;
    };



    $(".dbx-box").css('width',(width/NCaseW)+"px")
                       .css('height',(height/NCaseH)+"px");
    $(".dbx-handle").css('width',(width/NCaseW)+"px")
                    .css('height',(height/NCaseH)+"px") ;
    ;



    //init

  
    //iterate through the boxes and apply this as a background image
    for(var i=0; i<boxes.length; i++)
    {
	    boxes[i].style.backgroundImage = 'url(' + imgPath + ')';
    }
    
    
    //populate the shuffling array randomly
    //add 30 pairs not just 20 so we get a good old shuffle
    shuffling = [];
    for(var i=0; i<nbShuffle; i++)
    {
	    for(var j=0; j<2; j++)
	    {
		    shuffling.push('P' + (1 + Math.floor(Math.random() * (NCaseW*NCaseH))));
	    }
    }

    //run the shuffle function with the shuffled array
    
    setTimeout(function() {shuffle();}, 1500);
		  
}


