<?php
class Product
{
	protected $price = null;
	public function setPrice($price) 
	{
		$this->price = $price;
		return $this;
	}

	public function getPrice() {
		return $this->price;
	}

	public function doubleThePrice($p)
	{
		$p->setPrice(20.00 * 2);
	}
}

/* ------ CASE 1------------*/

$p1 = new Product(); // create new object p1
$p1->setPrice(10.00);

$p2 = new Product(); // create new object p2
echo $p2->getPrice();

echo "<br>";

/* ------ CASE 2------------*/

$p1 = new Product(); // create new object p1
$p1->setPrice(10.00);

$p2 = new Product(); // create new object p2
$p2->setPrice(20.00);

echo $p1->getPrice();

echo "<br>";

/* ------ CASE 3------------*/

$p1 = new Product(); // create new object p1
$p1->setPrice(10.00);

$p2 = $p1; //give value of p1 to p2
$p2->setPrice(20.00);

echo $p1->getPrice();

echo "<br>";

/* ------ CASE 4 ------------*/

function changePrice($p){
	$p->setPrice(20.00);
}

$p1 = new Product(); // create new object
$p1->setPrice(10.00);

changePrice($p1);

echo $p1->getPrice();

echo "<br>";

/* ------ CASE 5 ------------*/

function tripleThePrice($p){
	$p->setPrice($p->getPrice() * 3);
}

$p1 = new Product(); // create new object p1
$p1->setPrice(10.00);

tripleThePrice($p1);

echo $p1->getPrice();
echo "<br>";

echo "_____________________________________________________________________________<br>";
class Box
{
	protected $item = null;
	
	public function setItem($item) {
		$this->item = $item;
		return $this;
	}

	public function getItem() {
		return $this->item;
	}
}

class User extends Box
{

}

/* ------ CASE 1------------*/

$box = new Box();
$box->setItem('phone');

$user = new User();
echo $user->getItem();

echo "<br>";

/* ------ CASE 2------------*/

$user = new User();
$user->setItem('phone');

$box = new Box();
echo $box->getItem();

echo "<br>";

/* ------ CASE 3------------*/

$user = new User();
$user->setItem('phone');

$box = new Box();
$box->setItem('mobile');

echo $user->getItem();

?>