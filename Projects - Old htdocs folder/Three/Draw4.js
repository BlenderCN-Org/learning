//This function draws 3d graphics in 3d dimension
//Draw the object starting at (x1,y1,z1) with a length of 'len' and z-rotation angle of ang, y-rotation angle of angy
//d: pass-by value, in this function it determines the thickness of the Object
//color: since the objects drawn in the function is branches, it makes it easier to add leave through a bullion.
function Draw( d, x1, y1, z1, x2, y2, z2, color ) {

	var rad;
	//var d1 = 6;
	//the radius of the tube should be larger then 3 for a visible 3D effect, and integers.
	
		rad = Math.max( 3, d );
	 //thickness of the branch/trunk
	var deg = Math.PI / 180;
	//function rot( x, y, z, len, ang, angy, theta ) 

	
	var branchpath =  new THREE.LineCurve3(new THREE.Vector3(x1,y1,z1), new THREE.Vector3(x2,y2,z2));
	var geometry = new THREE.TubeGeometry( branchpath, 3, rad, rad, false, false );
	

	branchMesh = new THREE.Mesh( geometry, new THREE.MeshPhongMaterial({
						color: color,
 						ambient: 0x333333,
 						shininess: 0.8,
 						opacity: 1 } ) );//map: texture }));
	branchMesh.castShadow = true;
	branchMesh.receiveShadow = true;
	branchMesh.dynamic = true;
	
	scene.add( branchMesh );
	
	

}

//This function is used for drawing 2d graphics in 3d vision.
function Draw2( d, x, y, z, x2, y2, z2, color ) {

	//var len = Math.random() * 10 + 10;
	
	var Geometry2 = new THREE.Geometry();
	Geometry2.vertices.push( new THREE.Vector3( x, y, z ) );
	Geometry2.vertices.push( new THREE.Vector3( x2, y2, z2 ) );
	
	var Material2 = new THREE.LineBasicMaterial( { color: color, opacity: 1, linewidth: d  } );
	
	var draw2 = new THREE.Line( Geometry2, Material2 );
	scene.add( draw2 );
	

}