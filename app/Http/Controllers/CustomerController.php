<?php

namespace App\Http\Controllers;

use Validator;
use App\Customer;
use Illuminate\Http\Request;


class CustomerController extends Controller
{
    public function index()
    {

        $customer = new Customer;
        if (!empty($request['cpf'])) {
            $getCpf = $customer->findPeopleByCode($request['cpf']);
            foreach ($getCpf as $key => $getCpfOk) {}
            return $getCodeOk;
        }
        if (!empty($request['name'])) {
            $getName = $customer->findPeopleByName($request['name']);
            foreach ($getName as $key => $getNameOk) {}
            return $getNameOk;
        }
        if (!empty($request['birthdate'])) {
            $getBirthdate = $customer->findPeopleByName($request['birthdate']);
            foreach ($getBirthdate as $key => $getBirthdateOk) {}
            return $getBirthdateOk;
        }
        
       
       $getAllCustomer = $customer->allcustomer();
       if(count($getAllCustomer)== 0 )return 'Nenhum Cliente Cadastrado';
       return $getAllCustomer;
    }

    public function store(Request $request)
    {
        

        $customer = new Customer;

        $existCode = $customer->findCustomerByCPF($request['cpf']);
        $existName = $customer->findCustomerByName($request['name']);
        if (count($existCode) >= 1)return 'CPF ja exite';
        if (count($existName) >= 1)return 'Nome ja exite';
            
        try{
        $validate = $this->validate(
        $request, ['cpf' => 'cpf']);
        }catch( \Illuminate\Validation\ValidationException $e ){
        return 'CPF Invalido';
        }

        $customer->createCustomer($request->all());
        
        return 'Cadastrado com sucesso';
    }

    public function show($id)
    {
        $customer = new Customer();
        $show = $customer->findCustomerById($id);
        if (is_null($show)) return 'Cliente nao existe';
        
        return $customer->findCustomerById($id);
    }

    public function update(Request $request, $id)
    {
        $customer = new Customer;
        $find = $customer->findCustomerById($id);
        if (is_null($find)) return 'Cliente nao existe';
         
        $customer->updateCustomer($request->all(), $find->id);

        return 'Atualizado com sucesso'; 
    }

    public function destroy($id)
    {
        $customer = new Customer;
        $find = $customer->findCustomerById($id);
        if (is_null($find)) return 'Cliente nao existe';
        $customer->deleteCustomer($id);
        return 'Deletado com sucesso'; 
    }
}
