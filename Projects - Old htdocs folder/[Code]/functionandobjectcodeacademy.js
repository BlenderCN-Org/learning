var friends = new Object();
friends.bill = {
    firstName: "Bill",
    lastName: "Gates",
    number: "(206) 555-5555",
    address: ['One Microsoft Way','Redmond','WA','98052'],
};
friends.steve = {
    address: []
};

var list = function(friends){  // Why did new function also work? (Without var)
    for(var key in friends){
    console.log(key);
    
    }    
}
list();




var friends = new Object();
friends.bill = {
    firstName: "Bill",
    lastName: "Gates",
    number: "(206) 555-5555",
    address: ['One Microsoft Way','Redmond','WA','98052'],
};
friends.steve = {
    firstName: "Steve",
    address: ['Apple Computer', 'Silicon Valley', 'CA', '90210']
};

var list = function(friends){  // Why did new function also work? (Without var)
    for(var key in friends){
    console.log(key);
    
    }    
};
// list();

var search = function(name){
    
    for(var key in friends){
        
    if(friends[key].firstName === name){
        console.log(friends[key].firstName);
        return friends[key];
    }
    }
}
search(friends.steve);

// WHy did this return
// Steve, Steve, Bill??



-----------------------



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


// Why do you need to do susan.setAge = SetAge; ?????

// AND why didn't I need to in the one below????

var rectangle = new Object();
rectangle.height = 3;
rectangle.width = 4;
// here is our method to set the height
rectangle.setHeight = function (newHeight) {
  this.height = newHeight;
};
// help by finishing this method
rectangle.setWidth = function(newWidth){
    this.width = newWidth;
}
rectangle.setWidth(8);
rectangle.setHeight(6);