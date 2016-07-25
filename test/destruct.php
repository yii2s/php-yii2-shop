<?php
namespace test;
use test\gaga\haha\Haha;
use test\gaga\Nana;

include ('./gaga/Nana.php');
$haha = new Nana('nimeide');
$haha->printHaha();

// 一个基本的购物车，包括一些已经添加的商品和每种商品的数量。
// 其中有一个方法用来计算购物车中所有商品的总价格。该方法使用了一个closure作为回调函数。
class Cart
{
    const PRICE_BUTTER  = 1.00;
    const PRICE_MILK    = 3.00;
    const PRICE_EGGS    = 6.95;
    protected   $products = array();
    public function add($product, $quantity)
    {
        $this->products[$product] = $quantity;
    }
    public function getQuantity($product)
    {
        return isset($this->products[$product]) ? $this->products[$product] :
            FALSE;
    }
    public function getTotal($tax)
    {
        $total = 0.00;
        $callback =
            function ($quantity, $product) use ($tax, &$total)
            {
                $pricePerItem = constant(__CLASS__ . "::PRICE_" .
                    strtoupper($product));
                $total += ($pricePerItem * $quantity) * ($tax + 1.0);
            };
        //使用用户自定义函数对数组中的每个元素做回调处理
        array_walk($this->products, $callback);
        return round($total, 2);;
    }
}
$my_cart = new Cart;
// 往购物车里添加条目
$my_cart->add('butter', 1);
$my_cart->add('milk', 3);
$my_cart->add('eggs', 6);
// 打出出总价格，其中有 5% 的销售税.
print $my_cart->getTotal(0.05) . "\n";
// The result is 54.29



function html($code , $id="", $class=""){
    if ($id !== "") $id = " id = \"$id\"" ;
    $class = ($class !== "")? " class =\"$class\">":">";
    $open = "<$code$id$class";
    $close = "</$code>";
    return function ($inner = "") use ($open, $close){
        return "$open$inner$close";
    };
}

$object = html('div', 'username', 'name');

echo $object('asdasd');


//  How to check a variable to see if it can be called
//  as a function.

//
//  Simple variable containing a function
//

function someFunction()
{
}

$functionVariable = 'someFunction';

var_dump(is_callable($functionVariable, false, $callable_name));  // bool(true)

echo $callable_name, "\n";  // someFunction

//
//  Array containing a method
//

class someClass {

    function someMethod()
    {
    }

}

$anObject = new someClass();

$methodVariable = array($anObject, 'someMethod');

var_dump(is_callable($methodVariable, true, $callable_name));  //  bool(true)

echo $callable_name, "\n";  //  someClass::someMethod

