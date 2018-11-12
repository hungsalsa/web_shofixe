<?php
namespace frontend\common;
use Yii;
use yii\web\Session;
/**
 * summary
 */
class Cart
{
    /**
     * summary
     */
    public function addCart($id,$arrData)
    {
    	$session = Yii::$app->session;
        if (!isset($session['cart'])) {
        	$cart[$id] = [
        		'pro_name'=>$arrData['pro_name'],
        		'slug'=>$arrData['slug'],
        		'price_sales'=>$arrData['price_sales'],
        		'price'=>$arrData['price'],
        		'image'=>$arrData['image'],
        		'manufacturer_id'=>$arrData['manufacturer_id'],
        		'amount'=>1,
        	];
        } else {
        	$cart = $session['cart'];
        	if(array_key_exists($id,$cart)){
        		$cart[$id] = [
        			'pro_name'=>$arrData['pro_name'],
        			'slug'=>$arrData['slug'],
	        		'price_sales'=>$arrData['price_sales'],
	        		'price'=>$arrData['price'],
	        		'image'=>$arrData['image'],
	        		'manufacturer_id'=>$arrData['manufacturer_id'],
	        		'amount'=>$cart[$id]['amount'] + 1,
        		];
        	}else{
        		$cart[$id] = [
        			'pro_name'=>$arrData['pro_name'],
        			'slug'=>$arrData['slug'],
	        		'price_sales'=>$arrData['price_sales'],
	        		'price'=>$arrData['price'],
	        		'image'=>$arrData['image'],
	        		'manufacturer_id'=>$arrData['manufacturer_id'],
	        		'amount'=>1,
        		];
        	}
        }
        $session['cart'] = $cart;
    }

    public function delItemCart($id)
    {
    	$session = Yii::$app->session;
    	if(isset($session['cart'])){
    		$cart = $session['cart'];

    		// remove session
    		unset($cart[$id]);
	    	$session['cart'] = $cart;
    	}
    }

    public function updateItem($id,$amount)
    {
        $session = Yii::$app->session;
        $cart = $session['cart'];
        if(array_key_exists($id,$cart)){
            $cart[$id] = [
                'pro_name'=>$cart[$id]['pro_name'],
                'slug'=>$cart[$id]['slug'],
                'price_sales'=>$cart[$id]['price_sales'],
                'price'=>$cart[$id]['price'],
                'image'=>$cart[$id]['image'],
                'manufacturer_id'=>$cart[$id]['manufacturer_id'],
                'amount'=>$amount,
            ];
            $session['cart'] = $cart;
        }
    }
}