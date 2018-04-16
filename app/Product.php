<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
	protected $fillable = [
        
        'code',
        'name',
        'price'
    ];

    public function allproducts ()
    {
    	return $this->all();	
    }

    public function createProduct(array $params) 
    {
      
    	$product = new Product($params);
    	$product->save();
      return $product;
    }

    public function findProductById($id)
    {
       $product = self::find($id);

       return $product;
    }

    public function findProductByCode($code)
    {
       $product = self::all()->where('code','=',$code);

       return $product;
    }

    public function findProductByName($name)
    {
       
       $product = self::all()->where('name','=',$name);

       return self::all()->where('name','=',$name);
    }

    public function updateProduct($params , $id)
    {
        
        $product = self::findProductById($id);
        $product->fill($params);
        $product->save();
        return $product;

    }

    public function deleteProduct($id)
    {
       $product = self::findProductById($id);
       $product->delete();
       return $product;
    }

    
}
