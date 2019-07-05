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

  document.addEventListener('mousemove', onDocumentMouseMove, false);

  init();
  animate();

  function init() {
    container = document.createElement('div');
    document.body.appendChild(container);

    camera = new THREE.PerspectiveCamera(20, window.innerWidth / window.innerHeight, 1, 10000);
    camera.position.z = 3500;

    scene = new THREE.Scene();

    scene.fog = new THREE.Fog(0x000000, 3000, 4500);

    var ambientLight = new THREE.AmbientLight(0xffffff);
    scene.add(ambientLight);
    var directionalLight = new THREE.DirectionalLight(0xffffff);
    directionalLight.position.set(8000, 8000, 8000).normalize();
    scene.add(directionalLight);

    group = new THREE.Object3D();

    var max = 100;
    var scale = d3.scale.linear().domain([0, max]).range([0, 360]);
    var radius = 500;

    for (var i = 300; i--;) {
      var materialColor = scale(Math.floor(Math.random() * max));
      var material = new THREE.MeshPhongMaterial({
        ambient: d3.hsl(materialColor, 0.2, 0.2).toString(),
        color: d3.hsl(materialColor, 0.4, 0.4).toString(),
        specular: d3.hsl(materialColor, 0.6, 0.5).toString(),
        shininess: 20,
        shading: THREE.FlatShading
      });
      var geo = new THREE.OctahedronGeometry(10);
      var mesh = new THREE.Mesh(geo, material);

      var r = radius * Math.pow(Math.random(), 1 / 3);
      var cosTheta = Math.random() * 2 - 1;
      var sinTheta = Math.sqrt(1 - cosTheta * cosTheta);
      var phi = Math.random() * 2 * Math.PI;
      mesh.position.x = r * sinTheta * Math.cos(phi);
      mesh.position.y = r * sinTheta * Math.sin(phi);
      mesh.position.z = r * cosTheta;
      mesh.rotation.x = Math.random() * 2 * Math.PI;
      mesh.rotation.y = Math.random() * 2 * Math.PI;

      mesh.matrixAutoUpdate = false;
      mesh.updateMatrix();
      group.add(mesh);
    }

    scene.add(group);

    renderer = new THREE.WebGLRenderer();
    renderer.setClearColor(0x000000);
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
    mouseX = (event.clientX - windowHalfX) * 10;
    mouseY = (event.clientY - windowHalfY) * 10;
  }

  function animate() {
    requestAnimationFrame(animate);
    render();
  }

  function render() {
    var rx = Math.sin(new Date().getTime() * 0.0007) * 2,
        ry = Math.sin(new Date().getTime() * 0.0003) * 2,
        rz = Math.sin(new Date().getTime() * 0.0002) * 2;
    group.rotation.x = rx;
    group.rotation.y = ry;
    group.rotation.z = rz;
    camera.lookAt(scene.position);
    renderer.render(scene, camera);
  }
}