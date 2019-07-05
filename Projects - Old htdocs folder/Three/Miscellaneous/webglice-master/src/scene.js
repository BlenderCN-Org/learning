(function(){
var scene = provides('scene'),
    glUtils = requires('glUtils'),
    uniform = requires('uniform');

scene.Node = function SceneNode(children){
    this.children = children || [];
}
scene.Node.prototype = {
    debug: false,
    children: [],
    visit: function(graph) {
        //if(this.debug) debugger;
        this.enter(graph);
        for(var i = 0; i < this.children.length; i++) {
            var child = this.children[i];
            child.visit(graph);
        }
        this.exit(graph);
    },
    append: function (child) {
        this.children.push(child);
    },
    enter: function(graph) {
    },
    exit: function(graph) {
    }
};

scene.Uniforms = function UniformsNode(uniforms, children) {
    this.uniforms = uniforms;
    this.children = children;
}
scene.Uniforms.prototype = extend({}, scene.Node.prototype, {
    enter: function(graph) {
        for(var uniform in this.uniforms){
            var value = this.uniforms[uniform];
            if(value.bindTexture){
                value.bindTexture(graph.pushTexture());
            }
        }
        graph.pushUniforms();
        extend(graph.uniforms, this.uniforms);
    },
    exit: function(graph) {
        for(var uniform in this.uniforms){
            var value = this.uniforms[uniform];
            if(value.bindTexture){
                value.unbindTexture();
                graph.popTexture();
            }
        }
        graph.popUniforms();
    }
});

scene.Graph = function SceneGraph(gl){
    this.root = new scene.Node();
    this.uniforms = {};
    this.shaders = [];
    this.viewportWidth = 640;
    this.viewportHeight = 480;
    this.textureUnit = 0;
}
scene.Graph.prototype = {
    draw: function() {
        gl.viewport(0, 0, this.viewportWidth, this.viewportHeight);
        gl.clear(gl.COLOR_BUFFER_BIT | gl.DEPTH_BUFFER_BIT);
        //gl.clear(gl.DEPTH_BUFFER_BIT);
        //gl.enable(gl.DEPTH_TEST);
        this.root.visit(this);
    },
    pushUniforms: function() {
        this.uniforms = Object.create(this.uniforms);
    },
    popUniforms: function() {
        this.uniforms = Object.getPrototypeOf(this.uniforms);
    },
    pushTexture: function () {
        return this.textureUnit++;
    },
    popTexture: function() {
        this.textureUnit--;
    },
    pushShader: function (shader) {
        this.shaders.push(shader);
    },
    popShader: function() {
        this.shaders.pop();
    },
    getShader: function () {
        return this.shaders[this.shaders.length-1];
    }
}

scene.Material = function Material(shader, uniforms, children) {
    this.shader = shader;
    this.uniforms = uniforms;
    this.children = children;
}
scene.Material.prototype = extend({}, scene.Node.prototype, {
    enter: function(graph){
        graph.pushShader(this.shader);
        this.shader.use();
        scene.Uniforms.prototype.enter.call(this, graph);
    },
    exit: function(graph) {
        scene.Uniforms.prototype.exit.call(this, graph);
        graph.popShader();
    }
});

scene.RenderTarget = function RenderTarget(fbo, children){
    this.fbo = fbo;
    this.children = children;
}
scene.RenderTarget.prototype = extend({}, scene.Node.prototype, {
    enter: function(graph) {
        this.fbo.bind();
        gl.viewport(0, 0, this.fbo.width, this.fbo.height);
        gl.clear(gl.COLOR_BUFFER_BIT | gl.DEPTH_BUFFER_BIT);
    },
    exit: function(graph) {
        // needed?
        this.fbo.unbind();
        gl.viewport(0, 0, graph.viewportWidth, graph.viewportHeight);
    }
});

scene.Camera = function Camera(children){
    this.position = vec3.create([0, 0, 10]);
    this.pitch = 0.0;
    this.yaw = 0.0;
    this.near = 0.1;
    this.far = 5000;
    this.fov = 50;

    this.children = children;
}
scene.Camera.prototype = extend({}, scene.Node.prototype, {
    enter: function (graph) {
        var projection = this.getProjection(graph),
            worldView = this.getWorldView(),
            wvp = mat4.create();

        graph.pushUniforms();
        mat4.multiply(projection, worldView, wvp);
        graph.uniforms.worldViewProjection = new uniform.Mat4(wvp);
        graph.uniforms.worldView = new uniform.Mat4(worldView);
        graph.uniforms.projection = new uniform.Mat4(projection);
        graph.uniforms.eye = new uniform.Vec3(this.position);
        //this.project([0, 0, 0, 1], scene);
    },
    project: function(point, graph) {
        var mvp = mat4.create();
        mat4.multiply(this.getProjection(graph), this.getWorldView(), mvp);
        var projected = mat4.multiplyVec4(mvp, point, vec4.create());
        vec4.scale(projected, 1/projected[3]);
        return projected;
    },
    exit: function(graph) {
        graph.popUniforms();
    },
    getInverseRotation: function () {
        return mat3.toMat4(mat4.toInverseMat3(this.getWorldView()));
    },
    getRotationOnly: function () {
        return mat3.toMat4(mat4.toInverseMat3(this.getWorldView()));
    },
    getProjection: function (graph) {
        return mat4.perspective(this.fov, graph.viewportWidth/graph.viewportHeight, this.near, this.far);
    },
    getWorldView: function(){
        var matrix = mat4.identity(mat4.create());
        mat4.rotateX(matrix, this.pitch);
        mat4.rotateY(matrix, this.yaw);
        mat4.translate(matrix, vec3.negate(this.position, vec3.create()));
        return matrix;
    }
});



scene.Skybox = function SkyboxNode(shader, uniforms) {
    var mesh = new scene.SimpleMesh(new glUtils.VBO(new Float32Array([
            // back
            1, 1, 1,
            1, -1, 1,
            -1, -1, 1,
            
            1, 1, 1,
            -1, -1, 1,
            -1, 1, 1,

            // front
            -1, 1, -1,
            -1, -1, -1,
            1, 1, -1,
            
            1, 1, -1,
            -1, -1, -1,
            1, -1, -1,
            // left
            -1, 1, 1,
            -1, -1, -1,
            -1, 1, -1,
            
            -1, 1, 1,
            -1, -1, 1,
            -1, -1, -1,

            // right

            1, 1, 1,
            1, 1, -1,
            1, -1, -1,
            
            1, 1, 1,
            1, -1, -1,
            1, -1, 1,

            // top
            1, 1, 1,
            -1, 1, 1,
            -1, 1, -1,

            1, 1, -1,
            1, 1, 1,
            -1, 1, -1,

            // bottom
            -1, -1, -1,
            -1, -1, 1,
            1, -1, 1,

            -1, -1, -1,
            1, -1, 1,
            1, -1, -1


        ]))),
        material = new scene.Material(shader, uniforms, [mesh]);
    this.children = [material];
}
scene.Skybox.prototype = extend({}, scene.Node.prototype, {
    enter: function(graph){
        graph.pushUniforms();
        var worldViewProjection = mat4.create(),
            worldView = mat3.toMat4(mat4.toMat3(graph.uniforms.worldView.value));
        //mat4.identity(worldView);
        mat4.multiply(graph.uniforms.projection.value, worldView, worldViewProjection);
        graph.uniforms.worldViewProjection = new uniform.Mat4(worldViewProjection);
    },
    exit: function(graph){
        graph.popUniforms();
    }
});

scene.Postprocess = function PostprocessNode(shader, uniforms) {
    var mesh = new scene.SimpleMesh(new glUtils.VBO(new Float32Array([
            -1, 1, 0,
            -1, -1, 0,
            1, -1, 0,
            
            -1, 1, 0,
            1, -1, 0,
            1, 1, 0
        ]))),
        material = new scene.Material(shader, uniforms, [mesh]);
    this.children = [material];
}
scene.Postprocess.prototype = scene.Node.prototype;

scene.Transform = function Transform(children){
    this.children = children || [];
    this.matrix = mat4.create();
    mat4.identity(this.matrix);
    this.aux = mat4.create();
}
scene.Transform.prototype = extend({}, scene.Node, {
    enter: function(graph) {
        graph.pushUniforms();
        if(graph.uniforms.modelTransform){
            mat4.multiply(graph.uniforms.modelTransform.value, this.matrix, this.aux);
            graph.uniforms.modelTransform = new uniform.Mat4(this.aux);
        }
        else{
            graph.uniforms.modelTransform = new uniform.Mat4(this.matrix);
        }
    },
    exit: function(graph) {
        graph.popUniforms();
    }
});

scene.Mirror = function MirrorNode(children){
    scene.Transform.call(this, children);
}
scene.Mirror.prototype = extend({}, scene.Transform.prototype, {
    enter: function (graph) {
        gl.cullFace(gl.FRONT);
        scene.Transform.prototype.enter.call(this, graph);
    },
    exit: function (graph) {
        gl.cullFace(gl.BACK);
        scene.Transform.prototype.exit.call(this, graph);
    }
});


scene.SimpleMesh = function SimpleMesh(vbo){
    this.vbo = vbo;
}
scene.SimpleMesh.prototype = {
    visit: function (graph) {
        var shader = graph.getShader(),
            location = shader.getAttribLocation('position'),
            stride = 0,
            offset = 0,
            normalized = false;

        this.vbo.bind();

        gl.enableVertexAttribArray(location);
        gl.vertexAttribPointer(location, 3, gl.FLOAT, normalized, stride, offset);

        shader.uniforms(graph.uniforms);

        this.vbo.drawTriangles();

        this.vbo.unbind();
    }
};

})();
