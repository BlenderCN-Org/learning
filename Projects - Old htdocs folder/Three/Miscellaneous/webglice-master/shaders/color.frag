precision highp float;

varying float depth;
uniform vec3 color;

void main(){
  gl_FragColor = vec4(color, depth);
}
