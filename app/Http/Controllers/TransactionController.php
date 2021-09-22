<?php

namespace App\Http\Controllers;

use App\ParkingSlot;
use App\Transaction;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $transactions = Transaction::orderBy('id', 'asc')->get();

        return view('transactions.index', compact('transactions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $parkingslots = ParkingSlot::where('status', '=', '0')->orderBy(DB::raw('RAND()'))->first()->id;
        return view('transactions.create', compact('parkingslots'));
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
            'lisence_number' => 'required',
        ]);

        $transaction = new Transaction();
        $transaction->type = $request->type;
        $transaction->user_id = $request->user_id;
        $transaction->slot_id = $request->slot_id;
        $transaction->lisence_number = $request->lisence_number;
        $transaction->real_time_in = new \DateTime();
        $transaction->status = "0";
        $transaction->slot->status = "1";
        $transaction->save();
        $transaction->slot->save();


        return redirect()->route('generate', $transaction->id);
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
    public function destroy(Transaction $transaction)
    {
        $transaction->delete();

        return redirect()->route('transactions.index')
            ->with('success', 'Transaksi berhasil dihapus!');
    }

    public function generate($id)
    {
        $transaction = Transaction::findOrFail($id);
        $qrcode = QrCode::size(300)->generate($transaction->id);
        return view('transactions.qrcode', compact('qrcode'));
    }

    public function ajax($id)
    {
        //$data = Mahasiswa::all();
        $data = Transaction::where('id', $id)->first();
        //dd($data);

        //return response()->json($data, 200);
        return json_encode($data);
    }

    public function scanIn()
    {
        return view('enterance_ticket');
    }

    public function scanOut()
    {
        $exit = Carbon::parse(new \DateTime());
        return view('exit_ticket', compact('exit'));
    }

    public function scanInConfirm(Request $request)
    {
        DB::table('transactions')->where('id', $request->id)->update([
            'user_id' => $request->user_id,
            'real_time_in' => new \DateTime()
        ]);

        return redirect('/transactions');
    }

    public function scanOutConfirm(Request $request)
    {

        $transaction = Transaction::where('id', $request->id)->first();
        $transaction->slot->status = "0";
        $transaction->slot->save();
        $transaction->update([
            'real_time_out' => new \DateTime(),
            'status' => "1",
            'duration' => $request->duration,
            'total_price' => $request->total_price
        ]);
        
        return redirect('/transactions');
    }

    public function create_ticket()
    {
        $parkingslots = ParkingSlot::where('status', '=', '0')->orderBy(DB::raw('RAND()'))->first()->id;
        return view('customers.create_ticket', compact('parkingslots'));
    }

    public function store_ticket(Request $request)
    {
        $this->validate($request, [
            'lisence_number' => 'required',
            'duration' => 'required',
        ]);

        $amount = $request->duration * 4000;

        $transaction = new Transaction();
        $transaction->type = $request->type;
        $transaction->customer_id = $request->customer_id;
        $transaction->slot_id = $request->slot_id;
        $transaction->lisence_number = $request->lisence_number;
        $transaction->time_in = new \DateTime();
        $transaction->status = "0";
        $transaction->slot->status = "1";
        if ($transaction->customer->balance < $amount) {
            route('customer.create.ticket');
        } else {
            $transaction->customer->balance -= $amount;
            $transaction->save();
            $transaction->slot->save();
            $transaction->customer->save();

            return redirect()->route('generate_ticket', $transaction->id);
        }
    }

    public function generate_customer($id)
    {
        $transaction = Transaction::findOrFail($id);
        $qrcode = QrCode::size(300)->generate($transaction->id);
        $transaction = Transaction::where('id', '=', $id)->get();
        return view('customers.qrcode', compact('qrcode', 'transaction'));
    }
}
