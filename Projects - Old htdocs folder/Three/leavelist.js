var choice;
var lc;

function Leavelist( s, c ){
	lc = c;
	switch( s ) {
	    case "Null": choice = 0; break;
		case "Round": choice = 1; break;
		case "Pine": choice = 2; break;
		case "Willow": choice = 3; break;
		case "Maple": choice = 4; break;
		case "Oak": choice = 5; break;
		case "Gingko": choice = 6; break;
		case "Acacia": choice = 7; break;

		
	}

	
}

function Leave( x, y, z ) {
	
	switch( choice ) {
		case 0: break;
		case 1: roundLeave( x, y, z ); break;
		case 2: pineLeave( x, y, z ); break;
		case 3: willowLeave( x, y, z ); break;
		case 4: mapleLeave( x, y, z ); break;
		case 5: oakLeave( x, y, z ); break;
		case 6: gingkoLeave( x, y, z ); break;
		case 7: acaciaLeave( x, y, z ); break;

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
function roundLeave( x, y, z ){
	var s = Math.random() * 0.5 + 0.5;
	parent = new THREE.Object3D();			
	parent.position.y = 0;
	scene.add( parent );
	var deg = Math.PI / 180;

	//function addGeometry( geometry, points, spacedPoints, color, x, y, z, rx, ry, rz, s ) {

		
	var extrudeSettings = {	amount: 1,  bevelEnabled: false, bevelSegments: 1, steps: 1 }; // bevelSegments: 2, steps: 2 , bevelSegments: 5, bevelSize: 8, bevelThickness:5,

    // leave

	var leaveShape = new THREE.Shape();
	leaveShape.moveTo(  0, 0 );
	leaveShape.arc( 0, 0, 10, 0, 2.5 * Math.PI, 0 );

	var leave3d = leaveShape.extrude( extrudeSettings );
	var leavePoints = leaveShape.createPointsGeometry();
	var leaveSpacedPoints = leaveShape.createSpacedPointsGeometry();

	var rx = Math.random() * 30 - 15,
		ry =  Math.random() * 90 * deg,
		rz = ( Math.random() * 180 - 90 ) * deg;
    addGeometry( leave3d, leavePoints, leaveSpacedPoints, lc,  x, y, z, rx, ry, rz, s );


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

function pineLeave( x, y, z ){
	for( var i = 0; i < 20; i ++ ){
		Draw2( 1, x, y, z, x + Math.random() * 20 - 10 , y+Math.random() * 15 + 2, z + Math.random() * 20 - 10 , lc );
	}

}

function willowLeave( x, y, z ){
	var s = Math.random() * 1.5 + 0.5;
	parent = new THREE.Object3D();			
	parent.position.y = 0;
	scene.add( parent );
	var deg = Math.PI / 180;

	//function addGeometry( geometry, points, spacedPoints, color, x, y, z, rx, ry, rz, s ) {

		
	var extrudeSettings = {	amount: 1,  bevelEnabled: false, bevelSegments: 1, steps: 1 }; // bevelSegments: 2, steps: 2 , bevelSegments: 5, bevelSize: 8, bevelThickness:5,

    // leave
	
	
	var leaveShape = new THREE.Shape();
	leaveShape.moveTo(  0, 0 );
	leaveShape.bezierCurveTo( 2, 3, 2, 6, 0, 9 );
	leaveShape.bezierCurveTo( -2, 6, -2, 3, 0, 0 );
	
	var leave3d = leaveShape.extrude( extrudeSettings );
	var leavePoints = leaveShape.createPointsGeometry();
	var leaveSpacedPoints = leaveShape.createSpacedPointsGeometry();


	var rx = Math.random() * 30 - 15,
		ry =  Math.random() * 90 * deg,
		rz = ( Math.random() * 180 - 90 ) * deg;
    addGeometry( leave3d, leavePoints, leaveSpacedPoints, lc,  x, y, z, rx, ry, rz, s );

}	

function mapleLeave( x, y, z ){


	var s = Math.random() * 2 + 1;
	parent = new THREE.Object3D();			
	parent.position.y = 0;
	scene.add( parent );
	var deg = Math.PI / 180;

	//function addGeometry( geometry, points, spacedPoints, color, x, y, z, rx, ry, rz, s ) {

		
	var extrudeSettings = {	amount: 1,  bevelEnabled: false, bevelSegments: 1, steps: 1 }; // bevelSegments: 2, steps: 2 , bevelSegments: 5, bevelSize: 8, bevelThickness:5,

    // leave
	
	
	var leaveShape = new THREE.Shape();
	leaveShape.moveTo(  0, 0 ); leaveShape.lineTo( 3, -1 ); leaveShape.lineTo( 2.5, 0 );
	leaveShape.lineTo( 6, 2 ); leaveShape.lineTo( 5, 2.5 ); leaveShape.lineTo( 5.5, 4 );
	leaveShape.lineTo( 4.5, 3.5 ); leaveShape.lineTo( 3, 5 );
	leaveShape.lineTo( 2, 3 ); leaveShape.lineTo( 2.5, 7 );
	leaveShape.lineTo( 1, 6.5 ); leaveShape.lineTo( 0, 9 );
	leaveShape.lineTo( -1, 6.5 ); leaveShape.lineTo( -2.5, 7 );
	leaveShape.lineTo( -2, 3 ); leaveShape.lineTo( -3, 5 );
	leaveShape.lineTo( -4.5, 3.5 ); leaveShape.lineTo( -5.5, 4 );
	leaveShape.lineTo( -5, 2.5 ); leaveShape.lineTo( -6, 2 );
	leaveShape.lineTo( -2.5, 0 ); leaveShape.lineTo( -3, -1 );
	
	var leave3d = leaveShape.extrude( extrudeSettings );
	var leavePoints = leaveShape.createPointsGeometry();
	var leaveSpacedPoints = leaveShape.createSpacedPointsGeometry();


	var rx = Math.random() * 30 - 15,
		ry =  Math.random() * 90 * deg,
		rz = ( Math.random() * 180 - 90 ) * deg;
    addGeometry( leave3d, leavePoints, leaveSpacedPoints, lc,  x, y, z, rx, ry, rz, s );

}	

function oakLeave( x, y, z ){

	var s = Math.random() * 0.7 + 0.5;	
	parent = new THREE.Object3D();			
	parent.position.y = 0;
	scene.add( parent );
	var deg = Math.PI / 180;

	//function addGeometry( geometry, points, spacedPoints, color, x, y, z, rx, ry, rz, s ) {
	function addGeometry( geometry, points, spacedPoints, color, x, y, z, rx, ry, rz, s ) {

		var mesh = THREE.SceneUtils.createMultiMaterialObject( geometry, 
			[ new THREE.MeshLambertMaterial( { color: color } ), 
			  new THREE.MeshBasicMaterial( { color: color, opacity: 0.5 } ) ] );
		mesh.position.set( x, y, z );
		
		mesh.rotation.set( rx, ry, rz );
		mesh.scale.set( s, s, s );
		parent.add( mesh );
					
	}
		
	var extrudeSettings = {	amount: 1,  bevelEnabled: false, bevelSegments: 1, steps: 1 }; // bevelSegments: 2, steps: 2 , bevelSegments: 5, bevelSize: 8, bevelThickness:5,

    // leave

	var leaveShape = new THREE.Shape();
	leaveShape.moveTo(  0, 0 );
	
	//c.bezierCurveTo(0+unit, 0-unit, 0+2*unit, 0, 0, 0+1.5*unit);
	//c.bezierCurveTo(0-2*unit, 0, 0-unit, 0-unit, 0, 0);
	leaveShape.bezierCurveTo( 5, 0, 1, 3, 2, 2 );//1
	leaveShape.bezierCurveTo( 1, 3, 2, 4, 3, 5 );//2
	leaveShape.bezierCurveTo( 4, 6, 6, 7, 5, 8 );//3
	leaveShape.bezierCurveTo( 3, 9, 4, 10, 5, 11 );//4
	leaveShape.bezierCurveTo( 7, 14, 6, 18, 4, 16 );//5
	leaveShape.bezierCurveTo( 3, 16, 3.5, 17, 4, 18 );//6
	leaveShape.bezierCurveTo( 4.5, 19.5, 4, 21, 3, 20 );//7
	leaveShape.bezierCurveTo( 2, 19, 1.5, 20, 1.5, 21 );//8
	leaveShape.bezierCurveTo( 1.5, 22, 1, 23, 0, 24 );//9
	leaveShape.bezierCurveTo( -1, 23, -1.5, 22, -1.5, 21 );//-9
	leaveShape.bezierCurveTo( -1.5, 20, -2, 19, -3, 20 );//-8
	leaveShape.bezierCurveTo( -4, 21, -4.5, 19.5, -4, 18 );//-7
	leaveShape.bezierCurveTo( -3.5, 17, -3, 16, -4, 16 );//-6
	leaveShape.bezierCurveTo( -6, 18, -7, 14, -5, 11 );//-5
	leaveShape.bezierCurveTo( -4, 10, -3, 9, -5, 8 );//-4
	leaveShape.bezierCurveTo( -6, 7, -4, 6, -3, 5 );//-3
	leaveShape.bezierCurveTo( -2, 4, -1, 3, -2, 2 );//-2
	leaveShape.bezierCurveTo( -1, 3, -5, 0, 0, 0 );//-1
	
	leaveShape.bezierCurveTo( 0, 0 ); // close path

	var leave3d = leaveShape.extrude( extrudeSettings );
	var leavePoints = leaveShape.createPointsGeometry();
	var leaveSpacedPoints = leaveShape.createSpacedPointsGeometry();

    addGeometry( leave3d, leavePoints, leaveSpacedPoints, lc,  x, y, z, Math.random() * 30 - 15, Math.random() * 90 * deg, ( Math.random() * 180 - 90 ) * deg, s );

	
	
}

function gingkoLeave( x, y, z ){
	var s = Math.random() * 0.5 + 0.5;
	parent = new THREE.Object3D();			
	parent.position.y = 0;
	scene.add( parent );
	var deg = Math.PI / 180;

	//function addGeometry( geometry, points, spacedPoints, color, x, y, z, rx, ry, rz, s ) {

		
	var extrudeSettings = {	amount: 1,  bevelEnabled: false, bevelSegments: 1, steps: 1 }; // bevelSegments: 2, steps: 2 , bevelSegments: 5, bevelSize: 8, bevelThickness:5,

    // leave
	var sp = Math.random() * 90 * deg; //sp is the position of separation
	var sp1 = sp + 5 * deg;
	
	var leaveShape = new THREE.Shape();
	leaveShape.moveTo(  0, 0 );
	leaveShape.arc( 0, 0, 10, 0, sp, 0 );
	//leaveShape.moveTo( 0, 0 );
	//leaveShape.arc( 0, 0, 5, sp, 120 * deg, 0 );
	
	var leave3d = leaveShape.extrude( extrudeSettings );
	var leavePoints = leaveShape.createPointsGeometry();
	var leaveSpacedPoints = leaveShape.createSpacedPointsGeometry();

	var leaveShape2 = new THREE.Shape();
	leaveShape2.moveTo( 0, 0 );
	leaveShape2.arc( 0, 0, 10, sp1, 120 * deg, 0 );
	var leave3d2 = leaveShape2.extrude( extrudeSettings );
	var leavePoints2 = leaveShape2.createPointsGeometry();
	var leaveSpacedPoints2 = leaveShape2.createSpacedPointsGeometry();
	
	var rx = Math.random() * 30 - 15,
		ry =  Math.random() * 90 * deg,
		rz = ( Math.random() * 180 - 90 ) * deg;
	addGeometry( leave3d2, leavePoints2, leaveSpacedPoints2, 0xddff00, x, y, z, rx, ry, rz, s );
    addGeometry( leave3d, leavePoints, leaveSpacedPoints, 0xddff00,  x, y, z, rx, ry, rz, s );

	
	
}

function Stem( d, x, y, z, ang, angy ) {
		var len = Math.random() * 5 + 3;
		var a = Rot( len, x, y, z, ang, angy );
		var a1 = Rot( len, x, y, z, ang - d * 15, angy );
		var a2 = Rot( len, x, y, z, ang + d * 15, angy );
	
		if ( d != 0 ) {
			Draw2( 1, x, y, z, a.x, a.y, a.z, lc );
			Draw2( 1, x, y, z, a1.x, a1.y, a1.z, lc );
			Draw2( 1, x, y, z, a2.x, a2.y, a2.z, lc );
			Stem( d - 1,  a.x, a.y, a.z, Math.max( ang - 30, -90 ), angy );
		}

	}
function acaciaLeave( x, y, z ){
	var d = 6;
	var ang = Math.random() * 90;
	var deg = Math.PI / 180;
	var angy = Math.random() * 360;
	Stem( d, x, y, z, ang, angy )

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
    addGeometry( leave3d, leavePoints, leaveSpacedPoints, lc,  x, y, z, rx, ry, rz, s );

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
    addGeometry( leave3d, leavePoints, leaveSpacedPoints, lc,  x, y, z, rx, ry, rz, s );
    
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
    addGeometry( leave3d, leavePoints, leaveSpacedPoints, lc,  x, y, z, rx, ry, rz, s );
    
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
    addGeometry( leave3d, leavePoints, leaveSpacedPoints, lc,  x, y, z, rx, ry, rz, s );
    
}	
	
	 


	
	
		


	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
		