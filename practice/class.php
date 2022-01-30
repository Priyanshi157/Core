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

    echo "7)8<br>";
    echo "<br>___________________________________________________<br>";

    echo "7)<br>";
    echo "<br>___________________________________________________<br>";

    echo "7)<br>";
    echo "<br>___________________________________________________<br>";

    echo "7)<br>";
    echo "<br>___________________________________________________<br>";

    echo "7)<br>";
    echo "<br>___________________________________________________<br>";

    echo "7)<br>";
    echo "<br>___________________________________________________<br>";
    
?>