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
        $reservations = Reservation::where('archive', 0)->get();
        return view('Admin._reservations.reservationsIndex', ['reservations' => $reservations]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexArchive()
    {
        $reservations = Reservation::where('archive', 1)->get();
        return view('Admin._reservations.reservationsArchiveIndex', ['reservations' => $reservations]);
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
            'deposit' => $request->get('deposit'),
            'currency' => $request->get('currency')
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
        $reservation = Reservation::find($id);
        return view('Admin._reservations.reservationShow', ['reservation' => $reservation]);
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
     * Archived specified reservations
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function archive(Request $request)
    {
        Reservation::whereIn('id', array_values($request->get('archive')))
            ->update(['archive' => 1]);
        return redirect()->back();
    }


}