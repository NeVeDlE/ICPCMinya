<?php

namespace App\Http\Controllers;

use App\Models\EventsPage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class EventsPageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $events=EventsPage::paginate(10);
        return view('Admin_pages.events_page',compact('events'));
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
            'date' => 'required',
            'img' => 'required|image|mimes:jpg,png,jpeg|max:2048',
        ]);
        $ex = $request->img->getClientOriginalExtension();
        $img_name = time() . '.' . $ex;
        $request->img->move(public_path('Event'), $img_name);
        EventsPage::create([
            'name' => $request->name,
            'date' => $request->date,
            'description' => $request->description,
            "img" => $img_name,
        ]);
        session()->flash('Add', 'Event Added');
        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\EventsPage  $eventsPage
     * @return \Illuminate\Http\Response
     */
    public function show(EventsPage $eventsPage)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\EventsPage  $eventsPage
     * @return \Illuminate\Http\Response
     */
    public function edit(EventsPage $eventsPage)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\EventsPage  $eventsPage
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        //

        $this->validate($request, [
            'description' => 'required',
            'name' => 'required',
            'date' => 'required',
            'img' => 'image|mimes:jpg,png,jpeg|max:2048',
        ]);

        $old = EventsPage::where('id', $request->id)->first();
        $bol = 0;
        if ($old['img'] == $request['img'] || $request['img'] == null) $bol = 0;
        else $bol++;
        $img_name = $old['img'];
        if ($bol > 0) {
            Storage::disk('event')->delete($old->img);
            $ex = $request->img->getClientOriginalExtension();
            $img_name = time() . '.' . $ex;
            $request->img->move(public_path('Event'), $img_name);
        }

        $old->update([
            'name' => $request->name,
            'date' => $request->date,
            'description' => $request->description,
            "img" => $img_name,
        ]);
        session()->flash('Edit', 'Event Edited');
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\EventsPage  $eventsPage
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        //

        $event=EventsPage::where('id',$request->id)->first();
        Storage::disk('event')->delete($event->img);
        $event->delete();
        session()->flash('Delete', 'Event Deleted');
        return back();
    }
}
