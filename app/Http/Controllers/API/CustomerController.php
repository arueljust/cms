<?php

namespace App\Http\Controllers\API;

use App\Models\Customer;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $customer = Customer::paginate(10);
        return response()->json([
            // 'status'=> 1,
            // 'message'=> 'GET METHOD',
            'data' => $customer,
        ]);
    }

    // /**
    //  * Show the form for creating a new resource.
    //  *
    //  * @return \Illuminate\Http\Response
    //  */
    // // public function create()
    // // {
    //     //
    // }

    // /**
    //  * Store a newly created resource in storage.
    //  *
    //  * @param  \Illuminate\Http\Request  $request
    //  * @return \Illuminate\Http\Response
    //  */
    // public function store(Request $request)
    // {
    //     $customer = Customer::create([
    //         'name' => $request->name,
    //         'number' => $request->number,
    //         'info' => $request->info,

    //     ]);

    //     return response()->json([
    //         'data' => $customer
    //     ]);
    // }

    // /**
    //  * Display the specified resource.
    //  *
    //  * @param  \App\Models\Customer  $customer
    //  * @return \Illuminate\Http\Response
    //  */
    // public function show(Customer $customer)
    // {
    //     return response()->json([
    //         'data' => $customer
    //     ]);
    // }

    // /**
    //  * Show the form for editing the specified resource.
    //  *
    //  * @param  \App\Models\Customer  $customer
    //  * @return \Illuminate\Http\Response
    //  */
    // public function edit(Customer $customer)
    // {
    //     //
    // }

    // /**
    //  * Update the specified resource in storage.
    //  *
    //  * @param  \Illuminate\Http\Request  $request
    //  * @param  \App\Models\Customer  $customer
    //  * @return \Illuminate\Http\Response
    //  */
    // public function update(Request $request, Customer $customer)
    // {
    //     $customer->name = $request->name;
    //     $customer->number = $request->number;
    //     $customer->info = $request->info;

    //     $customer->save();

    //     return response()->json([
    //         'data' => $customer
    //     ]);
    // }

    // /**
    //  * Remove the specified resource from storage.
    //  *
    //  * @param  \App\Models\Customer  $customer
    //  * @return \Illuminate\Http\Response
    //  */
    // public function destroy(Customer $customer)
    // {
    //     $customer->delete();
    //     return response()->json([
    //         'message'=>'Data Customer Deleted'
    //     ],204);
    // }

}
