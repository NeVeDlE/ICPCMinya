<?php

namespace App\Http\Controllers;

use App\Models\AboutPage;
use App\Models\TrainingPage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AboutPageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //

        $members = AboutPage::paginate(10);
        return view('Admin_pages.about_page', compact('members'));
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
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //

        $this->validate($request, [
            'description' => 'required',
            'name' => 'required',
            'job' => 'required',
            'img' => 'required|image|mimes:jpg,png,jpeg|max:2048',
        ]);
        $ex = $request->img->getClientOriginalExtension();
        $img_name = time() . '.' . $ex;
        $request->img->move(public_path('Members'), $img_name);
        AboutPage::create([
            'name' => $request->name,
            'job' => $request->job,
            'description' => $request->description,
            "img" => $img_name,
        ]);
        session()->flash('Add', 'Member Added');
        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\AboutPage $aboutPage
     * @return \Illuminate\Http\Response
     */
    public function show(AboutPage $aboutPage)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\AboutPage $aboutPage
     * @return \Illuminate\Http\Response
     */
    public function edit(AboutPage $aboutPage)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\AboutPage $aboutPage
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        //
        $this->validate($request, [
            'description' => 'required',
            'name' => 'required',
            'job' => 'required',
            'img' => 'image|mimes:jpg,png,jpeg|max:2048',
        ]);
        $old = AboutPage::where('id', $request->id)->first();
        $bol = 0;
        if ($old['img'] == $request['img'] || $request['img'] == null) $bol = 0;
        else $bol++;

        $img_name = $old['img'];

        if ($bol > 0) {
            Storage::disk('public_uploads')->delete($old->img);
            $ex = $request->img->getClientOriginalExtension();
            $img_name = time() . '.' . $ex;
            $request->img->move(public_path('Members'), $img_name);
        }

        $old->update([
            'name' => $request->name,
            'job' => $request->job,
            'description' => $request->description,
            "img" => $img_name,
        ]);
        session()->flash('Edit', 'Member Edited');
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\AboutPage $aboutPage
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        //
        $member=AboutPage::where('id',$request->id)->first();
        Storage::disk('public_uploads')->delete($member->img);
        $member->delete();
        session()->flash('Delete', 'Member Deleted');
        return back();
    }
}
