<?php

namespace Growth\Http\Controllers;

use Growth\Exectue_direction;
use Growth\Execute;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ExecuteController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $executer = DB::table('execute')->where('id_user', Auth::user()->id)->get();
        return view('execute.index', ['title' => 'Преподаватели', 'executer' => $executer]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('execute.create', ['title' => 'Создание преподавателя']);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return Execute
     */
    public function store(Request $request)
    {
        $add = new Execute();
        $add->fill($request->all());
        $add->save();
        return $add;
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
        return view('execute.create', ['execute' => Execute::find($id)]);
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
        $execute = Execute::find($id);
        $execute->last_name = $request->input('last_name');
        $execute->name = $request->input('name');
        $execute->phone = $request->input('phone');
        $execute->email = $request->input('email');
        $execute->save();
        return $execute;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return int
     */
    public function destroy($id)
    {
        return Execute::destroy($id);
    }

    public function executeDestroy($id)
    {
        return DB::table('execute_direction')->where('execute_id', $id)->delete();

    }
}
