<?php

namespace Growth\Http\Controllers;

use Growth\Branch;
use Growth\Room;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BranchController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $arr = [];
        $branch = Branch::where('user_id', Auth::user()->id)->get();
        foreach ($branch as $value){
            $rooms = Branch::find($value->id)->rooms()->get();
            foreach ($rooms as $room){
                $arr[$value->id]['name'] = $value->name;
                $arr[$value->id]['address'] = $value->city.' ул.'.$value->street.' д.'.$value->build.' оф.'.$value->appartament;
                $arr[$value->id]['room'][$room->id] = $room->name;
            }
        }
        return view('branch.index', ['title' => 'Филиалы', 'branchs' => collect($arr)]);
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
     * @return Branch
     */
    public function store(Request $request)
    {
        $arr = [];
        $branch = new Branch();
        $branch->fill($request->all());
        $branch->save();
        foreach($request->input('room') as $value){
            $room = new Room();
            $room->branch_id = $branch->id;
            $room->name = $value;
            $room->user_id = $request->input('user_id');
            $room->save();
            $arr[] = ['id' => $room->id, 'name' => $room->name];
        }
        $branch->rooms = $arr;
        return $branch;
    }

    /**
     * Display the specified resource.
     *
     * @param  \Growth\Branch  $branch
     * @return \Illuminate\Http\Response
     */
    public function show(Branch $branch)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \Growth\Branch  $branch
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $branchArr = [];
        $branch = Branch::find($id);
        $branchArr['branch'] = $branch;
        $branchArr['rooms'] = $branch->rooms()->get();
        return view('branch.update', compact('branchArr'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $arr = [];
        $branch = Branch::find($id);
        $branch->fill($request->all());
        $branch->save();
        Room::where('branch_id', $id)->delete();
        foreach($request->input('room') as $value){
            $room = new Room();
            $room->branch_id = $branch->id;
            $room->name = $value;
            $room->user_id = $request->input('user_id');
            $room->save();
            $arr[] = $room;
        }
        $branch->rooms = $arr;
        return $branch;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Growth\Branch $branch
     * @return int
     * @throws \Exception
     */
    public function destroy($id)
    {
        return Branch::destroy($id);
    }

    /**
     * Выводит список всех комнат в данном филиале
     * @param Branch $branch
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function rooms($id)
    {
        return Branch::find($id)->rooms()->get();
    }
}
