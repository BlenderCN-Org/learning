
//Draw the object starting at (x1,y1,z1) with a length of 'len' and z-rotation angle of ang, y-rotation angle of angy
//d: pass-by value, in this function it determines the thickness of the Object
//leave: since the objects drawn in the function is branches, it makes it easier to add leave through a bullion.
//leave=1: draw leave; =0: don't draw.
/*function Draw( d, len, x1, y1, z1, ang, angy, leave ) {

	var rad;
	//var d1 = 6;
	//the radius of the tube should be larger then 3 for a visible 3D effect, and integers.
	
		rad = Math.max( 3, d );
	 //thickness of the branch/trunk
	var deg = Math.PI / 180;
	var x2 = rX( x1, len, ang, angy ),
		y2 = rY( y1, len, ang, angy ),
		z2 = rZ( z1, len, ang, angy );
	
	var branchpath =  new THREE.LineCurve3(new THREE.Vector3(x1,y1,z1), new THREE.Vector3(x2,y2,z2));
	var geometry = new THREE.TubeGeometry( branchpath, 3, rad, rad, false, false );
	

	branchMesh = new THREE.Mesh( geometry, new THREE.MeshPhongMaterial({
						color: 0x552200,
 						ambient: 0x333333,
 						shininess: 0.8,
 						opacity: 1 } ) );//map: texture }));

	branchMesh.dynamic = true;
	
	scene.add( branchMesh );
	
	if ( leave == 1 ){
		Stem( x2, y2, z2, ang, angy );
		Stem( x2, y2, z2, Math.random()* 90, Math.random() * 360)
	}

}

//
function Draw2( len, x, y, z, ang, angy, color ) {

	//var len = Math.random() * 10 + 10;
	var deg = Math.PI / 180;
	var x2 = x + len * Math.cos( ang * deg ) * Math.cos( angy * deg ),
		y2 = y + len * Math.sin( ang * deg ),
		z2 = z + len * Math.cos( ang * deg ) * Math.sin( angy * deg );
	
	var Geometry2 = new THREE.Geometry();
	Geometry2.vertices.push( new THREE.Vector3( x, y, z ) );
	Geometry2.vertices.push( new THREE.Vector3( x2, y2, z2 ) );
	
	var Material2 = new THREE.LineBasicMaterial( { color: color, opacity: 0.8, linewidth: 2 } );
	
	var draw2 = new THREE.Line( Geometry2, Material2 );
	scene.add( draw2 );
	

}
*/

/*function Stem( d, x, y, z, ang, angy, color ) {
	var len = Math.random() * 5 + 8;
	//var deg = Math.PI / 180;
	var b = Rot( len, x, y, z, ang, angy );

	
	if ( d != 0 ) {
	 	var color = Math.floor( Math.random() * 0x0000ff ) * 0x000100 + 0x00ff00;
		Draw2( d, x, y, z, b.x, b.y, b.z, color );
		Draw2( d, x, y, z, b.x - 5, b.y + 5, b.z - 5, color );
		Draw2( d, x, y, z, b.x - 1, b.y + 8, b.z + 1, color );
		Stem( d - 1,  b.x, b.y, b.z, Math.max( ang - 30, -90 ), angy, color );
	}
	if( d)

}
*/

function Acacia2( d, d1, len, x, y, z, ang, angy, m, color ){
	
	var deg = Math.PI / 180;
	/*var len;
	if( d > d1 - 1 ){
	
		len = 150 / d1 + Math.random() * 20;//trunk
	
	}
	else if( d > d1 - 2 ) {
	
		len = d * ( 60 / d1 + Math.random() * 10 );
	
	}
	
	else if( d > d1 - 3 ) {
		
		len = d * ( 40 / d1 + Math.random() * 5 );
		
	}
	
	else {
	
		len = d * ( 20 / d1 + Math.random() * 10 );
		
	}
	*/
	var a = Rot( len, x, y, z, ang, angy );
		
	if( d != 0 ) {
		if( m == "2D Line" ){
			Draw2( d, x, y, z, a.x, a.y, a.z, color );
		}
		
		if( m == "3D Tube" ){
			Draw( d, x, y, z, a.x, a.y, a.z, color );
		}

		if( d > d1 - 1 ) {
		
			Acacia2( d - 1, d1, len * 0.8, a.x + 1, a.y, a.z, 57, angy, m, color );
			Acacia2( d - 1, d1, len * 0.8, a.x - 1, a.y, a.z, 60 - Math.random() * 10, angy + 100 + Math.random() * 40, m, color );
			Acacia2( d - 1, d1, len * 0.8, a.x + 0.5, a.y, a.z, 53 - Math.random() * 10, angy + 240 + Math.random() * 40, m, color );
		}
		else if( d > d1 - 2 ) {
		
			Acacia2( d - 1, d1, len * 0.8, a.x, a.y, a.z, ang + Math.random() * 5, angy, m, color );
		
		}
		else if( d > d1 - 3 ){

			Acacia2( d - 1, d1, len * 0.8, a.x, a.y, a.z, ang - 6 , angy, m, color );
			Acacia2( d - 1, d1, len * 0.8, a.x, a.y, a.z, ang + 5 , angy + 100 + Math.random() * 40, m, color );//+ 100 + Math.random() * 40 );
			var bool = Math.floor( Math.random() * 2 );
			if( bool == 1 ){
				Acacia2( d - 1, d1, len * 0.8, a.x, a.y, a.z, ang - 8, angy + 240 + Math.random() * 40, m, color );
			}
		}
		else {

			Acacia2( d - 1, d1, len * 0.8, a.x, a.y, a.z, ang - 6 , angy, m, color );
			Acacia2( d - 1, d1, len * 0.8, a.x, a.y, a.z, ang + 5 , angy + 180 + Math.random() * 40, m, color );
			if( bool == 0 ){
				Acacia2( d - 1, d1, len * 0.8, a.x, a.y, a.z, ang - 8, angy + 240 + Math.random() * 40, m, color );
			}
		}
	
		
	}
	
	if ( d == 0 ) {
		
		Leave( x, y, z );
		Dec( x, y - 3, z );
						
	}
}
		
		
	
