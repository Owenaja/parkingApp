<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ParkingSlot;

class ParkingSlotController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $parkingslots = ParkingSlot::latest()->get();
  
        return view('parkingslots.index',compact('parkingslots'))
        ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('parkingslots.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'name' => 'required',
            'location' => 'required'
          ]);
      
        $parkingslots= new ParkingSlot();
        $parkingslots->name = $request->name;
        $parkingslots->location = $request->location;
        $parkingslots->status = $request->status;
        $parkingslots->save();
      
        return redirect()->route('parkingslots.index')
        ->with('success','Slot Parkir berhasil dibuat!.');
  
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
    public function destroy(ParkingSlot $parkingslot)
    {
        $parkingslot->delete();
  
        return redirect()->route('parkingslots.index')
                        ->with('success','Slot Parkir berhasil dihapus!');
    }
}
