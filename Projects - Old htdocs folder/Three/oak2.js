function Oak( d, d1, len, x, y, z, ang, angy, m, color ) {


	var a = Rot( len, x, y, z, ang, angy );
	
	/*var branchpath =  new THREE.LineCurve3(new THREE.Vector3(x,y,z), new THREE.Vector3(x2,y2,z2));
	
	var geometry = new THREE.TubeGeometry( branchpath, 3, radius, radius, false, true );
	exture.needsUpdate = true;

	branchMesh = new THREE.Mesh( geometry, new THREE.MeshPhongMaterial({
						color: 0x552200,
 						ambient: 0x333333,
 						shininess: 0.8,
 						opacity: 1 } ) );//map: texture }));

	scene.add( branchMesh );
	var i = this.d;
	*/
	if( d != 0 ) {
		if( m == "2D Line" ){
			Draw2( d, x, y, z, a.x, a.y, a.z, color );
		}
		if( m == "3D Tube" ){
			Draw( d, x, y, z, a.x, a.y, a.z, color );
		}
		if( d >  d1 - 1 ) {
			
	
			Oak( d - 1, d1, len * 0.8, a.x-1, a.y-3, a.z-1, ang + 30, 70, m, color );
			Oak( d - 1, d1, len * 0.8, a.x-1, a.y-3, a.z-1, ang - 30, 0, m, color );
			Oak( d - 1, d1, len * 0.8, a.x-1, a.y-3, a.z-1, ang + 30, 300, m, color );
		
		}
	
		else if( d > d1 - 2 ){
			
			Oak( d - 1, d1, len * 0.8, a.x, a.y-5, a.z, ang + 30, angy - 60, m, color );
			Oak( d - 1, d1, len * 0.8, a.x, a.y-5, a.z, ang + 30, angy + 60, m, color  );
			
			
		}
		else{
			var tlen = Math.random() * 10 + 5 * d; //length of twig

			var b1 = Rot( tlen, x, y, z, ang + 60, Math.random() * 360 );
			var b2 = Rot( tlen, x, y, z, ang - 60, Math.random() * 360 );

			Draw2( d, x, y, z, b1.x, b1.y, b1.z, color );
			Leave( b1.x, b1.y, b1.z );
			Draw2( d, x, y, z, b2.x, b2.y, b2.z, color );
			Leave( b2.x, b2.y, b2.z );
			var angyy = Math.random() * 50 + 20;
		 	Oak( d - 1, d1, len * 0.8, a.x-1, a.y-5, a.z-1, ang + 30, angy + angyy, m, color );
			Oak( d - 1, d1, len * 0.8, a.x-1, a.y-5, a.z-1, ang - 30, angy - angyy, m, color );
		
		}
		
	}
	
	if ( d == 0 ) {
		Leave( x, y, z );
		Dec( x, y - 3, z );
	}
	
};
