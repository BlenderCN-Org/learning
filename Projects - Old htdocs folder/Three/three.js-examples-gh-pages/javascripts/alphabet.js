if (!Detector.webgl) {

  var domElement = document.createElement('p');
  domElement.innerHTML = 'えっ、まだWebGL未対応ブラウザ使ってるの? 信じられない...';
  document.body.appendChild(domElement);

} else {

  var container, camera, scene, renderer, geometry, group;
  var mouseX = 0,
      mouseY = 0;
  var windowHalfX = window.innerWidth / 2;
  var windowHalfY = window.innerHeight / 2;

	var mouseDown = false;

	document.body.addEventListener("mousedown", function(event) {
	    mouseDown = true
	}, false);
	document.body.addEventListener("mouseup", function(event) {
	    mouseDown = false
	}, false);



  function init() {
    container = document.createElement('div');
    document.body.appendChild(container);

    camera = new THREE.PerspectiveCamera(20, window.innerWidth / window.innerHeight, 1, 10000);
    camera.position.z = 3000;

    scene = new THREE.Scene();

    scene.fog = new THREE.FogExp2(0xffffff, 0.00015);

    var ambientLight = new THREE.AmbientLight(0xffffff);
    scene.add(ambientLight);
    var directionalLight = new THREE.DirectionalLight(0xffffff);
    directionalLight.position.set(8000, 8000, 8000).normalize();
    scene.add(directionalLight);

    group = new THREE.Object3D();

    var size = 6000;

    var a = 'abcdefghijklmnopqrstuvwxyz';
    a = a.split('');

    var max = 100;
    var scale = d3.scale.linear().domain([0, max]).range([0, 360]);

    for (var i = 500; i--;) {
      var materialColor = scale(Math.floor(Math.random() * max));
      var material = new THREE.MeshPhongMaterial({
        ambient: d3.hsl(materialColor, 0.2, 0.2).toString(),
        color: d3.hsl(materialColor, 0.7, 0.7).toString(),
        specular: d3.hsl(materialColor, 1, 0.5).toString(),
        shininess: 20,
        shading: THREE.FlatShading
      });

      var textSize = Math.random() * 100 + 50,
          textHeight = textSize * .2;
      var text3d = new THREE.TextGeometry(a[Math.floor(Math.random() * a.length)], {
        size: textSize,
        height: textHeight,
        curveSegments: 3,
        font: "helvetiker"
      });

      var mesh = new THREE.Mesh(text3d, material);

      mesh.position.x = (Math.random() - 0.5) * size;
      mesh.position.y = (Math.random() - 0.5) * size;
      mesh.position.z = (Math.random() - 0.5) * size;
      mesh.rotation.x = Math.random() * 2 * Math.PI;
      mesh.rotation.y = Math.random() * 2 * Math.PI;

      mesh.matrixAutoUpdate = false;
      mesh.updateMatrix();
      group.add(mesh);
    }

    scene.add(group);

    renderer = new THREE.WebGLRenderer();
    renderer.setClearColor(0xffffff);
    renderer.setSize(window.innerWidth, window.innerHeight);
    renderer.sortObjects = false;

    container.appendChild(renderer.domElement);
    window.addEventListener('resize', onWindowResize, false);
  }

  function onWindowResize() {
    windowHalfX = window.innerWidth / 2;
    windowHalfY = window.innerHeight / 2;
    camera.aspect = window.innerWidth / window.innerHeight;
    camera.updateProjectionMatrix();
    renderer.setSize(window.innerWidth, window.innerHeight);
  }

  function onDocumentMouseMove(event) {
		if (mouseDown) {
			mouseX = (event.clientX - windowHalfX) * 10;
			mouseY = (event.clientY - windowHalfY) * 10;
		}
  }

  document.addEventListener('mousemove', onDocumentMouseMove, false);

  function animate() {
    requestAnimationFrame(animate);
    render();
  }

  function render() {
    camera.position.x += (mouseX - camera.position.x) * .03;
    camera.position.y += (-mouseY - camera.position.y) * .03;
    camera.lookAt(scene.position);
    renderer.render(scene, camera);
  }

	init();
	animate();
}
