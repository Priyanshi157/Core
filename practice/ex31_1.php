<?php
echo '<pre>';

echo "Assignment , overwrite , printing <br>";
echo "___________________________________________<br>";
echo "Simple Variable<br>";
echo "___________________________________________<br>";

$var1 = 10;
$var2 = $var1;
echo $var1." -> Variable 1<br>";
echo $var2." -> Var2 = Var1<br>";

$var2 = 20;
echo $var2." -> Value assigned to Var2<br>";
echo $var1." -> Variable 1<br>";

echo "___________________________________________<br>";
echo "Class Variable,Methods with an object<br>";
echo "___________________________________________<br>";

class ex1{
	public $name = null;
	protected $price = 0;

	public function setPrice($price)
	{
		$this->price = $price;
		return $this;
	}

	public function setName($name)
	{
		$this->name = $name;
		return $this;
	}

	public function getPrice()
	{
		return $this->price;
	}

	public function resetPrice()
	{
		$this->price = 50;
		return $this;
	}
}
$obj1 = new ex1();
print_r($obj1->setPrice(100));
print_r($obj1->getPrice());
echo "<br>";

print_r($obj1->setName("Priyanshi"));
print_r($obj1->resetPrice());
echo "<br>";
echo "<br><br>";

$obj2 = $obj1;
print_r($obj2);
echo "<br>";
print_r($obj1);
echo "___________________________________________<br>";

?>