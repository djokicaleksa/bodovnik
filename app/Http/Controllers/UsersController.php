<?php

namespace App\Http\Controllers;

use App\Activity;
use App\Mail\UserCreated;
use App\Team;
use App\User;
use App\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class UsersController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin', ['only' => ['store', 'destroy', 'edit', 'update', 'create']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all();
        $route = "Članovi";
        return view('users.index', compact('users', 'route'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $teams = Team::pluck('name', 'id');
        $route = "Novi član";
        $roles = Role::pluck('name', 'id');

        return view('users.create', compact('user', 'route', 'teams', 'roles'));

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
//        $input['image'] = 'storage/user.png';
        $password = rand(pow(10, 6), pow(10, 7)-1);
        $input['password'] = Hash::make($password);
        $user = User::create($input);
        Mail::to($user->email)->send(new UserCreated($user->email, $password));
        return redirect('users/'.$user->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::findOrFail($id);
        $teams = Team::pluck('name', 'id');
        $activities = Activity::pluck('name', 'id');
        $route = $user->name;
        $roles = Role::pluck('name', 'id');
        return view('users.show', compact('user', 'route', 'activities', 'teams', 'roles'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        $user = User::findOrFail($id);
        if($file = $request->file('image')) {
            $file_name = time() . $file->getClientOriginalName();
            $file->move(public_path('/images'), $file_name);
            $image = '/images/' . $file_name;
            $input['image'] =  $image;
        }
        $user->update($input);

        return redirect()->back();

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        return redirect('/users');
    }

    public function userActivityStore(Request $request)
    {
        $user = User::findOrFail($request->input('user'));
        $user->activities()->attach($request->input('activity'));
        return redirect('/users/' . $user->id);
    }
}
