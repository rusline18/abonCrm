<?php

namespace Growth\Http\Controllers;

use Growth\Direction;
use Growth\Execute;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DirectionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $directions = Direction::where('user_id', Auth::user()->id)->get();
        return view('direction.index', [
            'title' => 'Направление',
            'directions' => $directions,
        ]);
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
     * @return Direction
     */
    public function store(Request $request)
    {
        $direction = new Direction();
        $direction->fill($request->all());
        $direction->save();
        return $direction;
    }

    /**
     * Display the specified resource.
     *
     * @param  \Growth\Direction  $direction
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $direction = Direction::find($id);
        return view('direction.update', compact('direction'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Growth\Direction  $direction
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $direction = Direction::find($id);
        $direction->fill($request->all());
        $direction->save();
        return $direction;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param $id
     * @return int
     * @throws \Exception
     */
    public function destroy($id)
    {
        $direction = Direction::find($id);
        $direction->executes()->detach();
        $direction->delete();
        return $direction;
    }

    /**
     * Удаляет преподаватель из направление
     * @param Request $request
     * @param $id
     * @return mixed|static
     */
    public function executeDestroy(Request $request, $id){
        $direction = Direction::find($id);
        $direction->executes()->detach($request->all());
        return $direction;
    }
}
