<?php

namespace App\Http\Controllers;

use Validator;
use App\Customer;
use Illuminate\Http\Request;


class CustomerController extends Controller
{
    public function index(Request $request)
    {
        
        $customer = new Customer;
        if (!empty($request['cpf'])) {
            $getCpf = $customer->findCustomerByCPF($request['cpf']);
            if(count($getCpf) == 0) return 'CPF nao cadastrado';
            foreach ($getCpf as $key => $getCpfOk) {}
            return $getCpf;
        }
        if (!empty($request['name'])) {
            $getName = $customer->findCustomerByName($request['name']);
            if(count($getName) == 0) return 'Nome nao cadastrado';
            foreach ($getName as $key => $getNameOk) {}
            return $getName;
        }
        if (!empty($request['birthdate'])) {
            $getBirthdate = $customer->findCustomerByBirthdate($request['birthdate']);
            if(count($getBirthdate) == 0) return 'Nascimento  nao cadastrado';
            foreach ($getBirthdate as $key => $getBirthdateOk) {}
            return $getBirthdate;
        }
        
       
       $getAllCustomer = $customer->allcustomer();
       if(count($getAllCustomer)== 0 )return 'Nenhum Cliente Cadastrado';
       return $getAllCustomer;
    }

    public function store(Request $request)
    {
        
        if (empty($request->all()))return 'Informar campos para cadastar o cliente';
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
