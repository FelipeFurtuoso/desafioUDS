<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
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
        
        $getAllProduct = $product->allproducts();
        if(count($getAllProduct)== 0 )return 'Nenhum Produto Cadastrado';
       return $getAllProduct;
    }

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

    public function show($id)
    {
        $products = new Product();
        $show = $products->findProductById($id);
        if (is_null($show)) return 'Produto nao existe';
        
        return $products->findProductById($id);
    }

    public function update(Request $request,$id)
    {


         $product = new Product;
         $find = $product->findProductById($id);
         if (is_null($find)) return 'Produto nao existe';
         
         $product->updateProduct($request->all(), $find->id);

        return 'Atualizado com sucesso'; 
    }

    public function destroy($id)
    {
        $product = new Product;
        $find = $product->findProductById($id);
        if (is_null($find)) return 'Produto nao existe';
        $product->deleteProduct($id);
        return 'Deletado com sucesso'; 
    }
}
