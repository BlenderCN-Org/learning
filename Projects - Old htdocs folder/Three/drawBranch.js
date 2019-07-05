var deg = Math.PI / 180;

// Draw a self-defined branch
// d: level of growth
// len: coefficient of length, len = i(count) * l thus branch length would be reduced with i
// n: number of generated branch from the node 
// ( x, y, z ): start point of the branch
// ang: angle by z-axis ( vertical plane )
// angy: angle by y-axis ( horizontal plane )
// theta: rotation angle around the parent branch axis
// rang: rotation angle by z-axis
// rangy: rotation angle by y-axis
// rangt: rotation angle by prrent-axis
// random: random angle in general
// color: color 

function drawBranch( d, len, n, x, y, z, ang, angy, rang, rangy, random, m, color ){
	
	var rand = Math.random() * random - Math.floor( random / 2 );
  	var a = Rot( len, x, y, z, ang, angy ); 
	if( m == "3D Tube" ){
		Draw( d, x, y, z, a.x, a.y, a.z, color );
	}
	if( m == "2D Line" ){
		Draw2( d, x, y, z, a.x, a.y, a.z, color );
	}
	
	
	if( d != 0 ) {
		
		//Draw2( d, len, x, y, z, ang, angy, color )
		//Draw( d, len, x1, y1, z1, ang, angy, color ) 
		
		if ( n == 1 ){
		
			drawBranch( d - 1, len * 0.8, n, a.x, a.y, a.z, ang + rang + rand, angy + rangy + rand, rang, rangy, random, m, color );
		
		}
		if ( n == 2 ){
		
			drawBranch( d - 1, len * 0.8, n, a.x, a.y, a.z, ang + rang + rand, angy + rand, rang, rangy, random, m, color );			
			drawBranch( d - 1, len * 0.8, n, a.x, a.y, a.z, ang - rang + rand, angy + rangy + rand, rang, rangy, random, m, color );

		}
		if ( n == 3 ){
		
			drawBranch( d - 1, len * 0.8, n, a.x, a.y, a.z, ang + rang, angy + rand, rang, rangy, random, m, color );
			drawBranch( d - 1, len * 0.8, n, a.x, a.y, a.z, ang - rang + rand, angy - 2 * rangy + rand, rang, rangy, random, m, color );
			drawBranch( d - 1, len * 0.8, n, a.x, a.y, a.z, ang - rang - rand, angy + rangy + rand, rang, rangy, random, m, color );
			
		} 
		if ( n == 4 ){
			
			drawBranch( d - 1, len * 0.8, n, a.x, a.y, a.z, ang + rang, angy + rand, rang, rangy, random, m, color );
			drawBranch( d - 1, len * 0.8, n, a.x, a.y, a.z, ang - rang + rand, angy - rangy - rand, rang, rangy, random, m, color );
			drawBranch( d - 1, len * 0.8, n, a.x, a.y, a.z, ang - rang - rand, angy + 2 * rangy + rand, rang, rangy, random, m, color );
			drawBranch( d - 1, len * 0.8, n, a.x, a.y, a.z, ang + rang + rand, angy - 2 * rangy + rand, rang, rangy, random, m, color );
			
		}
		if ( n == "mix1" ){
		
			mix1( d, len, a.x, a.y, a.z, ang, angy, rang, rangy, random, m, color );
		
		}
		if ( n == "mix2" ){
			
			mix2( d, len, d, a.x, a.y, a.z, ang, angy, rang, rangy, random, m, color );
			
		}
		if ( n == "mix3" ){
		
			mix3( d, len, a.x, a.y, a.z, ang, angy, rang, rangy, random, m, color );
			
		}
		if ( n == "mix4" ){
			
			mix4( d, len, d, a.x, a.y, a.z, ang, angy, rang, rangy, random, m, color );
			
		}
			
	}
	if( d == 0 ){
		Leave( a.x, a.y, a.z );
		Dec( a.x, a.y - 3, a.z );
	}
	
}

// This function draws branches in a pattern of "1+1+1+...+1+2+3+4"( numbers mean the growing nodes in each level )
function mix1( d, len, x, y, z, ang, angy, rang, rangy, random, m, color ){
	
	var a = Rot( len, x, y, z, ang, angy ); 
	var rand = Math.random() * random - Math.floor( random / 2 );

	if( m == "3D Tube" ){
		Draw( d, x, y, z, a.x, a.y, a.z, color );
	}
	if( m == "2D Line" ){
		Draw2( d, x, y, z, a.x, a.y, a.z, color );
	}
	if( d != 0 ){
	if( d > 3 ){
		mix1( d - 1, len * 0.8, a.x, a.y, a.z, ang + rang + rand, angy + rangy + rand, rang, rangy, random, m, color );
	}
	else if( d > 2 ){
		mix1( d - 1, len * 0.8, a.x, a.y, a.z, ang + rang + rand, angy + rand, rang, rangy, random, m, color );
		mix1( d - 1, len * 0.8, a.x, a.y, a.z, ang - rang + rand, angy + rangy + rand, rang, rangy, random, m, color );
	}
	else if( d > 1 ){
		
		mix1( d - 1, len * 0.8, a.x, a.y, a.z, ang + rang, angy + rand, rang, rangy, random, m, color );
		mix1( d - 1, len * 0.8, a.x, a.y, a.z, ang - rang + rand, angy - rangy + rand, rang, rangy, random, m, color );
		mix1( d - 1, len * 0.8, a.x, a.y, a.z, ang - rang - rand, angy + rangy + rand, rang, rangy, random, m, color );
	}
	else{
	
		mix1( d - 1, len * 0.8, a.x, a.y, a.z, ang + rang, angy + rand, rang, rangy, random, m, color );
		mix1( d - 1, len * 0.8, a.x, a.y, a.z, ang - rang + rand, angy - rangy - rand, rang, rangy, random, m, color );
		mix1( d - 1, len * 0.8, a.x, a.y, a.z, ang - rang - rand, angy + 2 * rangy + rand, rang, rangy, random, m, color );
		mix1( d - 1, len * 0.8, a.x, a.y, a.z, ang + rang + rand, angy - 2 * rangy + rand, rang, rangy, random, m, color );
			
	}
	}
	if( d == 0 ){
		Leave( a.x, a.y, a.z );
		Dec( a.x, a.y - 3, a.z );
	}
}

// This function draws branches in a pattern of "1+2+3+4+4+4+4+..."( numbers mean the growing nodes in each level )
function mix2( d, len, d1, x, y, z, ang, angy, rang, rangy, random, m, color ){
	
	var a = Rot( len, x, y, z, ang, angy ); 
	var rand = Math.random() * random - Math.floor( random / 2 );

	if( m == "3D Tube" ){
		Draw( d, x, y, z, a.x, a.y, a.z, color );
	}
	if( m == "2D Line" ){
		Draw2( d, x, y, z, a.x, a.y, a.z, color );
	}
	if( d != 0 ){
	if( d > d1 - 1 ){
		mix2( d - 1, len * 0.8, d1, a.x, a.y, a.z, ang + rang + rand, angy + rangy + rand, rang, rangy, random, m, color );
	}
	else if( d > d1 - 2 ){
		mix2( d - 1, len * 0.8, d1, a.x, a.y, a.z, ang + rang + rand, angy + rand, rang, rangy, random, m, color );
		mix2( d - 1, len * 0.8, d1, a.x, a.y, a.z, ang - rang + rand, angy + rangy + rand, rang, rangy, random, m, color );
	}
	else if( d > d1 - 3 ){
		
		mix2( d - 1, len * 0.8, d1, a.x, a.y, a.z, ang + rang, angy + rand, rang, rangy, random, m, color );
		mix2( d - 1, len * 0.8, d1, a.x, a.y, a.z, ang - rang + rand, angy - rangy + rand, rang, rangy, random, m, color );
		mix2( d - 1, len * 0.8, d1, a.x, a.y, a.z, ang - rang - rand, angy + rangy + rand, rang, rangy, random, m, color );
	}
	else{
	
		mix2( d - 1, len * 0.8, d1, a.x, a.y, a.z, ang + rang, angy + rand, rang, rangy, random, m, color );
		mix2( d - 1, len * 0.8, d1, a.x, a.y, a.z, ang - rang + rand, angy - rangy - rand, rang, rangy, random, m, color );
		mix2( d - 1, len * 0.8, d1, a.x, a.y, a.z, ang - rang - rand, angy + 2 * rangy + rand, rang, rangy, random, m, color );
		mix2( d - 1, len * 0.8, d1, a.x, a.y, a.z, ang + rang + rand, angy - 2 * rangy + rand, rang, rangy, random, m, color );
			
	}
	}
	if( d == 0 ){
		Leave( a.x, a.y, a.z );
		Dec( a.x, a.y - 3, a.z );

	}
}

// This function draws branches in a pattern of "4+4+4+...+4+3+2+1"( numbers mean the growing nodes in each level )
function mix3( d, len, x, y, z, ang, angy, rang, rangy, random, m, color ){
	
	var a = Rot( len, x, y, z, ang, angy ); 
	var rand = Math.random() * random - Math.floor( random / 2 );

	if( m == "3D Tube" ){
		Draw( d, x, y, z, a.x, a.y, a.z, color );
	}
	if( m == "2D Line" ){
		Draw2( d, x, y, z, a.x, a.y, a.z, color );
	}
	if( d != 0 ){
	if( d > 3 ){
	
		mix3( d - 1, len * 0.8, a.x, a.y, a.z, ang + rang, angy + rand, rang, rangy, random, m, color );
		mix3( d - 1, len * 0.8, a.x, a.y, a.z, ang - rang + rand, angy - rangy - rand, rang, rangy, random, m, color );
		mix3( d - 1, len * 0.8, a.x, a.y, a.z, ang - rang - rand, angy + 2 * rangy + rand, rang, rangy, random, m, color );
		mix3( d - 1, len * 0.8, a.x, a.y, a.z, ang + rang + rand, angy - 2 * rangy + rand, rang, rangy, random, m, color );
			
	}
	else if( d > 2 ){
	
		mix3( d - 1, len * 0.8, a.x, a.y, a.z, ang + rang, angy + rand, rang, rangy, random, m, color );
		mix3( d - 1, len * 0.8, a.x, a.y, a.z, ang - rang + rand, angy - rangy + rand, rang, rangy, random, m, color );
		mix3( d - 1, len * 0.8, a.x, a.y, a.z, ang - rang - rand, angy + rangy + rand, rang, rangy, random, m, color );
		
	}
		
	else if( d > 1 ){
	
		mix3( d - 1, len * 0.8, a.x, a.y, a.z, ang + rang + rand, angy + rand, rang, rangy, random, m, color );
		mix3( d - 1, len * 0.8, a.x, a.y, a.z, ang - rang + rand, angy + rangy + rand, rang, rangy, random, m, color );
		
	}
		
	else{
	
		mix3( d - 1, len * 0.8, a.x, a.y, a.z, ang + rang + rand, angy + rangy + rand, rang, rangy, random, m, color );	
		
	}
	}
	if( d == 0 ){
		Leave( a.x, a.y, a.z );
		Dec( a.x, a.y - 3, a.z );
	}
}

// This function draws branches in a pattern of "4+3+2+1+1+1+1+..."( numbers mean the growing nodes in each level )
function mix4( d, len, d1, x, y, z, ang, angy, rang, rangy, random, m, color ){
	
	var a = Rot( len, x, y, z, ang, angy ); 
	var rand = Math.random() * random - Math.floor( random / 2 );

	if( m == "3D Tube" ){
		Draw( d, x, y, z, a.x, a.y, a.z, color );
	}
	if( m == "2D Line" ){
		Draw2( d, x, y, z, a.x, a.y, a.z, color );
	}
	if( d != 0 ){
	if( d > d1 - 1 ){
	
		mix4( d - 1, len * 0.8, d1, a.x, a.y, a.z, ang + rang, angy + rand, rang, rangy, random, m, color );
		mix4( d - 1, len * 0.8, d1, a.x, a.y, a.z, ang - rang + rand, angy - rangy - rand, rang, rangy, random, m, color );
		mix4( d - 1, len * 0.8, d1, a.x, a.y, a.z, ang - rang - rand, angy + 2 * rangy + rand, rang, rangy, random, m, color );
		mix4( d - 1, len * 0.8, d1, a.x, a.y, a.z, ang + rang + rand, angy - 2 * rangy + rand, rang, rangy, random, m, color );
			
	}
	else if( d > d1 - 2 ){
	
		mix4( d - 1, len * 0.8, d1, a.x, a.y, a.z, ang + rang, angy + rand, rang, rangy, random, m, color );
		mix4( d - 1, len * 0.8, d1, a.x, a.y, a.z, ang - rang + rand, angy - rangy + rand, rang, rangy, random, m, color );
		mix4( d - 1, len * 0.8, d1, a.x, a.y, a.z, ang - rang - rand, angy + rangy + rand, rang, rangy, random, m, color );
		
	}
		
	else if( d > d1 - 3 ){
	
		mix4( d - 1, len * 0.8, d1, a.x, a.y, a.z, ang + rang + rand, angy + rand, rang, rangy, random, m, color );
		mix4( d - 1, len * 0.8, d1, a.x, a.y, a.z, ang - rang + rand, angy + rangy + rand, rang, rangy, random, m, color );
		
	}
		
	else{
	
		mix4( d - 1, len * 0.8, d1, a.x, a.y, a.z, ang + rang + rand, angy + rangy + rand, rang, rangy, random, m, color );	
		
	}
	}
	if( d == 0 ){
		Leave( a.x, a.y, a.z );
		Dec( a.x, a.y - 3, a.z );
	}
}
		
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
		