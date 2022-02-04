<!-- enum.exit()-> Ye check krne ke liye use hota h ki agr koi enum create kiya h program me 
inside the function you can call your enums.

//declare object:
$object = new A();
print_r($object);

object variables do not make their location
non-object variables create their location

if you copy one object to another , the changes reflect onboth the objects -> it is referencing of object
all object of same class refer to same location.

product1 = 1
name    -> product1
value   -> 1
loaction-> L1

product2 = product1

name    -> product2
value   -> 1
loaction-> L1

product2 = 2

name    -> product2
value   -> 2
loaction-> L2

 -->

<?php
    //echo phpinfo();
echo "Server class<br>";

    echo "1) ".$_SERVER['PHP_SELF'];
    echo "<br>";
    echo "2) ".$_SERVER['GATEWAY_INTERFACE'];
    echo "<br>";
    echo "3) ".$_SERVER['SERVER_ADDR'];
    echo "<br>";
    echo "4) ".$_SERVER['SERVER_NAME'];
    echo "<br>";
    echo "5) ".$_SERVER['SERVER_SOFTWARE'];
    echo "<br>";
    echo "6) ".$_SERVER['SERVER_PROTOCOL'];
    echo "<br>";
    echo "7) ".$_SERVER['REQUEST_METHOD'];
    echo "<br>";
    echo "8) ".$_SERVER['REQUEST_TIME'];
    echo "<br>";
    echo "9) ".$_SERVER['REQUEST_TIME_FLOAT'];
    echo "<br>";
    echo "10) ".$_SERVER['QUERY_STRING'];
    echo "<br>";
    echo "11) ".$_SERVER['DOCUMENT_ROOT'];
    echo "<br>";
    echo "12) ".$_SERVER['HTTP_ACCEPT'];
    echo "<br>";
    //echo "13) ".$_SERVER['HTTP_ACCEPT_CHARSET'];
    //echo "<br>";
    echo "14) ".$_SERVER['HTTP_CONNECTION'];
    echo "<br>";
    echo "15) ".$_SERVER['HTTP_HOST'];
    echo "<br>";
    //echo "16) ".$_SERVER['HTTP_REFERER'];
    //echo "<br>";
    echo "17) ".$_SERVER['HTTP_USER_AGENT'];
    echo "<br>";
    //echo "18) ".$_SERVER['HTTPS'];
    //echo "<br>";
    echo "19) ".$_SERVER['REMOTE_ADDR'];
    echo "<br>";
    //echo "20) ".$_SERVER['REMOTE_HOST'];
    //echo "<br>";
    echo "21) ".$_SERVER['REMOTE_PORT'];
    echo "<br>";
    //echo "22) ".$_SERVER['REMOTE_USER'];
    //echo "<br>";
    //echo "23) ".$_SERVER['REDIRECT_REMOTE_USER'];
    //echo "<br>";
    echo "24) ".$_SERVER['SCRIPT_FILENAME'];
    echo "<br>";
    echo "25) ".$_SERVER['SERVER_ADMIN'];
    echo "<br>";
    echo "26) ".$_SERVER['SERVER_PORT'];
    echo "<br>";
    echo "27) ".$_SERVER['SERVER_SIGNATURE'];
    echo "<br>";
    //echo "28) ".$_SERVER['PATH_TRANSLATED'];
    //echo "<br>";
    echo "29) ".$_SERVER['SCRIPT_NAME'];
    echo "<br>";
    echo "30) ".$_SERVER['REQUEST_URI'];
    echo "<br>";
    //echo "31) ".$_SERVER['AUTH_TYPE'];
    //echo "<br>";


    echo "<br>___________________________________________________<br>";

    echo "CLASS";
    echo "<br>";
    echo"********************************************<br>";

    echo "1)class_alias — Creates an alias for a class<br>";
    class ex1 { }

    class_alias('ex1', 'bar1');

    $a = new ex1;
    $b = new bar1;

    // the objects are the same
    var_dump($a == $b, $a === $b);echo "<br>";
    var_dump($a instanceof $b);echo "<br>";

    // the classes are the same
    var_dump($a instanceof ex1);echo "<br>";
    var_dump($a instanceof bar1);echo "<br>";

    var_dump($b instanceof ex1);echo "<br>";
    var_dump($b instanceof bar1);
    echo "<br>___________________________________________________<br>";

    echo "2)class_exists — Checks if the class has been defined<br>";
    if (class_exists('Ex1')) {
        //$ex2 = new Ex1();
        echo "Yes , class exists!";
    }
    echo "<br>___________________________________________________<br>";

    echo "3)enum_exists — Checks if the enum has been defined<br>";
    enum checkUsers:string{
        case Admin = 'admin';
        case User = 'user';
    }
    class checkOthers{
        const Name = 'name';
        function showConstant(){
            echo self::Name;
        }
    }
    echo checkOthers::Name; 
    echo " -> It is a constant variable used outside the class<br>";
    if (enum_exists(checkOthers::class)) {
       echo "enum valid";
    }
    else{
        echo "enum not valid";
    }

    echo "<br>";

    if (enum_exists(checkUsers::class)) {
       echo "enum valid";
    }
    else{
        echo "enum not valid";
    }
    echo "<br>___________________________________________________<br>";

    echo "4)get_called_class — The Late Static Binding class name<br>";
    class ex4 
    {
        static public function test() {
            var_dump(get_called_class());
            echo "<br>";
        }
    }

    class bar extends ex4 {
    }

    ex4::test();
    bar::test();
    echo "___________________________________________________<br>";

    echo "5)get_class_methods — Gets the class methods' names<br>";
    class ex5 {
        // constructor
        function __construct()
        {
            return(true);
        }

        // method 1
        function myfunc1()
        {
            return(true);
        }

        // method 2
        function myfunc2()
        {
            return(true);
        }
    }

    $class_methods = get_class_methods('ex5');
    // or
    $class_methods = get_class_methods(new ex5());

    foreach ($class_methods as $method_name) {
        echo "$method_name\n";
        echo "<br>";
    }
    echo "___________________________________________________<br>";

    echo "6)get_class_vars — Get the default properties of the class<br>";
    class ex6 {
        var $var1; // this has no default value...
        var $var2 = "xyz";
        var $var3 = 100;
        private $var4;

        // constructor
        function __construct() {
            // change some properties
            $this->var1 = "foo";
            $this->var2 = "bar";
            return true;
        }
    }

    $ex6 = new ex6();
    $class_vars = get_class_vars(get_class($ex6));
    foreach ($class_vars as $name => $value) {
        echo "$name : $value\n";
        echo "<br>";
    }
    echo "___________________________________________________<br>";

    echo "7)get_class — Returns the name of the class of an object<br>";
    class ex7 {
        function name()
        {
            echo "My name is " , get_class($this) , "\n";
        }
    }

    // create an object
    $ex7 = new ex7();

    // external call
    echo "Its name is " , get_class($ex7) , "using external call<br>";

    // internal call
    $ex7->name();
    echo "using internal call";
    echo "<br>___________________________________________________<br>";

    
    echo "8)get_declared_classes — Returns an array with the name of the defined classes<br>";
    print_r(get_declared_classes());
    echo "<br>___________________________________________________<br>";

    echo "9)get_declared_interfaces — Returns an array of all declared interfaces<br>";
    print_r(get_declared_interfaces());
    echo "<br>___________________________________________________<br>";

    echo "10)get_declared_traits — Returns an array of all declared traits<br>";
    //namespace Example;

    // Declare Trait
    trait ex10Trait
    {
    }

    // Declare Abstract class
    abstract class ex10Abstract
    {
    }

    // Declare class
    class ex10 extends ex10Abstract
    {
        use ex10Trait;
    }

    // Get all traits declareds
    $array = get_declared_traits();

    var_dump($array);
    echo "<br>___________________________________________________<br>";

    echo "11)get_mangled_object_vars — Returns an array of mangled object properties<br>";
    //prints all the properties of a class either it's private or public
    class A
    {
        public $public = 1;
        protected $protected = 2;
        private $private = 3;
    }

    class B extends A
    {
        private $private = 4;
    }

    $object = new B;
    $object->dynamic = 5;
    $object->{'6'} = 6;

    var_dump(get_mangled_object_vars($object));

    class AO extends ArrayObject
    {
        private $private = 1;
    }

    $arrayObject = new AO(['x' => 'y']);
    $arrayObject->dynamic = 2;

    var_dump(get_mangled_object_vars($arrayObject));
    echo "<br>___________________________________________________<br>";

    echo "12)get_object_vars — Gets the properties of the given object<br>";
    class ex12 {
        private $a;
        public $b = 1;
        public $c;
        private $d;
        static $e;
       
        public function test() {
            var_dump(get_object_vars($this));
        }
    }

    $test = new ex12;
    var_dump(get_object_vars($test));

    $test->test();
    echo "<br>___________________________________________________<br>";

    echo "13)get_parent_class — Retrieves the parent class name for object or class<br>";
    class Dad {
        function __construct()
        {
        // implements some logic
        }
    }

    class Child extends Dad {
        function __construct()
        {
            echo "I'm " , get_parent_class($this) , "'s son\n";
        }
    }

    class Child2 extends Dad {
        function __construct()
        {
            echo "I'm " , get_parent_class('child2') , "'s son too\n";
        }
    }

    $foo = new child();
    echo "<br>";
    $bar = new child2();
    echo "<br>___________________________________________________<br>";

    echo "14)interface_exists — Checks if the interface has been defined<br>";
    interface MyInterface{
        public function someMethod1();
    }
    if (interface_exists('MyInterface')) {
        class MyClass implements MyInterface
        {
            public function someMethod1(){
                print_r("Inteface exists");
            }
        }
    }
    $myclass = new MyClass();
    print_r($myclass->someMethod1());
    echo "<br>___________________________________________________<br>";

    echo "15)is_a — Checks if the object is of this class or has this class as one of its parents<br>";
    class WidgetFactory
    {
      var $oink = 'moo';
    }

    // create a new object
    $WF = new WidgetFactory();

    if (is_a($WF, 'WidgetFactory')) {
      echo "yes, \$WF is still a WidgetFactory<br>";
    }
    if ($WF instanceof WidgetFactory) {
        echo 'Yes, $WF is a WidgetFactory';
    }
    echo "<br>___________________________________________________<br>";

    echo "16)is_subclass_of — Checks if the object has this class as one of its parents or implements it<br>";
    class ex16
    {
      var $oink = 'moo';
    }

    // define a child class
    class WidgetFactory_Child extends ex16
    {
      var $oink = 'oink';
    }

    // create a new object
    $WF = new ex16();
    $WFC = new WidgetFactory_Child();

    if (is_subclass_of($WFC, 'ex16')) {
      echo "yes, \$WFC is a subclass of ex17<br>";
    } else {
      echo "no, \$WFC is not a subclass of ex17<br>";
    }


    if (is_subclass_of($WF, 'ex16')) {
      echo "yes, \$WF is a subclass of ex17<br>";
    } else {
      echo "no, \$WF is not a subclass of ex17<br>";
    }


    if (is_subclass_of('WidgetFactory_Child', 'ex16')) {
      echo "yes, WidgetFactory_Child is a subclass of ex17<br>";
    } else {
      echo "no, WidgetFactory_Child is not a subclass of ex17";
    }
    echo "___________________________________________________<br>";

    echo "17)method_exists — Checks if the class method exists<br>";
    $directory = new Directory('.');
    var_dump(method_exists($directory,'read'));
    echo "<br>___________________________________________________<br>";

    echo "18)property_exists — Checks if the object or class has a property<br>";
    class ex18 {
        public $mine;
        private $xpto;
        static protected $test;

        static function test() {
            var_dump(property_exists('ex18', 'xpto')); //true
        }
    }

    var_dump(property_exists('ex18', 'mine')."<br>");   //true
    var_dump(property_exists(new myClass, 'mine')."<br>"); //true
    var_dump(property_exists('ex18', 'xpto')."<br>");   //true
    var_dump(property_exists('ex18', 'bar')."<br>");    //false
    var_dump(property_exists('ex18', 'test')."<br>");   //true
    ex18::test();
    echo "<br>___________________________________________________<br>";

    echo "19)trait_exists — Checks if the trait exists<br>";
    //Due to trait, we are able to access multiple functions in a single class.
    trait World {
        private static $instance;
        protected $tmp;
        public static function World()
        {
            self::$instance = new static();
            self::$instance->tmp = get_called_class().' '.__TRAIT__;
            return self::$instance;
        }
    }
    if ( trait_exists( 'World' ) ) {
       
        class Hello {
            use World;

            public function text( $str )
            {
                return $this->tmp.$str;
            }
        }
    }
    echo Hello::World()->text('!!!'); // Hello World!!!
    echo "<br>___________________________________________________<br>";


?>