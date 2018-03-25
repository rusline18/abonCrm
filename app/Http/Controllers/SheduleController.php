<?php

namespace Growth\Http\Controllers;

use Growth\Shedule;
use Illuminate\Http\Request;

class SheduleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('shedule.index', ['title' => 'Расписание']);
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
     * @return Shedule
     */
    public function store(Request $request)
    {

    }

    /**
     * Display the specified resource.
     *
     * @param  \Growth\Shedule  $shedule
     * @return \Illuminate\Http\Response
     */
    public function show(Shedule $shedule)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \Growth\Shedule  $shedule
     * @return \Illuminate\Http\Response
     */
    public function edit(Shedule $shedule)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Growth\Shedule  $shedule
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Shedule $shedule)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Growth\Shedule  $shedule
     * @return \Illuminate\Http\Response
     */
    public function destroy(Shedule $shedule)
    {
        //
    }
}
