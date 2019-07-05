var Spencer = {
  age: 22,
  country: "United States"
};

// Dotted Notation (AKA - Literal Notation)

var bob = {
  name: "Bob Smith",
  age: 30
};
var susan = {
  name: "Susan Jordan",
  age: 25
};
var name1 = bob.name;
var age1 = bob.age;
var name2 = susan.name;
var age2 = susan.age;

// Bracket Notation (AKA - Literal Notation)

var dog = {
  species: "greyhound",
  weight: 60,
  age: 4
};

var species = dog["species"];
var weight = dog["weight"];
var age = dog["age"];


// Using a Constructor
var bob = new Object();
bob.name = "Bob Smith";
bob.age = 30;
var susan1 = {
  name: "Susan Jordan",
  age: 24
};
var susan2 = new Object();
susan2.name = "Susan Jordan";
susan2.age = 24;



//Final Exercise  

// help us make snoopy using literal notation
// Remember snoopy is a "beagle" and is 10 years old.
var snoopy = {
    species: "beagle",
    age: 10
};

// help make buddy using constructor notation
// buddy is a "golden retriever" and is 5 years old
var buddy = new Object(); // No Brackets! Only Semicolon
    buddy.species = "golden retriever";
    buddy.age = 5;