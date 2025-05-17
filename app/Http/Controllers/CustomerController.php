<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Http\Requests\StoreCustomerRequest;
use App\Http\Requests\UpdateCustomerRequest;

use function Illuminate\Log\log;

class CustomerController extends Controller
{
    public function index()
    {
        return Customer::all();
    }

    public function store(StoreCustomerRequest $request)
    {
        try {
            $validated = $request->validated();
            $customer = Customer::create($validated);
        
            return response()->json([
                'message' => 'Cliente criado com sucesso.',
                'data' => $customer,
            ], 201);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'message' => 'Erro de validação.',
                'errors' => $e->errors(),
            ], 422);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Erro ao criar cliente.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    public function show(Customer $customer)
    {
        return $customer;
    }

    public function update(UpdateCustomerRequest $request, Customer $customer)
    {
        $customer->update($request->validated());
        return response()->json($customer);
    }

    public function destroy(Customer $customer)
    {
        $customer->delete();
        return response()->json(null, 204);
    }
}
