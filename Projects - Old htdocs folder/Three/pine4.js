/*function Pine( d, x1, y1, z1, ang, angy, color ) {
		       
	var len = d * 5;

	
	var a = Rot( len, x1, y1, z1, ang + 20, angy );
	Draw2( 1, x1, y1, z1, a.x, a.y, a.z, color );
	Leave( a.x, a.y, a.z );
	var a1 = Rot( len, x1, y1, z1, ang - 20, angy );
	Draw2( 1, x1, y1, z1, a1.x, a1.y, a1.z, color );
	Leave( a1.x, a1.y, a1.z );
	var a2 = Rot( len, x1, y1, z1, ang, angy + 20 );
	Draw2( 1, x1, y1, z1, a2.x, a2.y, a2.z, color );
	Leave( a2.x, a2.y, a2.z );
	var a3 = Rot( len, x1, y1, z1, ang, angy - 20 );
	Draw2( 1, x1, y1, z1, a3.x, a3.y, a3.z, color );
	Leave( a3.x, a3.y, a3.z );
	var a4 = Rot( len, x1, y1, z1, ang + 20, angy + 20 );
	Draw2( 1, x1, y1, z1, a4.x, a4.y, a4.z, color );
	Leave( a4.x, a4.y, a4.z );
	var a5 = Rot( len, x1, y1, z1, ang + 20, angy - 20 );
	Draw2( 1, x1, y1, z1, a5.x, a5.y, a5.z, color );
	Leave( a5.x, a5.y, a5.z );
	var a6 = Rot( len, x1, y1, z1, ang - 20, angy + 20 );
	Draw2( 1, x1, y1, z1, a6.x, a6.y, a6.z, color );
	Leave( a6.x, a6.y, a6.z );	
	var a7 = Rot( len, x1, y1, z1, ang - 20, angy - 20 );
	Draw2( 1, x1, y1, z1, a7.x, a7.y, a7.z, color );
	Leave( a7.x, a7.y, a7.z );

    			
}
*/
/*function Snow(x1, y1, z1, sang, angy, d) {
		    	
		    	var material3 = new THREE.LineBasicMaterial( { color: 0xddddff, opacity: 0.4, linewidth: 1  } );
		    	var geometry3 = new THREE.Geometry();
		    	
		    	geometry3.vertices.push(new THREE.Vector3(x1, y1, z1)));
		    	geometry3.vertices.push(new THREE.Vertex(new THREE.Vector3(x1 - 1, y1 - 1, z1 + 1)));
		    	
		    	var snow = new THREE.Line( geometry3, material3 );
		    	var deg = Math.PI/180;
		    	snow.rotation.z = sang;
		    	snow.rotation.y = angy * deg;
		    	scene.add( snow );
}		
*/     
function Branch( d, len, x1, y1, z1, ang, angy, m, color ) {

	//var len = d * 1.5;
	//var deg = Math.PI/180;
	//var material = new THREE.LineBasicMaterial( { color: 0xff8844, opacity: 0.4, linewidth: 3  } );
	//var geometry = new THREE.Geometry();
	var a = Rot( len, x1, y1, z1, ang, angy );

	if ( d != 0 ) {
		
		/*var a = new THREE.Vector3();   		
			a.x = x1 + len * Math.cos( sang * deg );
			a.y = y1 + len * Math.sin( sang * deg );
			a.z = z1;
		geometry.vertices.push(new THREE.Vector3(x1, y1, z1));
		geometry.vertices.push(new THREE.Vector3(a.x, a.y, a.z));
    	*/
    	if( m=="2D Line" ){
    		Draw2( d, x1, y1, z1, a.x, a.y, a.z, color );
    	}
    	if( m=="3D Tube" ){
    		Draw( d, x1, y1, z1, a.x, a.y, a.z, color );
    	}
    	
    	//var branch = new THREE.Line( geometry, material );

    	//branch.rotation.y = angy * deg;
    	//scene.add( branch );
    	//Snow(x2, y2, z2, sang, angy, d);
    	//Pine( d, a.x, a.y, a.z, ang, angy, color ); 
    	//Pine( d, a.x, a.y, a.z, ang-30, angy, color );
    	Leave( a.x, a.y, a.z );
    	Dec( a.x, a.y - 3, a.z );			
    	Branch( d - 1, len * 0.8, a.x, a.y, a.z, ang + 2, angy, m, color );
    				
    			
    }
    			
    			    			
}


function PineTree( d, len, x1, y1, z1, sang, sangy, m, color ) {
    		
    //var material1 = new THREE.LineBasicMaterial( { color: 0xff8844, opacity: 0.4, linewidth: d * 4  } );
	//var geometry1 = new THREE.Geometry();
    var x2 = x1, y2 = y1 + len, z2 = z1;
	
    if ( d != 0 ) {
    					
    	//var len = d * 5;
    	if( m == "2D Line" ){
    		Draw2( d, x1, y1, z1, x2, y2, z2, color );
    	}
    	if( m == "3D Tube" ){
    		Draw( d, x1, y1, z1, x2, y2, z2, color );
    	}
    	//geometry1.vertices.push(  new THREE.Vector3( x1, y1, z1 )  );
    	//geometry1.vertices.push( new THREE.Vector3( x2, y2, z2 )  );
    	//var trunk = new THREE.Line( geometry1, material1 );
    	//scene.add( trunk );
    					
    	Branch( d - 1, len * 0.5, x2, y2, z2, sang, sangy + 0, m, color ); 
    	
    	Branch( d - 1, len * 0.5, x2, y2, z2, sang, sangy + 60, m, color );
    	Branch( d - 1, len * 0.5, x2, y2, z2, sang, sangy + 120, m, color );
    	Branch( d - 1, len * 0.5, x2, y2, z2, sang, sangy + 180, m, color );
    	Branch( d - 1, len * 0.5, x2, y2, z2, sang, sangy + 240, m, color );
    	Branch( d - 1, len * 0.5, x2, y2, z2, sang, sangy + 300, m, color );
    				
    	PineTree( d - 1, len * 0.8, x2, y2, z2, sang + 10, sangy + 30, m, color );
    					
    }
    if( d == 0 ){
		//Pine( 2, x1, y1, z1, sang, sangy, color );
		Leave( x, y, z );
		Dec( x, y - 3, z );
    }
    
}
