<?php
$page = $_SERVER['PHP_SELF'];
echo "<!--" . $page . "-->";
?>
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
    // global variables
    var renderer;
    var scene;
    var camera;
    /**
     * Initializes the scene, camera and objects. Called when the window is
     * loaded by using window.onload (see below)
     */
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
        // create the ground plane
        var planeGeometry = new THREE.PlaneGeometry(20, 20);
        var planeMaterial = new THREE.MeshLambertMaterial({color: 0xcccccc});
        var plane = new THREE.Mesh(planeGeometry, planeMaterial);
        plane.receiveShadow = true;
        // rotate and position the plane
        plane.rotation.x = -0.5 * Math.PI;
        plane.position.x = 0;
        plane.position.y = -2;
        plane.position.z = 0;
        // add the plane to the scene
        scene.add(plane);
        // position and point the camera to the center of the scene
        camera.position.x = 15;
        camera.position.y = 16;
        camera.position.z = 13;
        camera.lookAt(scene.position);
		
        // add spotlight for the shadows
        var spotLight = new THREE.SpotLight(0xffffff);
        spotLight.position.set(10, 20, 20);
        spotLight.shadowCameraNear = 20;
        spotLight.shadowCameraFar = 50;
        spotLight.castShadow = true;
        scene.add(spotLight);
        // add the output of the renderer to the html element
        document.body.appendChild(renderer.domElement);
		  addControlGui(control);
        addStatsObject();
        render();
    }
	
	
	function getplayer(playerX, playerY, playerZ = 15){
	    var cube;    // create a cube
        var cubeGeometry = new THREE.BoxGeometry(16, 14, 16);
        var cubeMaterial = new THREE.MeshLambertMaterial({color: 'red', transparent:true, opacity:0.6});
        cube = new THREE.Mesh(cubeGeometry, cubeMaterial);
		 cube.position.x = playerX;
        cube.position.y = playerY;
        cube.position.z = 20;
        cube.castShadow = true;
        // add the cube to the scene
       if (X != "undefined"){
		console.log("X: " + cube.position.x);
		console.log("Y: " + cube.position.y);
		console.log("Z: " + cube.position.z);
		 };
		 scene.add(cube);
	}
	
    /**
     * Add small spheres on each of the vertices of the supplied mesh.
     * @param mesh
     */
    function addVertices(mesh) {
        var vertices = mesh.geometry.vertices;
        var vertexMaterial = new THREE.MeshPhongMaterial({color: 0x00ff00});
        // for each vertex, add a sphere
        vertices.forEach(function (vertex) {
            var vertexSphere = new THREE.SphereGeometry(0.05);
            var vertexMesh = new THREE.Mesh(vertexSphere, vertexMaterial);
            vertexMesh.position = vertex;
            scene.add(vertexMesh);
        });
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
<!-- Scripts come second -->
<script src="socket.io.js"></script> 
<script type='text/javascript' src='jquery.min.js'></script>
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
    	users = user; // passing to global browser users
    	var l = user.length; 
	    for (var i = 0; i < l; i++) {
    		playerX[i] = user[i][1];
			playerY[i] = user[i][2];
			usernumber = users.length;  
		    users[usernumber][1] = playerX[i];
		    users[usernumber][2] = playerY[i];  
			
    	}
    	console.log("USER: " + user); 
    });
    socket.on('removeplayer', function (clientid) { 
    	playerX.splice(clientid, 1);
    	playerY.splice(clientid, 1);   
    });
	// Moves player and sends positioning information to server
	socket.on('playermove', function (keystroke, clientIndex) {
		movePlayer(keystroke,clientIndex);
		socketResponse("syncplayers", users);
    }); 
	// Passing input from browser to socket.io server
    function socketResponse(type, data) {
   		var socket = io.connect('http://127.0.0.1:8080/');
 	 	socket.emit(type, data);
    }
    // Listening for input from player
    addEventListener('keydown', function(e) {
    	// Checking browser username against socket user array to get clientID to move player
    	if (users.length > 0) {
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
    	//console.log(users); 
    	socketResponse('keypress',clientData); 
	}, false);   
	
	function draw() {
	
	    var l = playerX.length;
	    for (var i = 0; i <= l; i++) {
		getplayer(playerX[i], playerY[i], 15 + i);
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
    	//draw();  
	} 
	//draw();
</script>