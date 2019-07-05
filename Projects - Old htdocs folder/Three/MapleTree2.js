var deg = Math.PI / 180;

function Twig2( d, x1, y1, z1, ang, angy, color ) {

	var lt = Math.random() * 10 + 3 * d; //length of twig
	var b = Rot( len, x, y, z, ang, angy );
	if ( d != 0 ) {
	
		Draw2( d, x, y, z, b.x, b.y, b.z, color );
 		Twig2( d - 1, b.x, b.y, b.z, ang + 20, angy, color );
  		Twig2( d - 1, b.x, b.y, b.z, ang - 20, angy, color );  
  		  		
  	}
		    	
	if ( d == 0 ) {
	
		Leave( x, y, z );
		Dec( x, y - 5, z ); //at the end of a twig, draw leave
		
	}
	
}

function MapleTree2( d, d1, len, x, y, z, ang, angy, m, color ) {

    var a = Rot( len, x, y, z, ang, angy );
    	    	
	if ( d != 0 ) {
		if( m == "2D Line" ){
			Draw2( d, x, y, z, a.x, a.y, a.z, color );
		}
		if( m == "3D Tube" ){
			Draw( d, x, y, z, a.x, a.y, a.z, color );
		}
		if ( d > d1 - 1 ) {  //first nodes may have more branches
		    		
    		var rand = Math.random() * 3 + 3; //( 3 - 6 branches )
    		for ( var i = 0; i < rand; i++ ) {
    					
    			MapleTree2( d - 1, d1, len, a.x, a.y, a.z, ang + 30 + Math.random() * 10, Math.random() * 180, m, color ); 
    			MapleTree2( d - 1, d1, len, a.x, a.y, a.z, ang - 30 - Math.random() * 10, Math.random() * 180, m, color ); 
    						
    		}

    	}
    				
    	else {
    	
    		MapleTree2( d - 1, d1, len, a.x, a.y, a.z, ang + 20 + Math.random() * 10, Math.random() * 180, m, color );
    		MapleTree2( d - 1, d1, len, a.x, a.y, a.z, ang - 20 - Math.random() * 10, Math.random() * 180, m, color );
			if ( d > 3 ) { //to make the tree more vigorous, add some twigs
						
				Twig2( d - 3, a.x, a.y, a.z, ang + 40, angy, color );
				Twig2( d - 3, a.x, a.y, a.z, ang - 40, angy, color );
							
 			}
 			
							
    	}
    				
    				
    }
    
    if ( d == 0 ) {
     
		Leave( x, y, z );
		Dec( x, y - 5, z );
	
	}
    			    			
}
    		

    		 
    		
				