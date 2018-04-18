<?php

namespace App\Http\Controllers;

use App\Product;
use App\OrderProduct;
use App\Order;
use Illuminate\Http\Request;

class OrderProductController extends Controller
{
    
    public function index()
    {
        //
    }

    public function store(Request $request)
    {
        if(empty($request->all()))return 'Informar campos para cadastrar o produto no pedido';
        if(empty($request['order_id']))return 'Informar Id Pedido';
        if(empty($request['product_id']))return 'Informar Id Produto';
        if(empty($request['quantity']) or $request['quantity'] <= 0 )return 'Informar quantidade válida';
        if(!is_numeric($request['discount']) or empty($request['discount']) )$request['discount'] = 0;

        $order = new Order;
        $showOrder = $order->findOrderById($request->input('order_id'));
        if (is_null($showOrder)) return 'Pedido nao existe';

        $product = new Product;
        $showProduct = $product->findProductById($request->input('product_id'));
        if (is_null($showProduct)) return 'Produto nao existe';

        
        
        $calculo = $order->calculateTotal($request->input('product_id'),$request->input('order_id'),$request->input('discount'),$request->input('quantity'));
        
        


        $params = ['total_order'=> $calculo['total']];
        $order_product = [
                   'order_id' => $request->input('order_id'),
                   'product_id' => $request->input('product_id'),
                   'quantity' => $request->input('quantity'),
                   'discount' => $request['discount'],
                   'total' => $calculo['subtotal']
        ];

        OrderProduct::create($order_product);


        
        $order->updateOrder($params,$request->input('order_id'));

        return 'Produto incluido com Sucesso';
    }


    
    public function show(OrderProduct $orderProduct)
    {
        //
    }

    
    public function update(Request $request, OrderProduct $orderProduct)
    {
        //
    }

    
    public function destroy($id)
    {
        $orderProduct= new OrderProduct;
        return  $order->deleteOrderProduct($id);

    }
}
