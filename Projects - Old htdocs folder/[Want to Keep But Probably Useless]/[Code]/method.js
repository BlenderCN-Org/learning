var bob = new Object();
bob.name = "Bob Smith";
bob.age = 30;
bob.setAge = function (newAge){  // This is the method!
  bob.age = newAge;
};
// here we set bob's age to 40
bob.setAge(40);
// bob's feeling old.  Use our method to set bob's age to 20
bob.setAge(20);





var bob = new Object();
bob.age = 17;
bob.setAge = function (newAge){
  bob.age = newAge;
};

bob.getYearOfBirth = function () {   // Method to find out year of birth
  return 2014 - bob.age;
};
console.log(bob.getYearOfBirth());





// here we define our method using "this", before we even introduce bob
var setAge = function (newAge) {
  this.age = newAge;
};
// now we make bob
var bob = new Object();
bob.age = 30;
// and down here we just use the method we already made
bob.setAge = setAge;
  
// change bob's age to 50 here
bob.setAge(50);

//Syntax: Object.function(paremeter)




// here we define our method using "this", before we even introduce bob
var setAge = function (newAge) {
  this.age = newAge;  // This refers to Bob or Susan, depending on which one is using it.
};
// now we make bob
var bob = new Object();
bob.age = 30;
bob.setAge = setAge;
  
// make susan here, and first give her an age of 25
var susan = new Object();
susan.age = 25;
susan.setAge = setAge;
// here, update Susan's age to 35 using the method
susan.setAge(35);



var rectangle = new Object();
rectangle.height = 3;
rectangle.width = 4;
rectangle.setHeight = function (newHeight) {
  this.height = newHeight;
};
rectangle.setWidth = function(newWidth){
    this.width = newWidth;
}
rectangle.setWidth(8);
rectangle.setHeight(6);




var square = new Object();
square.sideLength = 6;
square.calcPerimeter = function() {
  return this.sideLength * 4;
};
// help us define an area method here

square.calcArea = function(){
    return this.sideLength * this.sideLength;
}

var p = square.calcPerimeter();
var a = square.calcArea();