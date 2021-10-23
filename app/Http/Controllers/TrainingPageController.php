<?php

namespace App\Http\Controllers;

use App\Models\AboutPage;
use App\Models\Topics;
use App\Models\TrainingPage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class TrainingPageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $topics=Topics::paginate(10, ['*'], 'topics');
        $trainings=TrainingPage::paginate(10, ['*'], 'trainings');
        $members = AboutPage::paginate(20, ['*'], 'members');
        return view('Admin_pages.training_page', compact('members','trainings','topics'));
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
        //

        $this->validate($request, [
            'description' => 'required',
            'name' => 'required',
            'mentor' => 'required',
            'tag' => 'required',
            'topics' => 'required',
            'from' => 'required',
            'to' => 'required',
            'img' => 'required|image|mimes:jpg,png,jpeg|max:2048',
        ]);
        $ex = $request->img->getClientOriginalExtension();
        $img_name = time() . '.' . $ex;
        $request->img->move(public_path('Trainings'), $img_name);
        TrainingPage::create([
            'name' => $request->name,
            'mentor' => $request->mentor,
            'tag' => $request->tag,
            'topics' => $request->topics,
            'from' => $request->from,
            'to' => $request->to,
            'description' => $request->description,
            "img" => $img_name,
        ]);
        session()->flash('Add', 'Training Added');
        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\TrainingPage  $trainingPage
     * @return \Illuminate\Http\Response
     */
    public function show(TrainingPage $trainingPage)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\TrainingPage  $trainingPage
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
        //

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\TrainingPage  $trainingPage
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        //

        $this->validate($request, [
            'description' => 'required',
            'name' => 'required',
            'mentor' => 'required',
            'tag' => 'required',
            'topics' => 'required',
            'from' => 'required',
            'to' => 'required',
            'img' => 'image|mimes:jpg,png,jpeg|max:2048',
        ]);
        $old = TrainingPage::where('id', $request->id)->first();
        $bol = 0;
        if ($old['img'] == $request['img'] || $request['img'] == null) $bol = 0;
        else $bol++;

        $img_name = $old['img'];

        if ($bol > 0) {
            Storage::disk('public_uploads')->delete($old->img);
            $ex = $request->img->getClientOriginalExtension();
            $img_name = time() . '.' . $ex;
            $request->img->move(public_path('Trainings'), $img_name);
        }

        $old->update([
            'name' => $request->name,
            'mentor' => $request->mentor,
            'tag' => $request->tag,
            'topics' => $request->topics,
            'from' => $request->from,
            'to' => $request->to,
            'description' => $request->description,
            "img" => $img_name,
        ]);
        session()->flash('Edit', 'Training Edited');
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\TrainingPage  $trainingPage
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        //
        $training=TrainingPage::where('id',$request->id)->first();
        Storage::disk('training')->delete($training->img);
        $training->delete();
        session()->flash('Delete', 'Training Deleted');
        return back();

    }
}
