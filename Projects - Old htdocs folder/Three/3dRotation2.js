var deg = Math.PI / 180;

function Rot( len, x, y, z, ang, angy ){

	var b = new THREE.Vector3();
	b.x = x + len * Math.cos( ang * deg ) * Math.cos( angy * deg );
	b.y = y + len * Math.sin( ang * deg );
	b.z = z + len * Math.cos( ang * deg ) * Math.sin( angy * deg );
	
	return b;
	
} 