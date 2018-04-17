<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Product;

class OrderProduct extends Model
{
	 protected $table = 'order_product';

     protected $fillable = [
        
        'order_id',
        'product_id',
        'discount',
        'quantity',
        'total',
    ];


	public function product()
	{
    	return $this->belongsTo(Product::class);   

	}

	public static function findOrderProductbyOrder($order_id)
	{
    	return self::all()->where('order_id','=',$order_id);

	}
	
    public function deleteOrderProduct($id)
    {
       $orderProduct = self::findOrderById($id);
       $orderProduct->delete();
       return $orderProduct;
    }

}
