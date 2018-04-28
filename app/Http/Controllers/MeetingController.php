<?php

namespace App\Http\Controllers;

use App\Meetings;
use App\Team;
use Illuminate\Http\Request;

class MeetingController extends Controller
{

    public function __construct()
    {
        $this->middleware('admin', ['only' => ['store', 'destroy', 'edit', 'update']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $route = "Sastanci";
        $allteams = Team::all();
        $teams = Team::pluck('name', 'id');
        return view('meetings.index', compact('teams', 'route', 'allteams'));
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
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $input = $request->all();
        $meeting = Meetings::create($input);
        foreach ($input['users'] as $user){
            $meeting->users()->attach($user);
        }
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $meeting = Meetings::findOrFail($id);
        $route = $meeting->name;
        return view('meetings.show', compact('meeting', 'route'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $meeting = Meetings::findOrFail($id);
        $route = $meeting->name;
        return view('meetings.edit', compact('meeting','route'));
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
        $input = $request->all();
        $meeting = Meetings::findOrFail($id);
        $meeting->users()->detach();

        $meeting->update($input);
        foreach ($input['users'] as $user){
            $meeting->users()->attach($user);
        }

        return redirect('meetings/' . $meeting->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Meetings::findOrFail($id)->delete();
        return redirect()->back();
    }

    public function teamFeed(Request $request)
    {
        if($request->ajax()){
            $team = Team::findOrFail($request->input('team_id'));
            $data = array();
            $i = 0;
            foreach ($team->users as $user){
                $data[$i]['id'] = $user->id;
                $data[$i]['name'] = $user->name;
                $i++;
            }
            return response()->json($data);
        }
    }
}
