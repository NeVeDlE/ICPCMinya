<?php

namespace App\Http\Controllers;


use App\Models\AboutPage;
use App\Models\EventsPage;
use App\Models\TrainingPage;
use Illuminate\Http\Request;

class UserPagesController extends Controller
{
    //
    public function about()
    {
        $members=AboutPage::all();
       return view('User_pages.about',compact('members'));
    }

    public function contact()
    {
        return view('User_pages.contact');
    }

    public function details($id)
    {
        $training=TrainingPage::where('id',$id)->first();
        return view('User_pages.training-details',compact('training'));
    }

    public function training()
    {
        $trainings=TrainingPage::paginate(20);
        return view('User_pages.training',compact('trainings'));
    }

    public function events()
    {
        $events=EventsPage::paginate(20);
        return view('User_pages.events',compact('events'));
    }

    public function pricing()
    {
        return view('User_pages.pricing');
    }

    public function trainers()
    {
        return view('User_pages.trainers');
    }
}
