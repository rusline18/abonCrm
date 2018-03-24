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
        $arr = [];
        $directions = Direction::where('id_user', Auth::user()->id)->get();
        foreach ($directions as $value){
            $execute = Direction::find($value->id)->executes()->get();
            foreach ($execute as $key => $item){
                $arr[$value->id]['name'] = $value->name;
                $arr[$value->id]['execute'][$item->id]['name'] = $item->name;
                $arr[$value->id]['execute'][$item->id]['last_name'] = $item->name;

            }
        }

        $execute = Execute::select(['id', 'last_name', 'name'])->where('id_user', Auth::user()->id)->get();
        return view('direction.index', [
            'title' => 'Направление',
            'execute' => $execute,
            'directions' => $directions,
            'arr' => $arr
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
        foreach ($request->input('execute') as $value){
            $direction->executes()->attach($value);
        }
        $execute = Direction::find($direction->id)->executes()->get();
        $direction->execute = $execute;
        return $direction;
    }

    /**
     * Display the specified resource.
     *
     * @param  \Growth\Direction  $direction
     * @return \Illuminate\Http\Response
     */
    public function show(Direction $direction)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \Growth\Direction  $direction
     * @return \Illuminate\Http\Response
     */
    public function edit(Direction $direction)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Growth\Direction  $direction
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Direction $direction)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Growth\Direction  $direction
     * @return int
     */
    public function destroy($id)
    {
        return Direction::destroy($id);
    }
}
