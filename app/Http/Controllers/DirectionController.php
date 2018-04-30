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
        $directions = Direction::where('user_id', Auth::user()->id)->get();
        foreach ($directions as $key => $value){
            $execute = Direction::find($value->id)->executes()->get();
            foreach ($execute as $item){
                $arr[$value->id]['name'] = $value->name;
                $arr[$value->id]['execute'][$item->id]['name'] = $item->last_name.' '.$item->name;
            }
        }

        $execute = Execute::select(['id', 'last_name', 'name'])->where('user_id', Auth::user()->id)->get();
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
        $executes = Execute::select('id', 'last_name', 'name')->where('user_id', Auth::user()->id)->get();
        $directionExecute = [];
        $direction = Direction::find($id);
        $directionExecute['direction'] = $direction;
        $directionExecute['executes'] = $direction->executes()->select('execute_id')->get();
        $directionExecute['teacher'] = $executes;
        foreach ($executes as $key => $execute){
            foreach ($directionExecute['executes'] as $checked){
                if ($execute->id == $checked->execute_id){
                    $directionExecute['teacher'][$key]['ckecked'] = true;
                }
            }
        }
        return view('direction.update', compact('directionExecute'));
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
        $direction->executes()->detach();
        foreach ($request->input('execute') as $execute){
            $direction->executes()->attach($execute);
        }
        $direction->execute = $direction->executes()->get();
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
