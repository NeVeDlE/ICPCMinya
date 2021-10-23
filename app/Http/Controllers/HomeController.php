<?php

namespace App\Http\Controllers;

use App\Models\TrainingPage;
use Illuminate\Http\Request;

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
        $trainings=TrainingPage::paginate(20);
        return view('Admin_pages.Requests.Requests',compact('trainings'));
    }
}
