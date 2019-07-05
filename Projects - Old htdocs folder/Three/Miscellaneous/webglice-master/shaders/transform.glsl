uniform mat4 modelTransform;
uniform mat4 worldViewProjection;
uniform vec3 eye;
varying vec3 worldPosition;
varying float depth;

void transform(const vec3 position){
  vec4 worldPosition4 = modelTransform*vec4(position, 1.0);
  worldPosition = vec3(worldPosition4);
  gl_Position = worldViewProjection*worldPosition4;
}
