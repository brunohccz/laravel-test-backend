<?php

namespace App\Http\Controllers;

use App\Customer;
use App\Http\Requests\CustomerStoreRequest;
use App\Http\Requests\CustomerUpdateRequest;
use App\Http\Resources\CustomerResource;
use Illuminate\Http\Response;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index()
    {
        $customers = Customer::all();

        return CustomerResource::collection($customers);
    }

    /**
     * Store a newly created resource in storage.
     * @param CustomerStoreRequest $request
     * @return CustomerResource
     */
    public function store(CustomerStoreRequest $request)
    {
        $customer = Customer::create($request->validated());

        return new CustomerResource($customer);
    }

    /**
     * Display the specified resource.
     * @param \App\Customer $customer
     * @return CustomerResource
     */
    public function show(Customer $customer)
    {
        return new CustomerResource($customer);
    }

    /**
     * Update the specified resource in storage.
     * @param CustomerUpdateRequest $request
     * @param \App\Customer $customer
     * @return void
     */
    public function update(CustomerUpdateRequest $request, Customer $customer)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     * @param \App\Customer $customer
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function destroy(Customer $customer)
    {
        $customer->delete();

        return response()->json([], Response::HTTP_OK);
    }
}
