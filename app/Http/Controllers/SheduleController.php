<?php

namespace Growth\Http\Controllers;

use Growth\Branch;
use Growth\Direction;
use Growth\Execute;
use Growth\Shedule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SheduleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user()->id;
        $arr = [];
        $branch = Branch::where('user_id', $user)->get();
        $direction = Direction::where('id_user', Auth::user()->id)->get();
        $execute = Execute::where('id_user', Auth::user()->id)->get();
        foreach ($branch as $key => $value){
            $room = Branch::find($value->id)->rooms()->get();
            foreach ($room as $index => $item){
                $arr[$key]['id'] = $value->id;
                $arr[$key]['name'] = $value->name;
                $arr[$key]['room'][$index] = $item->name;
            }
        }
        $date = ['hour' => ['8','9','10','11','12','13','14','15','16','17','18','19','20','21'], 'minute' => ['00','30']];
        $shedule = Shedule::where('user_id', $user)->get();
        return view('shedule.index', [
            'title' => 'Расписание',
            'shedule' => $shedule,
            'directions' => $direction,
            'executes' => $execute,
            'arr' => collect($arr),
            'date' => collect($date)
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
     * @return Shedule
     */
    public function store(Request $request)
    {
        $month = [1 => 'января', 'февраля', 'марта', 'апреля', 'мая', 'июня', 'июля', 'августа', 'сентября', 'октября', 'ноября', 'декабря'];
        $date = preg_split('/ /', $request->input('datetime'));
        $date[1] = array_search($date[1], $month);
        $date =  strtotime($date[2].'-'.$date[1].'-'.$date[0].' '.$date[3]);
        $shedule = new Shedule();
        $shedule->fill($request->all());
        $shedule->date = $date;
        $shedule->save();
        return $shedule;
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
