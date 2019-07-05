function Person(name,age) {
  this.name = name;
  this.age = age;
}

// Let's make bob and susan again, using our constructor
var bob = new Person("Bob Smith", 30);
var susan = new Person("Susan Jordan", 25);
// help us make george, whose name is "George Washington" and age is 275
var george = new Person("George Washington", 275);



function Cat(age, color) { // This is a constructor
  this.age = age;
  this.color = color;
}

// make a Dog constructor here
function Dog(size, hairType){
    this.hair = hairType;
    this.size = size;
}