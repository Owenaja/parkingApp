<?php

namespace App\Http\Controllers;

use App\Customer;
use App\WalletTransaction;
use Illuminate\Http\Request;

class TopupController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $wallettransactions = WalletTransaction::latest()->get();

        return view('topups.index', compact('wallettransactions'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $customers = Customer::all();
        return view('topups.create', compact('customers'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'customer_id' => 'required',
            'balance' => 'required',
        ]);

        $wallettransaction = new WalletTransaction();
        $wallettransaction->user_id = $request->user_id;
        $wallettransaction->customer_id = $request->customer_id;
        $wallettransaction->date = new \DateTime();
        $wallettransaction->type = $request->type;
        $wallettransaction->balance = $request->balance;
        $wallettransaction->customer->balance += $request->balance;
        $wallettransaction->save();
        $wallettransaction->customer->save();


        return redirect()->route('topups.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(WalletTransaction $wallettransaction)
    {
        $wallettransaction->delete();

        return redirect()->route('topups.index')
            ->with('success', 'Transaksi berhasil dihapus!');
    }
}
