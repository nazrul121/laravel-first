<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Doctor;
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
        $doctors = Doctor::latest()->paginate(5);
        return view('home',compact('doctors'));
    }
}
