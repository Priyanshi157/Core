<?php
    echo "CLASS";
    echo "<br>";
    echo"********************************************<br>";

    echo "1)class_alias — Creates an alias for a class<br>";
    class foo { }

    class_alias('foo', 'bar');

    $a = new foo;
    $b = new bar;

    // the objects are the same
    var_dump($a == $b, $a === $b);echo "<br>";
    var_dump($a instanceof $b);echo "<br>";

    // the classes are the same
    var_dump($a instanceof foo);echo "<br>";
    var_dump($a instanceof bar);echo "<br>";

    var_dump($b instanceof foo);echo "<br>";
    var_dump($b instanceof bar);
    echo "<br>___________________________________________________<br>";

    echo "2)class_exists — Checks if the class has been defined<br>";
    if (class_exists('MyClass')) {
        $myclass = new MyClass();
    }
    echo "<br>___________________________________________________<br>";

    echo "3)enum_exists — Checks if the enum has been defined<br>";
    if (enum_exists(Suit::class)) {
       $myclass = Suit::Hearts;
    }
    echo "<br>___________________________________________________<br>";

    echo "4)get_called_class — The Late Static Binding class name<br>";
    class ex4 
    {
        static public function test() {
            var_dump(get_called_class());
        }
    }

    class bar extends ex4 {
    }

    ex4::test();
    bar::test();
    echo "<br>___________________________________________________<br>";

    echo "5)get_class_methods — Gets the class methods' names<br>";
    class myclass {
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

    $class_methods = get_class_methods('myclass');
    // or
    $class_methods = get_class_methods(new myclass());

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

    $my_class = new ex6();
    $class_vars = get_class_vars(get_class($my_class));
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
    $bar = new ex7();

    // external call
    echo "Its name is " , get_class($bar) , "<br>";

    // internal call
    $bar->name();
    echo "<br>___________________________________________________<br>";

    echo "8)get_class — Returns the name of the class of an object<br>";
    class ex8 {
        function name()
        {
            echo "My name is " , get_class($this) , "\n";
        }
    }

    // create an object
    $bar = new ex8();

    // external call
    echo "Its name is " , get_class($bar) , "\n";

    // internal call
    $bar->name();
    echo "<br>___________________________________________________<br>";

    echo "9)get_declared_classes — Returns an array with the name of the defined classes<br>";
    print_r(get_declared_classes());
    echo "<br>___________________________________________________<br>";

    echo "10)get_declared_interfaces — Returns an array of all declared interfaces<br>";
    print_r(get_declared_interfaces());
    echo "<br>___________________________________________________<br>";

    echo "11)get_declared_traits — Returns an array of all declared traits<br>";
    //namespace Example;

    // Declare Trait
    trait FooTrait
    {
    }

    // Declare Abstract class
    abstract class FooAbstract
    {
    }

    // Declare class
    class ex10 extends FooAbstract
    {
        use FooTrait;
    }

    // Get all traits declareds
    $array = get_declared_traits();

    var_dump($array);
    echo "<br>___________________________________________________<br>";

    echo "12)get_mangled_object_vars — Returns an array of mangled object properties<br>";
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

    echo "13)get_object_vars — Gets the properties of the given object<br>";
    class ex13 {
        private $a;
        public $b = 1;
        public $c;
        private $d;
        static $e;
       
        public function test() {
            var_dump(get_object_vars($this));
        }
    }

    $test = new ex13;
    var_dump(get_object_vars($test));

    $test->test();
    echo "<br>___________________________________________________<br>";

    echo "14)get_parent_class — Retrieves the parent class name for object or class<br>";
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

    echo "15)interface_exists — Checks if the interface has been defined<br>";
    if (interface_exists('MyInterface')) {
        class MyClass implements MyInterface
        {
            // Methods
        }
    }
    echo "<br>___________________________________________________<br>";

    echo "16)is_a — Checks if the object is of this class or has this class as one of its parents<br>";
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

    echo "17)is_subclass_of — Checks if the object has this class as one of its parents or implements it<br>";
    class ex17
    {
      var $oink = 'moo';
    }

    // define a child class
    class WidgetFactory_Child extends ex17
    {
      var $oink = 'oink';
    }

    // create a new object
    $WF = new ex17();
    $WFC = new WidgetFactory_Child();

    if (is_subclass_of($WFC, 'ex17')) {
      echo "yes, \$WFC is a subclass of ex17<br>";
    } else {
      echo "no, \$WFC is not a subclass of ex17<br>";
    }


    if (is_subclass_of($WF, 'ex17')) {
      echo "yes, \$WF is a subclass of ex17<br>";
    } else {
      echo "no, \$WF is not a subclass of ex17<br>";
    }


    if (is_subclass_of('WidgetFactory_Child', 'ex17')) {
      echo "yes, WidgetFactory_Child is a subclass of ex17<br>";
    } else {
      echo "no, WidgetFactory_Child is not a subclass of ex17";
    }
    echo "___________________________________________________<br>";

    echo "18)method_exists — Checks if the class method exists<br>";
    $directory = new Directory('.');
    var_dump(method_exists($directory,'read'));
    echo "<br>___________________________________________________<br>";

    echo "19)property_exists — Checks if the object or class has a property<br>";
    class ex19 {
        public $mine;
        private $xpto;
        static protected $test;

        static function test() {
            var_dump(property_exists('ex19', 'xpto')); //true
        }
    }

    var_dump(property_exists('ex19', 'mine')."<br>");   //true
    var_dump(property_exists(new myClass, 'mine')."<br>"); //true
    var_dump(property_exists('ex19', 'xpto')."<br>");   //true
    var_dump(property_exists('ex19', 'bar')."<br>");    //false
    var_dump(property_exists('ex19', 'test')."<br>");   //true
    ex19::test();
    echo "<br>___________________________________________________<br>";

    echo "20)trait_exists — Checks if the trait exists<br>";
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