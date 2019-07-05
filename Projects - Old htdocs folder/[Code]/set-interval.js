var int = setInterval("doSomething()", 5000 ); /* 5 seconds */
var int = setInterval(doSomething, 5000 ); /* same thing, no quotes, no parens */


(function(){

   doSomething();

   setTimeout(arguments.callee, 5000);

})()