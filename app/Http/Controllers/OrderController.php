<?php

namespace App\Http\Controllers;

use App\Customer;
use App\Product;
use App\Order;
use App\OrderProduct;
use Illuminate\Http\Request;
use Ramsey\Uuid\Uuid;
use Carbon\Carbon;



class OrderController extends Controller
{
    
    public function index(Request $request)
    {

        $orderGet = new Order;


        if (!empty($request['customer_id'])) {
            $getCustomer = $orderGet->findOrderByCustomer($request['customer_id']);
            if (count($getCustomer) == 0)return 'Nada Encontrado';
            foreach ($getCustomer as $key => $getCustomerOk) {}
            return $getCustomer;
        }
        if (!empty($request['code'])) {
            $getCode = $orderGet->findOrderByCode($request['code']);
            if (count($getCode) == 0)return 'Nada Encontrado';
            foreach ($getCode as $key => $getCodeOk) {}
            $id = $getCodeOk->id;
        }
        if (!empty($request['emission'])) {
            $getDate = $orderGet->findOrderByEmission($request['emission']);
            if (count($getDate) == 0)return 'Nada Encontrado';
            foreach ($getDate as $key => $getDateOk) {}
            $id =  $getDateOk->id;
        }
        if (!empty($request['total_order'])) {
            $getTotalOrder = $orderGet->findOrderByTotalOrder($request['total_order']);
            if (count($getTotalOrder) == 0)return 'Nada Encontrado';
            foreach ($getTotalOrder as $key => $getTotalOrderOk) {}
            $id = $getTotalOrderOk->id;
        }
        if (!empty($request['product_id'])) {
            $getProduct = $orderGet->findOrderByProduct($request['product_id']);
            if (count($getProduct) == 0)return 'Nada Encontrado';
            foreach ($getProduct as $key => $getProductOk) {}
            return $getProduct;
        }

        if(empty($id)){
            $all=Order::where('id','>=',0)->paginate(5);
            
            foreach ($all as $key => $allGet) {
               $aux[]=$allGet;
            }

            if(empty($aux))return 'Nenhuma Pedido Cadastrado';
            return $aux;
        } 
        $show = $order1->findOrderById($id);
        if (is_null($show)) return 'Produto nao existe';

        
        
       
        $orderProducts = $orderGet->find($id)->products;
        
        $orderCustomer = $orderGet->find($id)->customer;
        $orderTotal = $orderGet->find($id)->total_order;
        $orderSubTotal = OrderProduct::findOrderProductbyOrder($id);
               
        
         
        foreach ($orderSubTotal as $key => $value1) 
        {   
           $order['product'][]['subtotal'] = $value1->total;
        }

        foreach ($orderProducts as $key => $value) 
        {
            $order['product'][$key]['id'] = $value->id;
            $order['product'][$key]['code'] = $value->code;
            $order['product'][$key]['name'] = $value->name;
        }
        
        $order['customer'] = $orderCustomer; 
        $order['total'] = $orderTotal;
        
     
    return $order;   
    }
    
    public function store(Request $request)
    {
        $date = Carbon::now()->toDateString();
        

        $orderInfo = 
        [
            'code' => Uuid::uuid4(),
            'customer_id' => $request->input('customer_id'),
            'emission' => $date,
            'total_order' => 0,
        ];
        $order = new Order($orderInfo);
        $order1 = $order->save();

       $orderReturn = 
       [
        'id' => $order->id,
        'code' => $order->code,
        'customer' => $order->customer,
        'emission' => $order->emission,
        'total' => $order->total,
       ];
         
        return $orderReturn;

    }

    
    public function show($id)
    {
        $order1 = new Order;
        $show = $order1->findOrderById($id);
        if (is_null($show)) return 'Pedido nao existe';

        
        
        $orderProducts = $order1->find($id)->products;
        $orderCustomer = $order1->find($id)->customer;
        $orderTotal = $order1->find($id)->total_order;
        $orderSubTotal = OrderProduct::findOrderProductbyOrder($id);
               
        
         
        foreach ($orderSubTotal as $key => $value1) 
        {   
            $order['product'][]['subtotal'] = $value1->total;
        }
        
        foreach ($orderProducts as $key => $value) 
        {
            $order['product'][$key]['id'] = $value->id;
            $order['product'][$key]['code'] = $value->code;
            $order['product'][$key]['name'] = $value->name;
        }
        
        
        
        $order['customer'] = $orderCustomer; 
        $order['total'] = $orderTotal;

        return $order;
    }

    
    public function update(Request $request, Order $order)
    {

    }

    
    public function destroy($id)
    {
        $order = new Order;
        $show = $order->findOrderById($id);
        if (is_null($show)) return 'Pedido nao existe';
        $order->deleteOrder($id);
        
        OrderProduct::where('order_id','=',$id)->delete();
        return 'Deletado com Sucesso';
    }
}
