<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Task;
use App\User;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        //$hola = User::where('id', auth()->id())->get();
        $todasLasTareas = Task::all();
        foreach($todasLasTareas as $tarea){
            $nombre = User::find($tarea->user_id);
            $tarea->user_id =  $nombre->name;
        }
        return view('home',compact('todasLasTareas'));
    }
}
