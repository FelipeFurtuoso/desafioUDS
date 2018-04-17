<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Customer;
use App\Product;
use App\OrderProduct;


class Order extends Model
{
    protected $fillable = [
        
        'code',
        'customer_id',
        'emission',
        'total_order',
    ];
    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function orderProduct()
    {
        return $this->hasMany(OrderProduct::class);
    }
    
    
    public function updateOrder($params,$id)
    {
        $order = self::find($id);
        $order->fill($params);
        $order->save();
        return $order;

    }

    public function findOrderByCode($code)
    {
        $order = self::all()->where('code','=',$code);
        return $order;

    }

    public function findOrderById($id)
    {
        $order = self::find($id);
        return $order;

    }

    public function findOrderByCustomer($customer_id)
    {
        $order = self::all()->where('customer_id','=',$customer_id);
        
        return $order;

    }

    public function findOrderByTotalOrder($total_order)
    {
        $order = self::all()->where('total_order','=',$total_order);
        
        return $order;

    }

    public function findOrderByProduct($product_id)
    {
        $orderProduct = new OrderProduct;
        
        
        return $orderProduct->all()->where('product_id','=',$product_id);

    }

    public function findOrderByEmission($emission)
    {
        $order = self::all()->where('emission','=',$emission);
        
        return $order;

    }

    public function deleteOrder($id)
    {
       $order = self::findOrderById($id);
       $order->delete();
       return $order;
    }

    public function search($params,$value)
    {
       $order = self::all()->where($params,'=',$value);
       return $order;
    }

    public function calculateTotal($product_id,$order_id,$discount,$quantity)
    {
        $product = new Product;
        $productOk = $product->findProductById($product_id);
        $aux = self::find($order_id);


        $percentual = $discount / 100.0;
        $discount = $productOk->price - ($percentual*$productOk->price);
        $total['total'] = ($discount * $quantity) + $aux->total_order;
        $total['subtotal'] = $discount;

        return $total;
    }
}
