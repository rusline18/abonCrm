<?php

namespace Growth\Http\Controllers;

use Growth\Branch;
use Growth\Client;
use Growth\ConverDate;
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
    public function index(Request $request)
    {
        $user = Auth::user()->id;
        $arr = [];
        $filter = $request->input('filter');
        $branch = Branch::where('user_id', $user)->get();
        $direction = Direction::where('user_id', Auth::user()->id)->get();
        $execute = Execute::where('user_id', Auth::user()->id)->get();
        $clients = Client::where('user_id', Auth::user()->id)->get();
        $branchCheckout = $request->input('filter')['branch'] ? Branch::find($filter['branch']) : Branch::where('user_id', $user)->first();

        if ($filter['branch']){
            $room = $branchCheckout->rooms()->get();
            foreach ($room as $index => $item){
                $arr['id'] = $branchCheckout->id;
                $arr['name'] = $branchCheckout->name;
                $arr['room'][$index] = ['id' => $item->id, 'name' => $item->name];
            }
        } else {
            $room = Branch::find($branchCheckout->id)->rooms()->get();
            foreach ($room as $index => $item){
                $arr['id'] = $branchCheckout->id;
                $arr['name'] = $branchCheckout->name;
                $arr['room'][$index] = ['id' => $item->id, 'name' => $item->name];
            }
        }
        $date = ConverDate::date();
        if ($filter['date'] && $filter['date'] != null){
            $dateConvert = ConverDate::dateFormat($request->input('filter')['date']); // Конвертируем дату
            $shedule = Shedule::where('user_id', $user)
                ->with(['directions', 'clients', 'executes'])
                ->where('date', $dateConvert)
                ->get();
        } else {
            $shedule = Shedule::where('user_id', $user)
                ->with(['directions', 'clients', 'executes'])
                ->where('date', strtotime(date('Y-m-d')))
                ->get();
        }
        return view('shedule.index', [
            'title' => 'Расписание',
            'shedule' => $shedule,
            'branchs' => $branch,
            'directions' => $direction,
            'executes' => $execute,
            'clients' => $clients,
            'arr' => $arr,
            'date' => collect($date),
            'checkoutDate' => $filter['date'] ? date('d M Y', $dateConvert) : date('d M Y')
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
        $date = ConverDate::dateFormat($request->input('date'));
        $shedule = new Shedule();
        $shedule->fill($request->all());
        $shedule->date = $date;
        $shedule->save();
        foreach ($request->input('client') as $client){
            $shedule->clients()->attach($client);
        }
        return redirect()->action('SheduleController@index');
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
    public function edit($id)
    {
        $user = Auth::user()->id;
        $branch = Branch::where('user_id', $user)->get();
        $direction = Direction::where('user_id', Auth::user()->id)->get();
        $execute = Execute::where('user_id', Auth::user()->id)->get();
        $clients = Client::where('user_id', Auth::user()->id)->get();
        return view('shedule.update', compact('branch', 'direction', 'execute', 'clients'));
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
