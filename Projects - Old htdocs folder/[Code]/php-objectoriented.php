<?php
// On it's owm = function
// Inside a class = method
echo '<h3>INTRO TO OBJECT ORIENTED PROGRAMMING</h3>';
class Person
{
	var $first_name; // This is a variable
	var $arm_count = 2;
	function say_hello()
	{
		echo 'Hello: ' . get_class($this);
	}
	function full_name(){
	return $this->first_name . $this->arm_count;
	}
}	

echo '<br/>';
class_exists("Person");
echo '<br/>';
echo property_exists('Person', 'first_name');
echo '<br/>';
$vars = get_class_vars('Person'); 
foreach($vars as $var =>$value){
echo $var . ' - ' . $value;
} 


$person = new Person();
echo '<br/>';
$person->say_hello();
echo '<br/>';
$person->first_name = 'Lucy';
echo '<br/>';
echo $person->arm_count;
echo '<br/>';
echo $person->full_name();
echo '<br/>';
echo property_exists('Person', 'first_name') ? 'true' : 'false';

//BEGIN UNDERSTANDING CLASS INHERITANCE
echo '<h3>UNDERSTANDING CLASS INHERITANCE</h3>';
class Car{
	var $wheels = 4;
	var $doors = 4;
	
	
	function wheelsdoors(){
	return $this->wheels + $this->doors;
	}

}

class CompactCar extends Car{
	// var $doors = 2;   unComment to See.
}
echo '<br/>';
$car1 = new Car();
$car2 = new CompactCar();

echo $car1->wheels . '<br/>';
echo $car1->doors . '<br/>';
echo $car1->wheelsdoors() . '<br/>';
echo '<br/>';

echo $car2->wheels . '<br/>';
echo $car2->doors . '<br/>';
echo $car2->wheelsdoors() . '<br/>';
echo '<br/>';



echo get_parent_class('Compactcar');
echo is_subclass_of('Car', 'CompactCar') ? 'true' : 'false';


/* var Example {
public $a = 1;
protected $b = 2;
private $c=3;
} */

// $example = new Example();

// functions are public by default

//END UNDERSTANDING CLASS INHERITANCE



//BEGIN WORKING SETTERS/GETTERS
echo '<h3>WORKING WITH SETTERS/GETTERS</h3>';
// echo $exaple->set_a(15);

// echo $exaple->get_a(15);
//END WORKING SETTERS/GETTERS

//BEGIN WORKING WITH THE STATIC MODIFIER
echo '<h3>WORKING WITH THE STATIC MODIFIER</h3>';
// static makes it so you dont need to instantiate/call it
class Student{
	static $total_students=0;
	
	static function welcome_students($var="Hello"){
		echo "{$var} students.";
	}
}
// CANNOT USE THIS TO REFER TO STATIC METHODS. 
// Use Student::$total_students++;
//$student = new Student();
// echo $student->total_students;

echo Student::$total_students; // Note the dollar sign.
$classes = get_declared_classes();
//END WORKING WITH THE STATIC MODIFIER


// BEGIN "REFERENCING THE PARENT CLASS"

// user $this when talking about instances
// user double color when dealing with any static functions
//parent only works with parent methods, not attributes.
echo '<h3>REFERENCING THE PARENT CLASS</h3>';

class A {

	static $a=1;
	
		static function modified_a(){
		return self::$a + 10;
		}
		public function hello() 
		{
		echo '<br/>Hello!<br/>';
		}
}

class B extends A {
	static function attr_test() {
	echo parent::$a;
	}
	static function method_test() {
	echo parent::modified_a();
	}
	public function instance_test() 
	{
	echo $this->hello(); 
	echo parent::hello();
	}
	public function hello() {
	echo '<br/>Overridden hello<br/>';
	}
}

echo B::$a . '<br/>';
echo B::modified_a() . '<br/>';

echo B::attr_test() . '<br/>';
echo B::method_test() . '<br/>';

$object = new B();
$object->instance_test();
$object->hello(); //

// End of "Referencing the Parent Class


// BEGIN USING OBJECTS AND CONSTRUCTORS
echo '<h3>CONSTRUCTORS AND DESTRUCTORS</h3>';
class table {
	public $legs;
	static public $total_tables=0;

	function __construct($leg_count=4) 
	{
	$this->legs = 4;
	$this->legs = $leg_count;
	table::$total_tables++;
	}
	
	function _destruct() {
	table::$total_tables--;
	}

}

$table = new table();
echo 'Legs: ' . $table->legs . '<br/>';

echo 'Total Tables: ' . table::$total_tables . '<br/>';  // 1
$t1 = new table();
echo table::$total_tables . '<br/>';
$t2 = new table();
echo table::$total_tables . '<br/>';


/* in PHP 4
class table{
function_construct() {
}
} */
//END USING OBJECTS AND CONSTRUCTORS

//BEGIN CLONING OBJECTS
echo '<h3>CLONING OBJECTS</h3>';
class Beverage {
public $name;
	function __construct() {
	echo 'New Beverage Created<br/>';
	}
	function __clone() {
	echo 'Existing Beverage Cloned<br/>';
	}
}
$a = new Beverage();
$a->name = 'coffee';
$b = $a; // Always a reference with objects
$b->name = 'tea';
echo $a->name . '<br/>';
$c = clone $a;
$c->name = 'orange juice';
echo $a->name;
echo '<br/>';
echo $c->name;
// END CLONING OBJECTS



// BEGIN COMPARING OBJECTS
echo '<h3>COMPARING OBJECTS</h3>';

/* COMPARISON OPERATOR '=='  <-- Only checks to see if the attributes are the same. */

/*  IDENTITY OPERATOR '==='   <-- Must point to the same reference object. */

class Box {
public $name='box';
}

$box = new Box();
$box_reference = $box;
$box_clone = clone $box;

$box_changed = clone $box;
$box_changed->name = 'Changed Box';

$another_box = new Box();

echo $box == $box_reference ? 'true' : 'false';
echo '<br/>';
echo $box == $box_clone ? 'true' : 'false';
echo '<br/>';
echo $box == $box_changed ? 'true' : 'false';
echo '<br/>';
echo $box == $another_box ? 'true' : 'false';
echo '<br/><br/>';

echo $box === $box_reference ? 'true' : 'false';
echo '<br/>';
echo $box === $box_clone ? 'true' : 'false';
echo '<br/>';
echo $box === $box_changed ? 'true' : 'false';
echo '<br/>';
echo $box === $another_box ? 'true' : 'false';
echo '<br/><br/>';
// END COMPARING OBJECTS


echo '<pre>';
print_r($classes);
echo '</pre>';


foreach ($classes as $class){
	echo $class . '-<br/>';
}

// echo method_exists();

// echo get_class_methods('Person');

// echo get_class($person);

/* if is_a($person, "Person"){

} */

// $person->say_hello

// Reference assignment is automatic

//BEGIN PAGINATION

//OFFSET = Records to skip.
// COUNT = 'SELECT COUNT(*) FROM PHOTOGRAPHS';


//$page = !empty($_GET['page']) ? (int)($_GET['page'] : 1;

//END PAGINATION




?>