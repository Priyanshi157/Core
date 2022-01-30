<!--
    To print:
    echo(arg1) ->int,string
    print_t(expression); ->array , object -> made of more than one values
    var_dump(expression); ->boolean,array,object -> shows type length and value

can print : int , string , boolean , array , object
echo "<br>";

echo '<pre>';      -> to formate the page

variable have name , value and location.

variables: int , string , boolean , array , object

define variable : $name = 'piyu';
          $age = '30';  
          $flag = true / false



Enum is nothing but can has multiple options available with it.
Like an array 


-->
<?php
    echo "CONSTANT";
    echo "<br>";
    echo"********************************************";
    echo "<br>";
    define('pi',3.14);
    echo pi;
    echo "<br>";


    echo"********************************************";
    echo "<br>";
    echo "VARIABLES";
    echo "<br>";
    echo"********************************************";
    echo "<br>";
    $name = "priyanshi";
    $age = '20';  
    $flag = true;

    echo 'hello '.$name;
    echo "<br>";
    echo "$age";
    echo "<br>";
    echo "$flag";
    echo "<br>";

    echo $name." ".$age;
    echo "<br>";
    echo "$name $name";
    echo "<br>";

    $variable_name = 'Define Variable';

    echo "$variable_name Using Echo";
    echo "<br>";
    print_r($variable_name.'Using print_r');
    echo "<br>";
    var_dump($variable_name.'Using var_dump');

    echo "<br>";echo "<br>";


    echo"********************************************";
    echo "<br>";
    echo "ASSIGNMENT OPERATOR";
    echo "<br>";
    echo"********************************************";
    echo "<br>";
    $var1 = 35;
    echo "The value of var is : ".$var1;
    echo "<br>";
    $var1 += 5;
    echo "The value of var after + : ".$var1;
    echo "<br>";
    $var1-=10;
    echo "The value of var after - : ".$var1;
    echo "<br><br>";

    echo"********************************************";
    echo "<br>";
    echo "DATA TYPES";
    echo "<br>";
    echo"********************************************";
    echo "<br>";
    $var = "This is a String";
    echo var_dump($var)." echo and var_dump mixed";
    echo "<br>";

    $var = 78;
    var_dump($var)." echo and var_dump mixed";
    echo "<br>";

    $var = 78.50;
    var_dump($var)." echo and var_dump mixed";
    echo "<br>";

    $var = true;
    
    var_dump($var)." echo and var_dump mixed";
    echo "<br>";

    $product = $product = ['hello','hi'];

    var_dump($product)." echo and var_dump mixed";
    echo "<br>";

    echo pi."value of pi which is defined as a constant";
    echo "<br>"    ;
    
    /* 
    1.String
    2.Integer
    3.Float
    4.Boolean
    5.Array
    6.Object
    Non primitive are :Object , structure 

    Primitive are:Int, string, float, bool , array
    */
?>