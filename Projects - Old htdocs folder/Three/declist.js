var dchoice;
var dc;

function Declist( d, c ){
	dc = c;
	switch( d ) {
	    case "Null": dchoice = 0; break;
		case "Heart": dchoice = 1; break;
		case "Gold Ring": dchoice = 2; break;
		case "Sock": dchoice = 3; break;
		case "Christmas Balls": dchoice = 4; break;
		case "Fish": dchoice = 5; break;
		case "Amber Stone": dchoice = 6; break;
		case "Flower": dchoice = 7; break;
		case "Colorful Diamond": dchoice = 8; break;
		
	}

	
}

function Dec( x, y, z ) {
	
	switch( dchoice ) {
		case 0: break;
		case 1: heartLeave( x, y, z ); break;
		case 2: ringLeave( x, y, z ); break;
		case 3: sockLeave( x, y, z ); break;
		case 4: ballLeave( x, y, z ); break;
		case 5: fishLeave( x, y, z ); break;
		case 6: amberLeave( x, y, z ); break;
		case 7: torusLeave( x, y, z ); break;
		case 8: diamondLeave( x, y, z ); break;

	}
}
function addGeometry( geometry, points, spacedPoints, color, x, y, z, rx, ry, rz, s ) {

		var mesh = THREE.SceneUtils.createMultiMaterialObject( geometry, 
			[ new THREE.MeshLambertMaterial( { color: color } ), 
			  new THREE.MeshBasicMaterial( { color: color, opacity: 0.5 } ) ] );
		mesh.position.set( x, y, z );
		
		mesh.rotation.set( rx, ry, rz );
		mesh.scale.set( s, s, s );
		parent.add( mesh );
					
}

function diamondLeave( x, y, z ){
	var s = 2;
	parent = new THREE.Object3D();			
	parent.position.y = 0;
	scene.add( parent );
	var deg = Math.PI / 180;

	//function addGeometry( geometry, points, spacedPoints, color, x, y, z, rx, ry, rz, s ) {

		
	var extrudeSettings = {	amount: 1,  bevelEnabled: false, bevelSegments: 1, steps: 1 }; // bevelSegments: 2, steps: 2 , bevelSegments: 5, bevelSize: 8, bevelThickness:5,

    // leave

	var leaveShape = new THREE.Shape();
	var k = Math.random() * 2 + 1;
	leaveShape.moveTo(  0, 0 );
	leaveShape.lineTo( k, 2*k );
	leaveShape.lineTo( 0, 4*k );
	leaveShape.lineTo( -1*k, 2*k );
	leaveShape.lineTo( 0, 0 );
	

	var leave3d = leaveShape.extrude( extrudeSettings );
	var leavePoints = leaveShape.createPointsGeometry();
	var leaveSpacedPoints = leaveShape.createSpacedPointsGeometry();

	var rx = Math.random() * 30 - 15,
		ry =  Math.random() * 90 * deg,
		rz = ( Math.random() * 180 - 90 ) * deg;
	var color = Math.floor( Math.random() * ( 0xFFFFFF - parseInt(lc, 16) ) ) + parseInt( lc, 16);// Math.floor( Math.random() * 0x000200 ); 
				// * 0x010000
				//+ Math.floor( Math.random() * 0x000022 ) * 0x000100
				//+ Math.floor( Math.random() * 0x000022 ) * 0x000001;
    addGeometry( leave3d, leavePoints, leaveSpacedPoints, color,  x, y, z, rx, ry, rz, s );


}


function heartLeave( x, y, z ){

	var s = Math.random() * 1 + 0.5;
	parent = new THREE.Object3D();			
	parent.position.y = 0;
	scene.add( parent );
	var deg = Math.PI / 180;

	//function addGeometry( geometry, points, spacedPoints, color, x, y, z, rx, ry, rz, s ) {

		
	var extrudeSettings = {	amount: 1,  bevelEnabled: false, bevelSegments: 1, steps: 1 }; // bevelSegments: 2, steps: 2 , bevelSegments: 5, bevelSize: 8, bevelThickness:5,

    // leave
	
	
	var leaveShape = new THREE.Shape();
	leaveShape.moveTo(  0, 0 );
	leaveShape.bezierCurveTo( 8, 6, 4, 10, 0, 6 );
	leaveShape.bezierCurveTo( -4, 10, -8, 6, 0, 0 );
	
	var leave3d = leaveShape.extrude( extrudeSettings );
	var leavePoints = leaveShape.createPointsGeometry();
	var leaveSpacedPoints = leaveShape.createSpacedPointsGeometry();


	var rx = Math.random() * 30 - 15,
		ry =  Math.random() * 90 * deg,
		rz = ( Math.random() * 180 - 90 ) * deg;
    addGeometry( leave3d, leavePoints, leaveSpacedPoints, dc,  x, y, z, rx, ry, rz, s );

}

function ringLeave( x, y, z ){

	var rad = Math.random() * 5 + 3;

	var Mesh = new THREE.Mesh( new THREE.TorusGeometry( rad, Math.random()*1 + 1, 30, 30 ), new THREE.MeshPhongMaterial({
						color: 0xFF8800,
 						ambient: 0x888888,
 						shininess: 0.8,
 						opacity: 1 } ) );//map: texture }));
	Mesh.castShadow = true;
	Mesh.receiveShadow = true;
	Mesh.dynamic = true;
	Mesh.position.set( x, y - rad, z );
	Mesh.rotation.set( Math.random() * 2, Math.random() * 2, Math.random() * 2 );
	
	scene.add( Mesh );

}

function sockLeave( x, y, z ){

	var s = Math.random() * 0.7 + 0.5;
	parent = new THREE.Object3D();			
	parent.position.y = 0;
	scene.add( parent );
	var deg = Math.PI / 180;

	//function addGeometry( geometry, points, spacedPoints, color, x, y, z, rx, ry, rz, s ) {

		
	var extrudeSettings = {	amount: 1,  bevelEnabled: false, bevelSegments: 1, steps: 1 }; // bevelSegments: 2, steps: 2 , bevelSegments: 5, bevelSize: 8, bevelThickness:5,

    // leave
	
	
	var leaveShape = new THREE.Shape();
	leaveShape.moveTo(  0, 0 );
	leaveShape.lineTo( 4, 0 );
	leaveShape.lineTo( 4, -12 );
	leaveShape.arc( 0, -12, 4, 0, -Math.PI / 2, 1 );
	leaveShape.lineTo( -12, -16 );
	leaveShape.arc( -12, -12, 4, Math.PI / 2, Math.PI * 3/ 2, 0 );
	leaveShape.lineTo( -4, -8 );
	leaveShape.lineTo( -4, 0 );
	leaveShape.lineTo( 0, 0 );
	
	var leave3d = leaveShape.extrude( extrudeSettings );
	var leavePoints = leaveShape.createPointsGeometry();
	var leaveSpacedPoints = leaveShape.createSpacedPointsGeometry();


	var rx = 0;//Math.random() * 30 - 15,
		ry =  Math.random() * 180 * deg;
		rz = Math.random() * 90 * deg;
    addGeometry( leave3d, leavePoints, leaveSpacedPoints, dc,  x, y, z, rx, ry, rz, s );
    
}


function ballLeave( x, y, z ){

	var rad = Math.random() * 5 + 3;

	var Mesh = new THREE.Mesh( new THREE.SphereGeometry( rad, 30, 30 ), new THREE.MeshPhongMaterial({
						color: Math.random() * 0xFFFFFF,
 						ambient: 0xffffff,
 						shininess: 0.8,
 						opacity: 1 } ) );//map: texture }));
	Mesh.castShadow = true;
	Mesh.receiveShadow = true;
	Mesh.dynamic = true;
	Mesh.position.set( x, y, z );
	Mesh.rotation.set( Math.random() * 2, Math.random() * 2, Math.random() * 2 );
	
	scene.add( Mesh );

}

function fishLeave( x, y, z ){

	var s = Math.random() * 1 + 1;
	parent = new THREE.Object3D();			
	parent.position.y = 0;
	scene.add( parent );
	var deg = Math.PI / 180;

	//function addGeometry( geometry, points, spacedPoints, color, x, y, z, rx, ry, rz, s ) {

		
	var extrudeSettings = {	amount: 1,  bevelEnabled: false, bevelSegments: 1, steps: 1 }; // bevelSegments: 2, steps: 2 , bevelSegments: 5, bevelSize: 8, bevelThickness:5,

    // leave
	
	
	var leaveShape = new THREE.Shape();
	leaveShape.moveTo( 0, 0 );
	leaveShape.bezierCurveTo( 5, -8, 9, -2, 10, -1 );
	leaveShape.lineTo( 12, -3 );
	leaveShape.lineTo( 12, 3 );
	leaveShape.lineTo( 10, 1 );
	leaveShape.bezierCurveTo( 9, 2, 5, 8, 0, 0 );


	var leave3d = leaveShape.extrude( extrudeSettings );
	var leavePoints = leaveShape.createPointsGeometry();
	var leaveSpacedPoints = leaveShape.createSpacedPointsGeometry();


	var rx = Math.random() * 30 + 120;
		ry =  Math.random() * 180;
		rz = Math.random() * 180;
    addGeometry( leave3d, leavePoints, leaveSpacedPoints, dc,  x, y, z, rx, ry, rz, s );
    
}

function amberLeave( x, y, z ){
	var rad = Math.random() * 5 + 3;

	var Mesh = new THREE.Mesh( new THREE.CylinderGeometry( 0, rad, rad * 3, 3, 3, 0 ), new THREE.MeshPhongMaterial({
						ambient: 0x333333,
						map: THREE.ImageUtils.loadTexture("pics/lavatile.jpg"),
 						shininess: 0.8,
 						opacity: 0.9 } ) );
	Mesh.castShadow = true;
	Mesh.receiveShadow = true;
	Mesh.dynamic = true;
	Mesh.position.set( x, y - 15 / 2, z );
	//Mesh.rotation.set( Math.random() * 2, Math.random() * 2, Math.random() * 2 );
	
	scene.add( Mesh );
}

function torusLeave( x, y, z ){

	var s = Math.random() * 1 + 1;
	parent = new THREE.Object3D();			
	parent.position.y = 0;
	scene.add( parent );
	var deg = Math.PI / 180;

	//function addGeometry( geometry, points, spacedPoints, color, x, y, z, rx, ry, rz, s ) {

		
	var extrudeSettings = {	amount: 1,  bevelEnabled: false, bevelSegments: 1, steps: 1 }; // bevelSegments: 2, steps: 2 , bevelSegments: 5, bevelSize: 8, bevelThickness:5,

    // leave
	
	
	var leaveShape = new THREE.Shape();
	leaveShape.moveTo( 0, 0 );
	leaveShape.bezierCurveTo( 5, 8, -5, 8, -2, 0 );
	leaveShape.bezierCurveTo( -10, 5, -10, -5, -2, -2 );
	leaveShape.bezierCurveTo( -5, -8, 5, -8, 0, -2 );
	leaveShape.bezierCurveTo( 10, -5, 10, 5, 0, 0 );
	//leaveShape.bezierCurveTo( 9, 2, 5, 8, 0, 0 );


	var leave3d = leaveShape.extrude( extrudeSettings );
	var leavePoints = leaveShape.createPointsGeometry();
	var leaveSpacedPoints = leaveShape.createSpacedPointsGeometry();


	var rx = Math.random() * 30 + 120;
		ry =  Math.random() * 180;
		rz = Math.random() * 180;
    addGeometry( leave3d, leavePoints, leaveSpacedPoints, dc,  x, y, z, rx, ry, rz, s );
    
}	
	
	 


	
	
		


	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
		