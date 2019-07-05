function readData() {
	
			var d = parseInt(document.getElementById("d").value);
			var len = parseInt(document.getElementById("len").value);
    		var n = document.getElementById("n").value;
    		var x = parseInt(document.getElementById("x").value);
    		var y = parseInt(document.getElementById("y").value);
    		var z = parseInt(document.getElementById("z").value);
    		var rv = parseInt(document.getElementById("rv").value);
    		var rh = parseInt(document.getElementById("rh").value);
    		var random = parseInt(document.getElementById("random").value);
    		var m = document.getElementById("m").value;
    		var bp = document.getElementById("bp").value;
    		var color = document.getElementById("color").value;
    		var leave = document.getElementById("leave").value;
    		var lcolor = document.getElementById("lcolor").value;
    		var dec = document.getElementById("dec").value;
    		var dcolor = document.getElementById("dcolor").value;
    		Leavelist( leave, lcolor );
    		Declist( dec, dcolor );

    		//alert( rv );
    		if( bp == "Pine Tree" ){ PineTree( d, len, x, y, z, 10, 0, m, color ); }
    		else if( bp == "Willow Tree" ){ Willow2( d, d, len, x, y, z, y, 90, 0, m, color ); }
    		else if( bp == "Maple Tree" ){ MapleTree2( d, d, len, x, y, z, 90, 0, m, color ); }
    		else if( bp == "Oak Tree" ){ Oak( d, d, len, x, y, z, 90, 0, m, color ); }
    		else if( bp == "Gingko Tree" ){ Gingko2( d, d, len, x, y, z, 90, 0, m, color ); }
    		else if( bp == "Acacia Tree" ){ Acacia2( d, d, len, x, y, z, 90, 0, m, color ); }
    		else{ drawBranch( d, len, n, x, y, z, 90, 0, rv, rh, random, m, color ); }
    		
}
    	
    	
    	