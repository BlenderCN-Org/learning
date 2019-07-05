

function addGeometry( geometry, points, spacedPoints, color, x, y, z, rx, ry, rz, s ) {
parent = new THREE.Object3D();			
parent.position.y = 0;
scene.add( parent );
		var mesh = THREE.SceneUtils.createMultiMaterialObject( geometry, 
			[ new THREE.MeshLambertMaterial( { color: color } ), 
			  new THREE.MeshBasicMaterial( { color: color, opacity: 0.5 } ) ] );
		mesh.position.set( x, y, z );
		
		mesh.rotation.set( rx, ry, rz );
		mesh.scale.set( s, s, s );
		parent.add( mesh );
					
}