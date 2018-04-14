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
       
        $customer = self::all()->where('name','=',$name);

        return self::all()->where('name','=',$name);
    }

    public function findPeopleByBirthdate($birthdate)
    {
       
        $customer = self::all()->where('birthdate','=',$birthdate);

        return self::all()->where('birthdate','=',$birthdate);
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
