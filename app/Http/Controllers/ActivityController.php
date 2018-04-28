<?php

namespace App\Http\Controllers;

use App\Activity;
use App\Team;
use Illuminate\Http\Request;

class ActivityController extends Controller
{

    public function __construct()
    {
        $this->middleware('admin', ['only' => ['store', 'destroy']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $activities = Activity::all();
        $route = "Aktivnosti";
        return view('activites.index', compact('activities', 'route'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $teams = Team::pluck('name', 'id');
        $route = "Nova aktivnost";
        return view('activites.create', compact('teams', 'route'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $input = $request->all();
        $input['points'] = $input['ispostovan_rok'] + $input['tacno_uradjen_zadatak'] + $input['u_potpunosti_odradjen_zadatak'] + $input['kvalitet'];
        Activity::create($input);
        return redirect('users/' . $input['user_id']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Activity  $activity
     * @return \Illuminate\Http\Response
     */
    public function show(Activity $activity)
    {
        $route = $activity->name;
        return view('activites.show', compact('activity', 'route'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Activity  $activity
     * @return \Illuminate\Http\Response
     */
    public function edit(Activity $activity)
    {
        $route = $activity->name . " Edit";
        $teams = Team::pluck('name', 'id');
        return view('activites.edit', compact('teams','activity', 'route'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Activity  $activity
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Activity $activity)
    {
        $input = $request->all();
        $activity->update($input);
        return redirect('/activities/' . $activity->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Activity  $activity
     * @return \Illuminate\Http\Response
     */
    public function destroy(Activity $activity)
    {
        $activity->delete();
        return redirect()->back();
    }

}
