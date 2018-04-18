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
            if(count($getCode) == 0) return 'Codigo nao cadastrado';
            foreach ($getCode as $key => $getCodeOk) {}
                
            return $getCode;
        }
        if (!empty($request['name'])) {
            $getName = $product->findProductByName($request['name']);
            if(count($getName) == 0) return 'Nome nao cadastrado';
            foreach ($getName as $key => $getNameOk) {}
            return $getName;
        }
        
        $getAllProduct = $product->allproducts();
        if(count($getAllProduct)== 0 )return 'Nenhum Produto Cadastrado';
       return $getAllProduct;
    }

    public function store(Request $request)
    {
        if(empty($request->all()))return 'Informar campos para cadastrar o produto';
        if(empty($request['name']))return 'Informar Nome';
        if(empty($request['code']))return 'Informar Codigo';
        if(!is_numeric($request['price']))return 'Informar Preco Valido';
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
        if(empty($request->all()))return 'Informar campos para Atualizar o produto';
        if(empty($request['name']))return 'Informar Nome';
        if(empty($request['code']))return 'Informar Codigo';

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
