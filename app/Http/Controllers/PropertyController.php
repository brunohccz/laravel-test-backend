<?php

namespace App\Http\Controllers;

use App\Http\Requests\PropertyStoreRequest;
use App\Http\Requests\PropertyUpdateRequest;
use App\Http\Resources\PropertyResource;
use App\Property;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class PropertyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index()
    {
        $properties = Property::all();

        return PropertyResource::collection($properties);
    }

    /**
     * Store a newly created resource in storage.
     * @param PropertyStoreRequest $request
     * @return PropertyResource
     */
    public function store(PropertyStoreRequest $request)
    {
        $property = Property::create($request->validated());

        $property->address()->create($request->address);

        foreach($request->features as $feature) {
            $property->features()->create([
              'property_type_id' => $feature['type'],
              'value'            => $feature['value']
            ]);
        }

        return new PropertyResource($property->fresh());
    }

    /**
     * Display the specified resource.
     * @param \App\Property $property
     * @return PropertyResource
     */
    public function show(Property $property)
    {
        return new PropertyResource($property);
    }

    /**
     * Update the specified resource in storage.
     * @param PropertyUpdateRequest $request
     * @param \App\Property $property
     * @return PropertyResource
     */
    public function update(PropertyUpdateRequest $request, Property $property)
    {
        $property->update($request->validated());
        $property->address()->update($request->address);

        return new PropertyResource($property->fresh());
    }

    /**
     * Remove the specified resource from storage.
     * @param \App\Property $property
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function destroy(Property $property)
    {
        $property->delete();

        return response()->json([], Response::HTTP_OK);
    }
}
