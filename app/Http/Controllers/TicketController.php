<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Transaction;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class TicketController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $transactions = Transaction::latest()->get();

        return view('tickets.index', compact('transactions'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('tickets.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // $request->validate([
        //     'lisence_number' => 'required',
        //     'type' => 'required',
        // ]);

        // $transaction= new Transaction();
        // $transaction->lisence_number= $request['lisence_number'];
        // $transaction->type= $request['type'];
        // $transaction->time_in = new \DateTime();
        // // $transaction->status = "0";
        // $transaction->save();

        // return redirect()->route('tickets.index')
        //                 ->with('success','Transaction created successfully.');

        $this->validate($request, [
            'lisence_number' => 'required',
            'type' => 'required',
        ]);

        $transaction = new Transaction();
        $transaction->lisence_number = $request->lisence_number;
        $transaction->type = $request->type;
        $transaction->time_in = new \DateTime();
        $transaction->status = "0";
        $transaction->save();

        return redirect()->route('generate', $transaction->id);
    }

    public function generate($id)
    {
        $transaction = Transaction::findOrFail($id);
        $qrcode = QrCode::size(300)->generate($transaction->id);
        return view('tickets.qrcode', compact('qrcode'));
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
    public function destroy($id)
    {
        //
    }

    public function enteranceTicket()
    {
        return view('enterance_ticket');
    }

    public function exitTicket(Request $request)
    {
        $transactions = Transaction::when($request->keyword, function ($query) use ($request) {
            $query
                ->where('id', '=', "$request->keyword");
        });

        $transactions->appends($request->only('keyword'));

        return view('exit_ticket', ['transactions' => $transactions]);
    }


    // public function indesx(Request $request)
    // {
    //     $pagination  = 5;
    //     $articles    = Article::when($request->keyword, function ($query) use ($request) {
    //         $query
    //             ->where('title', 'like', "%{$request->keyword}%");
    //     })->orderBy('created_at', 'desc')->paginate($pagination);

    //     $articles->appends($request->only('keyword'));

    //     return view('articles.index', [
    //         'title'    => 'Articles',
    //         'articles' => $articles,
    //     ])->with('i', ($request->input('page', 1) - 1) * $pagination);
    // }
}
