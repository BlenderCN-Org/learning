function main()
{
    var volumeSize = 64;
    var volume = new KVS.CreateTornadoData( volumeSize, volumeSize, volumeSize );

    var screen = new KVS.THREEScreen();
    screen.init( volume.objectCenter() );
    screen.camera.position.set( 0, 0, 180 );
    screen.camera.up.set( 0, 1, 0 );
    setup();
    screen.loop();

    function setup()
    {
        var color = new KVS.Vec3( 1, 1, 1 );
        var box = new KVS.BoundingBox();
        box.setColor( color );
        box.setWidth( 5 );

        var line1 = KVS.ToTHREELine( box.exec( volume ) );
        screen.scene.add( line1 );

        (function () {
            var cubeSize = 50;
            var geometry = new THREE.CubeGeometry( cubeSize, cubeSize, cubeSize );
            var wireframeMaterial = new THREE.MeshBasicMaterial( {
                color: 0x00ee00,
                wireframe: true
            } );
            cube = new THREE.Mesh( geometry, wireframeMaterial );
            cube.position.set( volumeSize / 2, volumeSize / 2, volumeSize / 2 );
            screen.scene.add( cube );


            var seed_point = volume.objectCenter();
            var streamline = new KVS.Streamline();
            streamline.setIntegrationStepLength( 0.5 );
            streamline.setIntegrationTime( 500 );
            streamline.setIntegrationMethod( KVS.RungeKutta4 );
            streamline.setLineWidth( 5 );
            streamline.setSeedPoint( seed_point );


            var projector = new THREE.Projector(),
                mouse_vector = new THREE.Vector3(),
                mouse = { x: 0, y: 0, z: 1 },
                ray = new THREE.Raycaster( new THREE.Vector3(0,0,0), new THREE.Vector3(0,0,0) ),
                intersects = [];


            document.addEventListener('mousedown', function(e) {
                e.preventDefault();

                mouse.x = ( e.clientX / window.innerWidth ) * 2 - 1;
                mouse.y = - ( e.clientY / window.innerHeight ) * 2 + 1;
                mouse_vector.set( mouse.x, mouse.y, mouse.z );

                projector.unprojectVector( mouse_vector, screen.camera );

                var direction = mouse_vector.sub( screen.camera.position ).normalize();

                ray.set( screen.camera.position, direction );

                intersects = ray.intersectObject( cube );
                if( intersects.length ) {
                    streamline.setSeedPoint( intersects[0].point );
                    screen.scene.add( KVS.ToTHREELine( streamline.exec( volume ) ) );
                }

            }, true);
        })();

        screen.draw();
    }
}
