function wBranch( x1, y1, z1, y0, ang, angy, m, color ) {
		
		    	
	var len =  10;
	var deg = Math.PI/180;
	var x2 = x1 + len * Math.cos( ang * deg ) * Math.cos( angy * deg );
	var y2 = y1 - Math.abs(len * Math.sin( ang * deg ));
	var z2 = z1 - len * Math.cos( ang * deg ) * Math.sin( angy * deg );
		    	
	if ( y2 > y0 ) {
		

		Draw2( 1, x1, y1, z1, x2, y2, z2, 0xCCFF33 );

		wBranch( x2, y2, z2, y0, Math.min(270, ang+30)-Math.random()*5, angy, m, color );
		Leave( x2, y2, z2 );
		Dec( x2, y2 - 3, z2 );
	
	}
		    	
}
	
function Willow2( d, d1, len, x, y, z, y0, ang, angy, m, color ) {

		    	
	var a = Rot( len, x, y, z, ang, angy );
		    	
	
	
	if ( d != 0 ) {
	
		if( m == "2D Line" ){ Draw2( d, x, y, z, a.x, a.y, a.z, color ); }
		if( m == "3D Tube" ){ Draw( d, x, y, z, a.x, a.y, a.z, color ); }  		
		if( d > d1 - 1 ){
		    		
    		Willow2( d - 1, d1, len * 0.8, a.x, a.y, a.z, y0, ang + 20 + Math.random() * 10, angy + 45, m, color );
    		Willow2( d - 1, d1, len * 0.8, a.x, a.y, a.z, y0, ang + 20 + Math.random() * 10, angy + 180 + 30, m, color );
    		Willow2( d - 1, d1, len * 0.8, a.x, a.y, a.z, y0, ang + 30 + Math.random() * 5, Math.random() * 60 + 240, m, color );

    	}
    	
   		else {
    					
    		Willow2( d - 1, d1, len * 0.8, a.x, a.y, a.z, y0, ang + 20 + Math.random() * 10, Math.random() * 180, m, color );
    		Willow2( d - 1, d1, len * 0.8, a.x, a.y, a.z, y0, ang + 20 - Math.random() * 10, Math.random() * 180 + 180, m, color );
			wBranch( a.x, a.y, a.z, y0, ang, Math.random() * 360, m, color );
	    				
    	}
   			
    }
  			
    			
}
    		