<?php
// Базовая корзина покупок, содержащая список добавленных
// продуктов и количество каждого продукта. Включает метод,
// вычисляющий общую цену элементов корзины с помощью
// callback-замыкания.
class Cart
{
    const PRICE_BUTTER = 1.00;
    const PRICE_MILK = 3.00;
    const PRICE_EGGS = 6.95;

    protected $products = array();

    public function add($product, $quantity)
    {
        $this->products[$product] = $quantity;
    }

//    public function getQuantity($product)
//    {
//        return isset($this->products[$product]) ? $this->products[$product] :
//            FALSE;
//    }

    public function getTotal($tax)
    {
        $total = 0.00;

        $callback = function ($quantity, $product) use ($tax, &$total) {
            $pricePerItem = constant(__CLASS__ . "::PRICE_" .
                strtoupper($product));
            $total += ($pricePerItem * $quantity) * ($tax + 1.0);
        };
        array_walk($this->products, $callback);
        return round($total, 2);
    }
}

$my_cart = new Cart;

// Добавляем несколько элементов в корзину
$my_cart->add('butter', 1);
$my_cart->add('milk', 3);
$my_cart->add('eggs', 6);

// Выводим общую сумму с 5% налогом на продажу.
print $my_cart->getTotal(0.05) . "\n";
// Результатом будет 54.29
?>