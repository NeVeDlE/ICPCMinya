<?php

namespace App\Http\Controllers;

use App\Models\EventsPage;
use App\Models\Topics;
use Illuminate\Http\Request;

class TopicsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $topics=Topics::paginate(20);
        return view('Admin_pages.topics',compact('topics'));
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
            'name' => 'required','unique',
        ]);
        Topics::create([
            'name'=>$request->name,
        ]);
        session()->flash('Add', 'Topic Added');
        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Topics  $topics
     * @return \Illuminate\Http\Response
     */
    public function show(Topics $topics)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Topics  $topics
     * @return \Illuminate\Http\Response
     */
    public function edit(Topics $topics)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Topics  $topics
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        //
        $this->validate($request, [
            'name' => 'required',
        ]);
        $old = Topics::where('id', $request->id)->first();
        $old->update([
            'name' => $request->name,
        ]);
        session()->flash('Edit', 'Topic Edited');
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Topics  $topics
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        //
        $topic=Topics::where('id',$request->id)->first();

        $topic->delete();
        session()->flash('Delete', 'Topic Deleted');
        return back();
    }
}
