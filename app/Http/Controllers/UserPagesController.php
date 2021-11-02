<?php

namespace App\Http\Controllers;


use App\Models\AboutPage;
use App\Models\EventsPage;
use App\Models\Requests;
use App\Models\TrainingPage;
use Illuminate\Http\Request;

class UserPagesController extends Controller
{
    //
    public function about()
    {
        $count = AboutPage::count();
        $members = AboutPage::all();
        return view('User_pages.about', compact('members', 'count'));
    }

    public function details($id)
    {
        $training = TrainingPage::where('id', $id)->first();
        return view('User_pages.training-details', compact('training'));
    }

    public function training()
    {
        $count = TrainingPage::count();
        $trainings = TrainingPage::paginate(20);
        return view('User_pages.training', compact('trainings', 'count'));
    }

    public function events()
    {
        $count = EventsPage::count();
        $events = EventsPage::paginate(20);
        return view('User_pages.events', compact('events', 'count'));
    }

    public function enroll(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'phone' => 'numeric|required|digits:11',
            'national' => 'numeric|digits:14|required',
            'email' => 'required|email',
            'university' => 'required',
            'faculty' => 'required',
            'handle' => 'required',
            'training' => 'numeric|required',
            'year' => 'numeric|required',

        ]);
        $nationals = Requests::where('national', $request->national)->get();
        $emails = Requests::where('email', $request->email)->get();
        $phones = Requests::where('phone', $request->phone)->get();

        foreach ($nationals as $national) {
            if ($national->training == $request->training ) {
                return back()->withErrors('National ID already registered in this training');
            }
        }
        foreach ($emails as $email) {
            if ($email->training == $request->training) {
                return back()->withErrors('Email already registered in this training');
            }
        }
        foreach ($phones as $phone) {
            if ($phone->training == $request->training) {
                return back()->withErrors('This Phone Number already registered in this training');
            }
        }
        Requests::create([
            'name' => $request->name,
            'phone' => $request->phone,
            'national' => $request->national,
            'email' => $request->email,
            'university' => $request->university,
            'faculty' => $request->faculty,
            'handle' => $request->handle,
            'training' => $request->training,
            'year' => $request->year,
            'status' => 2,
        ]);
        session()->flash('Add', 'Registration Done');
        return back();
    }


}
