<?php

namespace App\Http\Controllers;

use App\Http\Requests\PropertyFeatureTypeStoreRequest;
use App\Http\Resources\PropertyFeatureTypeResource;
use App\PropertyFeatureType;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class PropertyFeatureTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index()
    {
        $propertyFeatureTypes = PropertyFeatureType::all();

        return PropertyFeatureTypeResource::collection($propertyFeatureTypes);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     * @param PropertyFeatureTypeStoreRequest $request
     * @return PropertyFeatureTypeResource
     */
    public function store(PropertyFeatureTypeStoreRequest $request)
    {
        $propertyFeatureType = PropertyFeatureType::create($request->validated());

        return new PropertyFeatureTypeResource($propertyFeatureType);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\PropertyFeature  $propertyFeature
     * @return Response
     */
    public function show(PropertyFeature $propertyFeature)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\PropertyFeature  $propertyFeature
     * @return Response
     */
    public function edit(PropertyFeature $propertyFeature)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\PropertyFeature  $propertyFeature
     * @return Response
     */
    public function update(Request $request, PropertyFeature $propertyFeature)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\PropertyFeature  $propertyFeature
     * @return Response
     */
    public function destroy(PropertyFeature $propertyFeature)
    {
        //
    }
}
