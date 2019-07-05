//This function draws the stems of leave, it uses a line with a width of 2 to present the stems, 
//and has a leaf on the end point. 
function gStem( x, y, z, ang, angy, color ) {

	var len = Math.random() * 7 + 5;
	var gs = Rot( len, x, y, z, ang, angy );
	Draw2( 2, x, y, z, gs.x, gs.y, gs.z, color );
	
	
	
	Leave( gs.x, gs.y, gs.z );
	Dec( gs.x, gs.y - 3, gs.z );

}


function gTwig( d, len, x, y, z, ang, angy, color ) {

	var gt = Rot( len, x, y, z, ang, angy );
		
	if ( d != 0 ){
		Draw2( d, x, y, z, gt.x, gt.y, gt.z, color );
		gTwig( d - 1, len * 0.8, gt.x, gt.y, gt.z, ang + d, angy, color );
		gStem( gt.x, gt.y, gt.z, ang, angy, color );
		gStem( gt.x, gt.y, gt.z, ang + Math.random() * 90, Math.random() * 360, color );

	}
	if ( d == 0 ){
		gStem( x, y, z, ang, angy, 0xddff00 );
		gStem( x, y, z, ang + Math.random() * 90, Math.random() * 360, 0xddff00 );
	}
	
}

function gBranch( d, len, x, y, z, ang, angy, m, color ) {
	
	
	var gb = Rot( len, x, y, z, ang, angy );

	if ( d != 0 ){
		if( m == "2D Line" ){
			Draw2( d, x, y, z, gb.x, gb.y, gb.z, color );
		}
		if( m == "3D Tube" ){
			Draw( d, x, y, z, gb.x, gb.y, gb.z, color );
		}
		if ( d > 5 ) {
			gBranch( d - 1, len * 0.8, gb.x, gb.y, gb.z, ang + d, angy, m, color );
		}
		else{

			var dd2 = Math.floor( d / 2 ) + 1;
			gTwig( dd2, len, gb.x, gb.y, gb.z, ang - d * 3, d * 90 + Math.random() * 20, color );
			gBranch( d - 1, len * 0.8, gb.x, gb.y, gb.z, ang + d, angy, m, color );
	
		}
	}
	
}


//Recursively use gingko to complete the branches, then draw twigs, then leaves.
//count: number of child branches on parent branchMesh
//d: number of recursive time, typically 3 is enough
//x,y,z: start point
//ang, angy: rotation angle

function Gingko2( d, d1, len, x, y, z, ang, angy, m, color ) {
	
	var a = new THREE.Vector3();
	
	if( d != 0 ) {
		
		if( d > d1 - 1 ) { 
			a = Rot( 80, x, y, z, ang, angy );
		}
		else{ 
			a = Rot( len, x, y, z, ang, angy ); 
		}
		
		if( m == "2D Line" ){
			Draw2( d, x, y, z, a.x, a.y, a.z, color );
		}
		if( m == "3D Tube" ){
			Draw( d, x, y, z, a.x, a.y, a.z, color );
		}


		var dd = Math.floor( d / 2 ) + 1;
		gBranch( dd, len, a.x, a.y, a.z, ang - d * 5, d * 90 + Math.random() * 40, m, color );
		Gingko2( d - 1, d1, len * 0.8, a.x, a.y, a.z, ang, angy, m, color );
		
	}

}

