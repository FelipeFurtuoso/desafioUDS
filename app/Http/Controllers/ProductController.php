<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    protected $product = null;
    public function __construct()
    {
        
    
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $product = new Product;
        if (!empty($request['code'])) {
            $getCode = $product->findProductByCode($request['code']);
            foreach ($getCode as $key => $getCodeOk) {}
                
            return $getCodeOk;
        }
        if (!empty($request['name'])) {
            $getName = $product->findProductByName($request['name']);
            foreach ($getName as $key => $getNameOk) {}
            return $getNameOk;
        }
        
       return $product->allproducts();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        $product = new Product;

        $existCode = $product->findProductByCode($request['code']);
        $existName = $product->findProductByName($request['name']);
        if (count($existCode) >= 1)return 'Codigo ja exite';
        if (count($existName) >= 1)return 'Nome ja exite';
        
        $product->createProduct($request->all());
        
        return 'Cadastrado com sucesso';
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show($code)
    {
        $products = new Product();
        $show = $products->findProductByCode($code);
        if (count($show) == 0) return 'Produto nao existe';
        
        return $products->findProductByCode($code);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {


         $product = new Product;
         $find = $product->findProductById($id);
         if (is_null($find)) return 'Produto nao existe';
         
         $product->updateProduct($request->all(), $find->id);

        return 'Atualizado com sucesso'; 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy($code)
    {
        $product = new Product;
        $find = $product->findProductByCode($code);
        if (is_null($find)) return 'Produto nao existe';
        $product->deleteProduct($code);
        return 'Deletado com sucesso'; 
    }
}
