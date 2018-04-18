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
        $i = 0;

        if (!empty($request['customer_id'])) 
            {
            $getCustomer = $orderGet->findOrderByCustomer($request['customer_id']);
            if (count($getCustomer) == 0)return 'Nada Encontrado';

            foreach ($getCustomer as $key => $getCustomerOk) 
            {
            $value['order'][$key] = self::formatArray($getCustomerOk->id,$i);
            }
            return $value;
        }
        if (!empty($request['product_id'])) 
            {
            $getProduct = $orderGet->findOrderByProduct($request['product_id']);
            if (count($getProduct) == 0)return 'Nada Encontrado';

            foreach ($getProduct as $key => $getProductOk) 
            {
            $value['order'][] = self::formatArray($getProductOk->id,$i);
            }
            return $value;
            
        }
        if (!empty($request['code'])) 
            {
            $getCode = $orderGet->findOrderByCode($request['code']);
            if (count($getCode) == 0)return 'Nada Encontrado';
            
            foreach ($getCode as $key => $getCodeOk) 
            {
                $value['order'][] = self::formatArray($getCodeOk->id,$i);
            }
            return $value;
        }
        if (!empty($request['emission'])) 
            {
            $getDate = $orderGet->findOrderByEmission($request['emission']);
            if (count($getDate) == 0)return 'Nada Encontrado';
            
            foreach ($getDate as $key => $getDateOk) 
            {
                $value['order'][] = self::formatArray($getDateOk->id,$i);
            }
            return $value;
            }
        if (!empty($request['total_order'])) 
            {
            $getTotalOrder = $orderGet->findOrderByTotalOrder($request['total_order']);
            if (count($getTotalOrder) == 0)return 'Nada Encontrado';
            
            foreach ($getTotalOrder as $key => $getTotalOrderOk) 
            {
                $value['order'][] = self::formatArray($getTotalOrderOk->id,$i);   
            }
            return $value;
            }
        

        if(empty($id))
            {
            $all=Order::where('id','>=',0)->paginate(5);
            
            foreach ($all as $key => $allGet) 
            {
               $value['order'][] = self::formatArray($allGet->id,$i);
            }

            if(empty($value))return 'Nenhum Pedido Cadastrado';
            return $value;
            } 
   
    }
    
    public function store(Request $request)
    {
        $date = Carbon::now()->toDateString();
        $customer = new Customer();
        $show = $customer->findCustomerById($request->input('customer_id'));
        if (is_null($show)) return 'Cliente nao existe';

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
        $i = 0;
        $show = $order1->findOrderById($id);
        if (is_null($show)) return 'Pedido nao existe';
        
        $value['order'][] = self::formatArray($id,$i);
        return $value;
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

    public  function formatArray($id,$i)
    {

        $order1 = new Order;
        $orderProducts = $order1->find($id)->orderProduct;

        foreach ($orderProducts as $key => $orderProductsOk) {
            $aux[$key]  = $orderProductsOk;
        }
        
        $orderCustomer = $order1->find($id)->customer;
        $getOrder = $order1->find($id);
        
        $i++;
        $order['id'] = $getOrder->id;
        $order['code'] = $getOrder->code;
        $order['emission'] = $getOrder->emission;
        $order['customer'] = $orderCustomer; 
        
        if (empty($aux)) {
          $order['product'] = 'Sem produtos';
        }else{
        foreach ($aux as $j => $value) 
        {
            
            $order['product'][$j]['id'] = $value->id;
            $order['product'][$j]['code'] = $value->product->code;
            $order['product'][$j]['name'] = $value->product->name;
            $order['product'][$j]['discount'] = $value->discount;
            $order['product'][$j]['quantity'] = $value->quantity;
            $order['product'][$j]['subtotal'] = $value->total;
           
        }
        }
        $order['total'] = $getOrder->total_order;
        
        
        return $order;
    }
    

}
