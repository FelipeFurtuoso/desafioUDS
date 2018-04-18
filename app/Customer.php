<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
 protected $fillable = [
        
        'name',
        'cpf',
        'birthdate'
    ];

    public function allcustomer ()
    {
    	return $this->all();	
    }

    public function createCustomer(array $params) 
    {
      	
    	$customer = new Customer($params);
    	$customer->save();
      	return $customer;
    }

    public function findCustomerById($id)
    {
        $customer = self::find($id);

        return $customer;
    }

    public function findCustomerByCPF($cpf)
    {
        $customer = self::all()->where('cpf','=',$cpf);

        return $customer;
    }

    public function findCustomerByName($name)
    {
      
        $customer =  self::where('name','like','%'.$name.'%')->get();

        return $customer;
    }

    public function findCustomerByBirthdate($birthdate)
    {
       
        $customer = self::where('birthdate','like','%'.$birthdate.'%')->get();
        
        return $customer;
    }

    public function updateCustomer($params , $id)
    {
        
        $customer = self::findCustomerById($id);
        $customer->fill($params);
        $customer->save();
        return $customer;

    }

    public function deleteCustomer($id)
    {
       $customer = self::findCustomerById($id);
       $customer->delete();
       return $customer;
    }

    
}
