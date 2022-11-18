<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Bank;
use Illuminate\Http\Request;

class BankController extends Controller
{
    public $customer;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $bank = Bank::paginate(10);
        return response()->json([
            'status'=> 1,
            'message'=> 'GET METHOD',
            'data' => $bank,
            'account'=>[$this->customer],

        ]);

    }

    // /**
    //  * Show the form for creating a new resource.
    //  *
    //  * @return \Illuminate\Http\Response
    //  */
    // public function create()
    // {
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
    //     $bank = Bank::create([
    //         'name' => $request->name,
    //         'number' => $request->number,
    //         'info' => $request->info,

    //     ]);

    //     return response()->json([
    //         'data' => $bank
    //     ]);
    // }

    // /**
    //  * Display the specified resource.
    //  *
    //  * @param  \App\Models\Customer  $bank
    //  * @return \Illuminate\Http\Response
    //  */
    // public function show(Bank $bank)
    // {
    //     return response()->json([
    //         'data' => $bank
    //     ]);
    // }

    // /**
    //  * Show the form for editing the specified resource.
    //  *
    //  * @param  \App\Models\Customer  $bank
    //  * @return \Illuminate\Http\Response
    //  */
    // public function edit(Bank $bank)
    // {
    //     //
    // }

    // /**
    //  * Update the specified resource in storage.
    //  *
    //  * @param  \Illuminate\Http\Request  $request
    //  * @param  \App\Models\Customer  $bank
    //  * @return \Illuminate\Http\Response
    //  */
    // public function update(Request $request, Bank $bank)
    // {
    //     $bank->name = $request->name;
    //     $bank->number = $request->number;
    //     $bank->info = $request->info;

    //     $bank->save();

    //     return response()->json([
    //         'data' => $bank
    //     ]);
    // }

    // /**
    //  * Remove the specified resource from storage.
    //  *
    //  * @param  \App\Models\Bank  $bank
    //  * @return \Illuminate\Http\Response
    //  */
    // public function destroy(Bank $bank)
    // {
    //     $bank->delete();
    //     return response()->json([
    //         'message'=>'Data Customer Deleted'
    //     ],204);
    // }

}
