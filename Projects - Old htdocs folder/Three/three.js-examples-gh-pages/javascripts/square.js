if (!Detector.webgl) {
  var domElement = document.createElement('p');
  domElement.innerHTML = 'えっ、まだWebGL未対応ブラウザ使ってるの? 信じられない...';
  document.body.appendChild(domElement);
} else {
  var SCREEN_WIDTH = window.innerWidth,
    SCREEN_HEIGHT = window.innerHeight,
    mouseX = 50,
    mouseY = 50,
    windowHalfX = window.innerWidth / 2,
    windowHalfY = window.innerHeight / 2,
    SEPARATION = 20,
    AMOUNTX = 50,
    AMOUNTY = 50,
    camera, scene, renderer;
  init();
  animate();
}

function init() {
  var container, separation = 20,
    amountX = 50,
    amountY = 50,
    particles, particle;
  container = document.createElement('div');
  document.body.appendChild(container);
  camera = new THREE.PerspectiveCamera(75, SCREEN_WIDTH / SCREEN_HEIGHT, 1, 1000);
  camera.position.z = 100;
  camera.position.x = 100;
  camera.position.y = 100;
  scene = new THREE.Scene();
  renderer = new THREE.CanvasRenderer();
  renderer.setSize(SCREEN_WIDTH, SCREEN_HEIGHT);
  renderer.setClearColor(0xffffff);
  container.appendChild(renderer.domElement);
  scene.fog = new THREE.FogExp2(0xffffff, 0.001);
  var ambientLight = new THREE.AmbientLight(0xffffff);
  scene.add(ambientLight);
  var directionalLight = new THREE.DirectionalLight(0xffffff);

  var max = 100;
  var scale = d3.scale.linear().domain([0, max]).range([0, 360]);

  // cube
  var cubeSize = 100;
  var cube = new THREE.Mesh(new THREE.CubeGeometry(cubeSize, cubeSize, cubeSize), new THREE.MeshBasicMaterial({
    wireframe: true,
    color: d3.hsl(scale(Math.floor(Math.random() * max)), 0.5, 0.5).toString()
  }));
  scene.add(cube);

  var program = function(context) {
    context.beginPath();
    context.arc(0, 0, 2, 0, PI2, true);
    context.fill();
  };

  // particles
  var PI2 = Math.PI * 2;
  for (var i = 0; i < 1000; i++) {
    var materialColor = d3.hsl(scale(Math.floor(Math.random() * max)), 0.8, 0.8).toString();
    var material = new THREE.SpriteCanvasMaterial({
      color: materialColor,
      program: program
    });
    particle = new THREE.Sprite(material);
    particle.position.x = Math.random() * 2 - 1;
    particle.position.y = Math.random() * 2 - 1;
    particle.position.z = Math.random() * 2 - 1;
    particle.position.multiplyScalar(cubeSize / 2 - 1);
    scene.add(particle);
  }
  document.addEventListener('mousemove', onDocumentMouseMove, false);
  document.addEventListener('touchstart', onDocumentTouchStart, false);
  document.addEventListener('touchmove', onDocumentTouchMove, false);
  //
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
  mouseX = event.clientX - windowHalfX;
  mouseY = event.clientY - windowHalfY;
}

function onDocumentTouchStart(event) {
  if (event.touches.length > 1) {
    event.preventDefault();
    mouseX = event.touches[0].pageX - windowHalfX;
    mouseY = event.touches[0].pageY - windowHalfY;
  }
}

function onDocumentTouchMove(event) {
  if (event.touches.length == 1) {
    event.preventDefault();
    mouseX = event.touches[0].pageX - windowHalfX;
    mouseY = event.touches[0].pageY - windowHalfY;
  }
}

function animate() {
  requestAnimationFrame(animate);
  render();
}

function render() {
  camera.position.x += (-mouseX - camera.position.x) * 0.05;
  camera.position.y += (-mouseY - camera.position.y) * 0.05;
  camera.lookAt(scene.position);
  renderer.render(scene, camera);
}
