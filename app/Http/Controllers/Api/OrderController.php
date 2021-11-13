<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\OrderResource;
use App\Models\Order;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return new JsonResponse(['data' => Order::all()->map(function($item){
            return new OrderResource($item);
        })]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'client_name' => ['required', 'string', 'max:255'],
            'total' => ['required', 'numeric'],
            'delivery_address' => ['required', 'string', 'max:1000']
        ]);

        if ($validator->fails()) {
            return new JsonResponse(array_merge(
                ['result' => 'error'], 
                ['errors' => $validator->errors()]
            ), 400);
        }

        $validated = $validator->validated();
        
        $model = new Order;
        $model->client_name = $validated['client_name'];
        $model->total = $validated['total'];
        $model->delivery_address = $validated['delivery_address'];
        $model->save();

        $response['result'] = 'success';
        $response['data'] = new OrderResource($model->fresh());
        return new JsonResponse($response);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return new JsonResponse(new OrderResource(Order::findOrFail($id)));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'client_name' => ['string', 'max:255'],
            'total' => ['numeric'],
            'delivery_address' => ['string', 'max:1000']
        ]);

        if ($validator->fails()) {
            return new JsonResponse(array_merge(
                ['result' => 'error'], 
                ['errors' => $validator->errors()]
            ), 400);
        }

        $validated = $validator->validated();
        
        $model = Order::findOrFail($id);

        $model->update($validated);

        $response['result'] = 'success';
        $response['data'] = new OrderResource($model->fresh());
        return new JsonResponse($response);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (Order::findOrFail($id)->delete()) {
            return new JsonResponse(['result' => 'success']);
        }
    }
}
