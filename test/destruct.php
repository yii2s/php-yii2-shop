<?php
namespace test;
use test\gaga\haha\Haha;
use test\gaga\Nana;

include ('./gaga/Nana.php');
$haha = new Nana('nimeide');
$haha->printHaha();

// һ�������Ĺ��ﳵ������һЩ�Ѿ���ӵ���Ʒ��ÿ����Ʒ��������
// ������һ�������������㹺�ﳵ��������Ʒ���ܼ۸񡣸÷���ʹ����һ��closure��Ϊ�ص�������
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
        //ʹ���û��Զ��庯���������е�ÿ��Ԫ�����ص�����
        array_walk($this->products, $callback);
        return round($total, 2);;
    }
}
$my_cart = new Cart;
// �����ﳵ�������Ŀ
$my_cart->add('butter', 1);
$my_cart->add('milk', 3);
$my_cart->add('eggs', 6);
// ������ܼ۸������� 5% ������˰.
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

