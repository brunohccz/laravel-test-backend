<?php

namespace App\Http\Controllers;

use App\Contract;
use App\Http\Requests\ContractStoreRequest;
use App\Http\Resources\ContractResource;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ContractController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index()
    {
        $contracts = Contract::all();

        return ContractResource::collection($contracts);
    }

    /**
     * Store a newly created resource in storage.
     * @param ContractStoreRequest $request
     * @return \Illuminate\Http\JsonResponse|ContractResource
     */
    public function store(ContractStoreRequest $request)
    {
        if (Contract::where('property_id', $request->property)->exists()) {
            return response()->json(['message' => 'Property unavailable'], Response::HTTP_BAD_REQUEST);
        }

        $contract = Contract::create([
            'property_id' => $request->property,
            'customer_id' => $request->customer
        ]);

        return new ContractResource($contract);
    }

    /**
     * Display the specified resource.
     * @param  \App\Contract  $contract
     * @return ContractResource
     */
    public function show(Contract $contract)
    {
        return new ContractResource($contract);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Contract  $contract
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Contract $contract)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     * @param \App\Contract $contract
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function destroy(Contract $contract)
    {
        $contract->delete();

        return response()->json([], Response::HTTP_OK);
    }
}
