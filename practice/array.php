<!-- You can define a variable with key and value pairs
Example:

$users = [
  Key1 => value1,
  Key2 => value2,
]
 -->    

<?php
    echo "ARRAY";
    echo "<br>";
    echo"********************************************";
    echo "<br>";
    $lang = array("python","java","php");
    print_r($lang);
    echo "<br>";
    var_dump($lang);
    echo "<br>";
    echo "Using echo 0th index value is : ".$lang[0];
    echo "<br>";
    echo "total items in array : ".count($lang);

    echo "<br>";
    echo "___________________________________________________<br>";
    echo "key => value array";
    echo "<br>";
    $age = array("Peter"=>"35", "Ben"=>"37", "Joe"=>"43");
    print_r($age);
    echo "<br>";
    echo "___________________________________________________<br>";

    echo "1)array_change_key_case — Changes the case of all keys in an array<br>";
    print_r(array_change_key_case($age,CASE_LOWER));
    echo "<br>";
    print_r(array_change_key_case($age,CASE_UPPER));
    echo "<br>___________________________________________________<br>";

    echo "2)array_chunk — Split an array into chunks<br>";
    print_r(array_chunk($age, 2));
    echo "<br>";
    print_r(array_chunk($age, 1,true));
    echo "<br>___________________________________________________<br>";

    echo "3)array_column — Return the values from a single column in the input array<br>";
    $records = array(
    array(
        'id' => 2135,
        'first_name' => 'John',
        'last_name' => 'Doe',
    ),
    array(
        'id' => 3245,
        'first_name' => 'Sally',
        'last_name' => 'Smith',
    ));
    $first_names = array_column($records, 'first_name');
    print_r($first_names);
    echo "<br>";
    $last_names = array_column($records, 'last_name');
    print_r($last_names);
    echo "<br>___________________________________________________<br>";

    echo "4)array_combine — Creates an array by using one array for keys and another for its values<br>";
    $a = array('green', 'red', 'yellow');
    $b = array('avocado', 'apple', 'banana');
    $c = array_combine($a, $b);
    print_r($c);
    echo "<br>___________________________________________________<br>";

    echo "5)array_count_values — Counts all the values of an array<br>";
    $array = array(1, "hello", 1, "world", "hello");
    print_r(array_count_values($array));
    echo "<br>___________________________________________________<br>";

    echo "6)array_diff_assoc — Computes the difference of arrays with additional index check<br>";
    $array1 = array("a" => "green", "b" => "brown", "c" => "blue", "red");
    $array2 = array("a" => "green", "yellow", "red");
    $result = array_diff_assoc($array1, $array2);
    print_r($result);
    echo "<br>___________________________________________________<br>";

    echo "7)array_diff_key — Computes the difference of arrays using keys for comparison<br>";
    $array1 = array('blue' => 1, 'red' => 2, 'green' => 3, 'purple' => 4);
    $array2 = array('green' => 5, 'yellow' => 7, 'cyan' => 8);
    $array3 = array('blue' => 6, 'yellow' => 7, 'mauve' => 8);
    var_dump(array_diff_key($array1, $array2,$array3));
    echo "<br>___________________________________________________<br>";

    echo "8)array_diff_uassoc — Computes the difference of arrays with additional index check which is performed by a user supplied callback function<br>";
    function key_compare_func($a, $b)
    {
        if ($a === $b) 
        {
            return 0;
        }
        return ($a > $b)? 1:-1;
    }

    $array1 = array("a" => "green", "b" => "brown", "c" => "blue", "red");
    $array2 = array("a" => "green", "yellow", "red");
    $result = array_diff_uassoc($array1, $array2, "key_compare_func");
    print_r($result);
    echo "<br>___________________________________________________<br>";


    echo "9)array_diff_ukey — Computes the difference of arrays using a callback function on the keys for comparison<br>";
    function key_compare_fun($key1, $key2)
    {
        if ($key1 == $key2)
            return 0;
        else if ($key1 > $key2)
            return 1;
        else
            return -1;
    }
    $array1 = array('blue'  => 1, 'red'  => 2, 'green'  => 3, 'purple' => 4);
    $array2 = array('green' => 5, 'blue' => 6, 'yellow' => 7, 'cyan'   => 8);
    var_dump(array_diff_ukey($array1, $array2, 'key_compare_fun'));
    echo "<br>___________________________________________________<br>"; 

    echo "10)array_diff — Computes the difference of arrays<br>";
    $array1 = array("a" => "green", "red", "blue", "red");
    $array2 = array("b" => "green", "yellow", "red");
    $result = array_diff($array1, $array2);
    print_r($result);
    echo "<br>___________________________________________________<br>"; 

    echo "11)array_fill_keys — Fill an array with values, specifying keys<br>";
    $keys = array('foo', 5, 10, 'bar');
    $a = array_fill_keys($keys, 'banana');
    print_r($a);
    echo "<br>___________________________________________________<br>"; 

    echo "12)array_fill — Fill an array with values<br>";
    $a = array_fill(5, 6, 'banana');
    $b = array_fill(-2, 4, 'pear');
    print_r($a);
    echo "<br>";
    print_r($b);
    echo "<br>___________________________________________________<br>"; 

    echo "13)array_filter — Filters elements of an array using a callback function<br>";
    function odd($var)
    {
        // returns whether the input integer is odd
        return $var & 1;
    }

    function even($var)
    {
        // returns whether the input integer is even
        return !($var & 1);
    }

    $array1 = ['a' => 1, 'b' => 2, 'c' => 3, 'd' => 4, 'e' => 5];
    $array2 = [6, 7, 8, 9, 10, 11, 12];

    echo "Odd :\n";
    print_r(array_filter($array1, "odd"));
    echo "<br>";
    echo "Even:\n";
    print_r(array_filter($array2, "even"));
    echo "<br>___________________________________________________<br>"; 

    echo "14)array_flip — Exchanges all keys with their associated values in an array<br>";
    $input = array("oranges", "apples", "pears");
    echo "Before flip : ";
    print_r($input);
    echo "<br>";
    $flipped = array_flip($input);
    print_r($flipped);
    echo "<br>___________________________________________________<br>"; 

    echo "15)array_intersect_assoc — Computes the intersection of arrays with additional index check<br>";
    $array1 = array("a" => "green", "b" => "brown", "c" => "blue", "red");
    $array2 = array("a" => "green", "b" => "yellow", "blue", "red");
    $result_array = array_intersect_assoc($array1, $array2);
    print_r($result_array);
    echo "<br>___________________________________________________<br>";

    echo "16)array_intersect_key — Computes the intersection of arrays using keys for comparison<br>";
    $array1 = array('blue'  => 1, 'red'  => 2, 'green'  => 3, 'purple' => 4);
    $array2 = array('green' => 5, 'blue' => 6, 'yellow' => 7, 'cyan'   => 8);
    var_dump(array_intersect_key($array1, $array2));
    echo "<br>___________________________________________________<br>";

    echo "17)array_intersect_uassoc — Computes the intersection of arrays with additional index check, compares indexes by a callback function<br>";
    $array1 = array("a" => "green", "b" => "brown", "c" => "blue", "red");
    $array2 = array("a" => "GREEN", "B" => "brown", "yellow", "red");
    print_r(array_intersect_uassoc($array1, $array2, "strcasecmp"));
    echo "<br>___________________________________________________<br>";

    echo "18)array_intersect_ukey — Computes the intersection of arrays using a callback function on the keys for comparison<br>";
    function key_compare($key1, $key2)
    {
        if ($key1 == $key2)
            return 0;
        else if ($key1 > $key2)
            return 1;
        else
            return -1;
    }

    $array1 = array('blue'  => 1, 'red'  => 2, 'green'  => 3, 'purple' => 4);
    $array2 = array('green' => 5, 'blue' => 6, 'yellow' => 7, 'cyan'   => 8);

    var_dump(array_intersect_ukey($array1, $array2, 'key_compare'));
    echo "<br>___________________________________________________<br>";

    echo "19)array_intersect — Computes the intersection of arrays<br>";
    $array1 = array("a" => "green", "red", "blue");
    $array2 = array("b" => "green", "yellow", "red");
    $result = array_intersect($array1, $array2);
    print_r($result);
    echo "<br>___________________________________________________<br>";
    
    echo "20)array_is_list — Checks whether a given array is a list<br>";
    print_r(array_is_list([])); // true
    echo "<br>";
    print_r(array_is_list(['apple', 2, 3])); // true
    echo "<br>";
    print_r(array_is_list([0 => 'apple', 'orange'])); // true
    echo "<br>";

    // The array does not start at 0
    print_r(array_is_list([1 => 'apple', 'orange'])); // false
    echo "<br>";

    // The keys are not in the correct order
    print_r(array_is_list([1 => 'apple', 0 => 'orange'])); // false
    echo "<br>";

    // Non-integer keys
    print_r(array_is_list([0 => 'apple', 'foo' => 'bar'])); // false
    echo "<br>";

    // Non-consecutive keys
    print_r(array_is_list([0 => 'apple', 2 => 'bar'])); // false
    echo "<br>___________________________________________________<br>";

    echo "21)array_key_exists — Checks if the given key or index exists in the array<br>";
    $search_array = array('first' => 1, 'second' => 4);
    if (array_key_exists('first', $search_array)) {
        echo "The 'first' element is in the array";
    }
    else{
        echo 0;
    }
    echo "<br>___________________________________________________<br>";

    echo "22)array_key_first — Gets the first key of an array<br>";
    $array = ['a' => 1, 'b' => 2, 'c' => 3];
    $firstKey = array_key_first($array);
    var_dump($firstKey);
    echo "<br>___________________________________________________<br>";

    echo "23)array_key_last — Gets the last key of an array<br>";
    $last_key = array_key_last($array);
    var_dump($last_key);
    echo "<br>___________________________________________________<br>";

    echo "24)array_keys — Return all the keys or a subset of the keys of an array<br>";
    $array = array(0 => 100, "color" => "red");
    print_r(array_keys($array));
    echo "<br>";

    $array = array("blue", "red", "green", "blue", "blue");
    print_r(array_keys($array, "blue"));
    echo "<br>";

    $array = array("color" => array("blue", "red", "green"),
                   "size"  => array("small", "medium", "large"));
    print_r(array_keys($array));
    echo "<br>___________________________________________________<br>";

    echo "25)array_map — Applies the callback to the elements of the given arrays<br>";
    function cube($n)
    {
        return ($n * $n * $n);
    }

    $a = [1, 2, 3, 4, 5];
    $b = array_map('cube', $a);
    print_r($b);
    echo "<br>___________________________________________________<br>";

    echo "26)array_merge_recursive — Merge one or more arrays recursively<br>";
    $ar1 = array("color" => array("favorite" => "red"), 5);
    $ar2 = array(10, "color" => array("favorite" => "green", "blue"));
    $result = array_merge_recursive($ar1, $ar2);
    print_r($result);
    echo "<br>___________________________________________________<br>";

    echo "27)array_merge — Merge one or more arrays<br>";
    $array1 = array("color" => "red", 2, 4);
    $array2 = array("a", "b", "color" => "green", "shape" => "trapezoid", 4);
    $result = array_merge($array1, $array2);
    print_r($result);
    echo "<br>___________________________________________________<br>";

    echo "28)array_multisort — Sort multiple or multi-dimensional arrays<br>";
    $ar1 = array(10, 100, 100, 0);
    $ar2 = array(1, 3, 2, 4);
    array_multisort($ar1, $ar2);

    var_dump($ar1);
    echo "<br>";
    var_dump($ar2);
    echo "<br>___________________________________________________<br>";

?>