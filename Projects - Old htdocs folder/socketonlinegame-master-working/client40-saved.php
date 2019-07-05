<script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/2.0.0/jquery.min.js"></script>
<script src="three.js"></script>
<script type="text/javascript" src="stats.js"></script> 
		<script type="text/javascript" src="dat.gui.js"></script> 

<body>
 <div id="signin" style="right: 100px;width:20%; margin:30px;position: fixed;background-color: white;opacity: 0.5;">
		<h1>Please enter your name</h1>
		<input type='text' id='userNameField'>
		<button value='Start' onclick='userName = $("#userNameField").val(); socketResponse("setname", $("#userNameField").val()); $("#signin").hide();'>Start</button>
</div>
<div id="userhead" style="left:100px; width:20%; margin:30px;position: fixed;background-color: white;"><h1>User List</h1><hr>
	<div id="leave"><button onclick='socketResponse("leave", userName); window.location = "http://www.google.com/";'>Leave</button></div>
	<div id="userlist" style=""></div> 
</div>
<script>
	var cpath = window.location.pathname.split('/').pop();
	$('#userlist').html('<p>'+cpath+'</p>');
    var renderer;
    var scene;
    var camera;

    function init() {
        // create a scene, that will hold all our elements such as objects, cameras and lights.
        scene = new THREE.Scene();
        // create a camera, which defines where we're looking at.
        camera = new THREE.PerspectiveCamera(45, window.innerWidth / window.innerHeight, 0.1, 1000);
        // create a render, sets the background color and the size
        renderer = new THREE.WebGLRenderer();
        renderer.setClearColor(0x000000, 1.0);
        renderer.setSize(window.innerWidth, window.innerHeight);
        renderer.shadowMapEnabled = true;
     
        camera.position.x = 15;
        camera.position.y = 16;
        camera.position.z = 13;
        camera.lookAt(scene.position);
		
		var ambient = new THREE.AmbientLight(0x808080);
      scene.add(ambient);
		
        // add spotlight for the shadows
        var spotLight = new THREE.SpotLight(0xffffff);
        spotLight.position.set(10, 20, 20);
        spotLight.shadowCameraNear = 20;
        spotLight.shadowCameraFar = 50;
        spotLight.castShadow = true;
        scene.add(spotLight);
        document.body.appendChild(renderer.domElement);  // add the output of the renderer to the html element
		addControlGui(control);
        addStatsObject();
        render();
    }
	
	function getplayer(playerX, playerY, playerZ = 15){
        var cubeGeometry = new THREE.BoxGeometry(50, 50, 50);
        var cubeMaterial = new THREE.MeshLambertMaterial({color: 'red', transparent:false, opacity:0.6});
        var cube = new THREE.Mesh(cubeGeometry, cubeMaterial);
		cube.position.x = playerX;
        cube.position.y = playerY;
        cube.position.z = 20;
        cube.castShadow = true;
        console.log("getplayer() threeJS function called");
		//console.log("X: " + cube.position.x);
		//console.log("Y: " + cube.position.y);
		//console.log("Z: " + cube.position.z);
		
		 scene.add(cube);
	}

	    // setup the control object for the control gui
        control = new function () {
            this.rotationSpeed = 0.001;
        };
        // add extras
	   function addControlGui(controlObject) {
        var gui = new dat.GUI();
        gui.add(controlObject, 'rotationSpeed', -0.01, 0.01);
    }
    function addStatsObject() {
        stats = new Stats();
        stats.setMode(0);
        stats.domElement.style.position = 'absolute';
        stats.domElement.style.left = '0px';
        stats.domElement.style.top = '0px';
        document.body.appendChild(stats.domElement);
    }
	/**
     * Called when the scene needs to be rendered. Delegates to requestAnimationFrame
     * for future renders
     */
    function render() {
		draw();
        var rotSpeed = control.rotationSpeed;
        camera.position.x = camera.position.x * Math.cos(rotSpeed) + camera.position.z * Math.sin(rotSpeed);
        camera.position.z = camera.position.z * Math.cos(rotSpeed) - camera.position.x * Math.sin(rotSpeed);
        camera.lookAt(scene.position);
        // render using requestAnimationFrame
        requestAnimationFrame(render);
        renderer.render(scene, camera);
    }
    /**
     * Function handles the resize event. This make sure the camera and the renderer
     * are updated at the correct moment.
     */
    function handleResize() {
        camera.aspect = window.innerWidth / window.innerHeight;
        camera.updateProjectionMatrix();
        renderer.setSize(window.innerWidth, window.innerHeight);
    }
    // calls the init function when the window is done loading.
    window.onload = init;
    // calls the handleResize function when the window is resized
    window.addEventListener('resize', handleResize, false);
</script>
</body>
		<script src="socket.io.js"></script> 
<!-- <script type='text/javascript' src='jquery.min.js'></script> -->
<script> 
	// Initializing Socket
	
	var socket = io.connect('http://127.0.0.1:8080/');
	var users;
	var userName = ''; 
    var playerX = new Array();
	var playerY = new Array(); 
	var userlist = '';
	var usernumber; 
	// Shows player list upon set name
    socket.on('getplayers', function (user) {
		console.log("client getplayers function called");
    	users = user; // passing to global browser users
    	userlist = '';
    	var l = user.length;
	    for (var i = 0; i < l; i++) { 		 
	    	userlist += user[i][3]+'<br>'; 
    		playerX[i] = user[i][1];
			playerY[i] = user[i][2];
    	}
    	$('#userlist').html('<p>'+userlist+'</p>');
    });  
    // updates all players when new player joins
    socket.on('syncplayers', function (user) { 
	console.log("client syncplayers function called!");
	socketResponse("syncplayers", users);
    	users = user; // passing to global browser users
    	var l = user.length; 
	    for (var i = 0; i < l; i++) { // Loops through all the users in users
    		playerX[i] = user[i][1];
			playerY[i] = user[i][2];
			usernumber = users.length;   // Curent user is console.log(userlist); 
		    users[usernumber][1] = playerX[i];
		    users[usernumber][2] = playerY[i];  
    	}
    	
    });
    //socket.on('removeplayer', function (clientid) { 
    //	playerX.splice(clientid, 1);
    //	playerY.splice(clientid, 1);   
   // });

	socket.on('playermove', function (keystroke, clientIndex) {
		movePlayer(keystroke,clientIndex);
		console.log("client playermove function called!");
		
		socketResponse("syncplayers", users);
    }); 
	
    function socketResponse(type, data) {
   		var socket = io.connect('http://127.0.0.1:8080/');
 	 	socket.emit(type, data);
    }

    addEventListener('keydown', function(e) {
    	// Checking browser username against socket user array to get clientID to move player
    	if (users.length > 0) { // If users not empty
	    	var l = users.length;
	    	for (var i = 0; i < l; i++) {
	    		if (users[i][3] == userName) {
	    			clientid = i;
	    		}
	    	}
    	}
    	// Chopping up client data to be passed to server
    	var clientData = new Array();
    	clientData[0] = e.keyCode;
    	clientData[1] = clientid; 
    	socketResponse('keypress',clientData); 
	}, false);   
	
	function draw() {
	
	    var l = playerX.length;
	    for (var i = 0; i <= l; i++) {
		getplayer(playerX[i], playerY[i], 20);
	 	}        
	}
	
	function movePlayer(keyStroke, clientIndex) {   
        if (keyStroke == 39) { // left
            playerX[clientIndex]=playerX[clientIndex]+5;
            users[clientIndex][1] = playerX[clientIndex];
        } else if (keyStroke == 37) { // right
            playerX[clientIndex]=playerX[clientIndex]-5;
            users[clientIndex][1] = playerX[clientIndex];
        }
        if (keyStroke == 40) { // up
            playerY[clientIndex]=playerY[clientIndex]+5;
            users[clientIndex][2] = playerY[clientIndex];
        } else if (keyStroke == 38) { // down
            playerY[clientIndex]=playerY[clientIndex]-5;
            users[clientIndex][2] = playerY[clientIndex]; 	
        } 
	} 
</script>