<?php

namespace App\Http\Controllers\Admin;

use App\Models\Customer;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Reservation;
use Carbon\Carbon;

class ReservationController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $reservations = Reservation::all();
        return view('Admin.Reservatons', ['reservations' => $reservations]);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param Customer $customer
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function store(Request $request, Customer $customer)
    {
        return $customer->reservations()->create([
            'unique_id' => md5(uniqid(rand(), true)),
            'date' => Carbon::now(),
            'total' => $request->get('total'),
            'deposit' => $request->get('deposit')
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $reseration = Reservation::find($id);
        return view('Admin.ReservationShow', ['reservation' => $reseration]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param integer $id
     * @param string $unique_id
     * @return Reservation
     */
    public function update(Request $request, $id, $unique_id)
    {
        $reservation = Reservation::where('id', $id)
            ->where('unique_id', $unique_id)->first();
        $reservation->update($request->all());
        return $reservation;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

}