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
        $count =AboutPage::count();
        $members=AboutPage::all();
       return view('User_pages.about',compact('members','count'));
    }

    public function details($id)
    {
        $training=TrainingPage::where('id',$id)->first();
        return view('User_pages.training-details',compact('training'));
    }

    public function training()
    {
        $count =TrainingPage::count();
        $trainings=TrainingPage::paginate(20);
        return view('User_pages.training',compact('trainings','count'));
    }

    public function events()
    {
        $count =EventsPage::count();
        $events=EventsPage::paginate(20);
        return view('User_pages.events',compact('events','count'));
    }


}
