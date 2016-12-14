
<html>
<head><script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script></head>
<body>

<center><h3>Welcome to Warzone</h3></center>



<div id = "side-A">
<div style = "width:120px; height:400px; border: 1px solid black; margin:1px; display: inline-block;"></div>

<div style = "width:1200px; height:400px; margin:1px; display: inline-block;">
<canvas tabindex='0' id="canvas-1" width="1200" height="400" style="border: solid black 3px;"></canvas>
</div>

<div style = "width:170px; height:400px; position:absolute; left:1340px; margin-left:5px; font-size:12px; border: 1px solid black; display: inline-block;">
<center>
<p>Ship placements Remaining:</p>
<p>BattleShip: <button id = "battleship" onclick = "ship_to_draw('battleship')">1</button></p>
<p>Crusier: <button id = "crusier" onclick = "ship_to_draw('crusier')">2</button></p>
<p>Destroyer: <button id = "destroyer" onclick = "ship_to_draw('destroyer')">3</button></p>
<p>Sub: <button id = "sub" onclick = "ship_to_draw('sub')">4</button></p>

</center>
</div>

</div>

<div id = "side-B">
<div style = "width:120px; height:400px; border: 1px solid black; margin:1px; display: inline-block;"></div>

<div style = "width:1200px; height:400px; margin:1px; display: inline-block;">
<canvas tabindex='0' id="canvas-2" width="1200" height="400" style="border: solid black 3px;"></canvas>
</div>

</div>

<script>

var canvas_1 = document.getElementById('canvas-1');
var canvas_2 = document.getElementById('canvas-2');

var context_1 = canvas_1.getContext('2d');
var context_2 = canvas_2.getContext('2d');

var shiptoDraw = "";
var placeShips = true;


canvas_1.addEventListener('click', on_canvas1_click, false);
canvas_2.addEventListener('click', on_canvas2_click, false);

var GameState = {};

GameState.battleship = [];
GameState.cruiser = [];
GameState.destroyer = [];
GameState.sub = [];

GameState.player = [];
GameState.shot = [];

//Player_information


var player_id = "udeme";
var playing_against = "udee";
var player_score  = 0;
var battleship_count = 1;
var cruiser_count = 2;
var destroyer_count = 3;
var sub_count = 4;

//holds all the used co-ordinates
GameState.occupied = [];



function Battleship(id, x, y){
	this.id = id;
	this.x = x;
	this.y = y;
	this.boxes = 4;
	this.size = 160;
	this.orientation = "";
}


function Crusier(id, x, y){
	this.id = id;
	this.x = x;
	this.y = y;
	this.boxes = 3;
	this.size = 120;
	this.orientation = "";
}

function Destroyer(id, x, y){
	this.id = id;
	this.x = x;
	this.y = y;
	this.boxes = 2;
	this.orientation = "";
}

function Sub(id, x, y){
	this.id = id;
	this.x = x;
	this.y = y;
	this.boxes = 1;
	this.orientation = "";
}

function Shot(id, x, y){
	this.id = id;
	this.x = x;
	this.y = y;
	this.size = 1;
	
}

function Occupied(x, y){
	this.x = x;
	this.y = y;
}




	//draw board
function drawBoard(){
	//draw for cancas_1
	
	//draw vertical lines on canvas-1
	for(var x = 0; x<= 1200; x+=40){
		context_1.moveTo(x, 0);
		context_1.lineTo(x, 400);
	  
	}
	//draw vertical lines for canvas-1
	for(var y = 0; y<= 400; y+=40){
		context_1.moveTo(0, y);
		context_1.lineTo(1200, y);
	}
	context_1.strokeStyle = "black";
    context_1.stroke();
	
	//draw for canvas_2
	//draw vertical lines on canvas-2
	for(var x = 0; x<= 1200; x+=40){
		context_2.moveTo(x, 0);
		context_2.lineTo(x, 400);
	  
	}
	//draw vertical lines for canvas-2
	for(var y = 0; y<= 400; y+=40){
		context_2.moveTo(0, y);
		context_2.lineTo(1200, y);
	}
	context_2.strokeStyle = "black";
    context_2.stroke();
	
}
drawBoard();






//listens an performs action
function on_canvas1_click(ev){
	
	var x = (Math.floor((ev.clientX - canvas_1.parentElement.offsetLeft)/40))*40;
	var y = (Math.floor((ev.clientY - canvas_1.parentElement.offsetTop)/40))*40;
	
	//document.getElementById('output').innerHTML = "Co-ordinated: "+x+","+y;
	
	
	if(shiptoDraw == "battleship"){
		//make sure position is not occupied and battleship does not go outside board
         if((checkPosition(x, y) == true)||(checkPosition(x+40, y) == true)||(checkPosition(x+80, y) == true)||(checkPosition(x+120, y) == true)||(x+(40*3)>1160)){
			 alert("Cannot place Ship here!");
			 
		 }else{
			 if(battleship_count>0){
			 battleship_count = battleship_count-1;

			 GameState.battleship.push( new Battleship(GameState.battleship.length, x, y));
		     GameState.occupied.push( new Occupied(x, y));
		     GameState.occupied.push( new Occupied(x+40, y));
			 //alert(x+40+","+y);
		     GameState.occupied.push( new Occupied(x+(40*2), y));
			 //alert(x+(40*2)+","+y);
		     GameState.occupied.push( new Occupied(x+(40*3), y));
			 //alert(x+(40*3)+","+y);
			 document.getElementById("battleship").innerHTML = battleship_count;
			 }
			 
		 }
	}
	
	
	if(shiptoDraw == "crusier"){
		
		if((checkPosition(x, y) == true)||(checkPosition(x+40, y) == true)||(checkPosition(x+80, y) == true)||(x+(40*2)>1160)){
			 alert("Cannot place Ship here!");
			 
		 }else{
			 if(cruiser_count>0){
			 cruiser_count = cruiser_count-1;

			 GameState.cruiser.push( new Crusier(GameState.cruiser.length, x, y));
		     GameState.occupied.push( new Occupied(x, y));
		     GameState.occupied.push( new Occupied(x+40, y));
			 //alert(x+40+","+y);
		     GameState.occupied.push( new Occupied(x+(40*2), y));
			 //alert(x+(40*2)+","+y);
			 document.getElementById("crusier").innerHTML = cruiser_count;
			 }
			 
		 }
		
	}
	
	if(shiptoDraw == "destroyer"){
		
		if((checkPosition(x, y) == true)||(checkPosition(x+40, y) == true)||(x+40>1160)){
			 alert("Cannot place Ship here!");
			 
		 }else{
			 if(destroyer_count>0){
			 destroyer_count = destroyer_count-1;

			 GameState.destroyer.push( new Destroyer(GameState.destroyer.length, x, y));
		     GameState.occupied.push( new Occupied(x, y));
		     GameState.occupied.push( new Occupied(x+40, y));
			 //alert(x+40+","+y);
			 document.getElementById("destroyer").innerHTML = destroyer_count;
			 }
			 
		 }
		
	}
	
	if(shiptoDraw == "sub"){
		
		if((checkPosition(x, y) == true)){
			 alert("Cannot place Ship here!");
			 
		 }else{
			 if(sub_count>0){
			 sub_count = sub_count-1;
			 GameState.sub.push( new Sub(GameState.sub.length, x, y));
		     GameState.occupied.push( new Occupied(x, y));
			 document.getElementById("sub").innerHTML = sub_count;
			 }
			 
		 }
		
	}
	

	drawGameObjects();
}

//draw on shot canvas
function on_canvas2_click(ev){
	
	var x = (Math.floor((ev.clientX - canvas_2.parentElement.offsetLeft)/40))*40;
	var y = (Math.floor((ev.clientY - canvas_2.parentElement.offsetTop)/40))*40;

	if(checkBegin() == true){
  		 GameState.shot.push( new Shot(GameState.shot.length, x, y));

	}
	
	//play();
	

	drawGameObjects();
	
}




//function to check position of the battleship
function checkPosition(X, Y){
	var result = "";
	
	for(var i = 0; i<GameState.occupied.length; i++){
			
			var occupied = GameState.occupied[i];

			if((occupied.x == X)&&(occupied.y == Y)){
				result = true;
				break;
			}else{
				result = false;
			}
	}
	return result;
}

//check if all the players 
function checkBegin(){
	var result;
	
	if((battleship_count == 0) && (cruiser_count==0) && (sub_count == 0) && (destroyer_count == 0)){
		result = true;
	}
	else{
		result = false;
	}
	return result;
}


//draw the ships or shots
function drawGameObjects(){
	//draw battleship
	for(var i=0;i<GameState.battleship.length;i++){
			
			var battleship=GameState.battleship[i];
			var x = battleship.x;
			var y = battleship.y;
			
			for(var boxes = 0 ; boxes <= 3; boxes++){
			context_1.strokeStyle = 'white';
			context_1.fillStyle = 'black';
			context_1.fillRect(x, y ,40 ,40); 
            x += 40;
            //y += 40;		
			}			

	}
	
	//draw cruisers
	for(var i=0;i<GameState.cruiser.length;i++){
			
			var crusier = GameState.cruiser[i];
			var x = crusier.x;
			var y = crusier.y;
			
			for(var boxes = 0 ; boxes <= 2; boxes++){
			context_1.strokeStyle = "#fff";
			context_1.fillStyle = 'black';
			context_1.fillRect(x, y ,40 ,40); 
            x += 40;
            //y += 40;		
			}			

	}
	
	//draw destroyer
	for(var i=0;i<GameState.destroyer.length;i++){
			
			var destroyer = GameState.destroyer[i];
			var x = destroyer.x;
			var y = destroyer.y;
			
			for(var boxes = 0 ; boxes <= 1; boxes++){
			context_1.strokeStyle = "#fff";
			context_1.fillStyle = 'black';
			context_1.fillRect(x, y ,40 ,40); 
            x += 40;
            //y += 40;		
			}			

	}

	//draw sub
	for(var i=0;i<GameState.sub.length;i++){
			
			var sub = GameState.sub[i];
			var x = sub.x;
			var y = sub.y;
			
			for(var boxes = 0 ; boxes <= 1; boxes++){
			context_1.strokeStyle = "#fff";
			context_1.fillStyle = 'black';
			context_1.fillRect(x, y ,40 ,40); 
            //x += 40;
            //y += 40;		
			}			

	}
	
	//draw shots
	for(var i=0;i<GameState.shot.length;i++){
			
			var shot = GameState.shot[i];
			var x = shot.x;
			var y = shot.y;
			
			for(var boxes = 0 ; boxes <= 1; boxes++){
			context_2.strokeStyle = "#fff";
			context_2.fillStyle = 'green';
			context_2.fillRect(x, y ,40 ,40); 
            //x += 40;
            //y += 40;		
			}			

	}
}



function play(){
	var myName = "<?php echo $_SESSION['login_user'];?>";
	
	var action = "mysqlaction";
	
	
	//check if player players move has and affected my ship_choice
	$.ajax({
        url:"GameAction.php", //the page containing php script
        type: "POST", //request type
		data: {action: 'checkPlayerMove', player: myName},
        success:function(result){
         alert(result);
       }
     });
	
	
	//check turn select from database on player turn
	 $.ajax({
        url:"GameAction.php", //the page containing php script
        type: "POST", //request type
		data: {action: 'checkTurn', player: myName},
        success:function(result){
         alert(result);
       }
     });
	 
	 
	 //if it is my turn play, pass my move to database
	  $.ajax({
        url:"GameAction.php", //the page containing php script
        type: "POST", //request type
		data: {action: 'playMymove', player: myName},
        success:function(result){
         alert(result);
       }
     });
	 
	 
	
}





function ship_to_draw(ship_choice){
	shiptoDraw = ship_choice;
	document.getElementById('output').innerHTML = shiptoDraw;
}



function clearCanvas(){     
		context_1.clearRect(0, 0, canvas_1.width, canvas_1.height);
		context_2.clearRect(0, 0, canvas_2.width, canvas_2.height);
	}

	
	



</script>

</body>
</html>
