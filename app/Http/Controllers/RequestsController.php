<?php

namespace App\Http\Controllers;

use App\Exports\TraineesExport;
use App\Models\Requests;
use App\Models\TrainingPage;
use App\Notifications\Notify;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;
use Illuminate\Validation\ValidationException;
use Maatwebsite\Excel\Excel;


class RequestsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $trainings = TrainingPage::paginate(10);
        return view('Admin_pages.Requests.Requests', compact('trainings'));
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
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Requests $requests
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Requests $requests
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Requests $requests
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        //

        if ($request->status == 1) {
            $new = Requests::where('id', $request->id);
            $new->update([
                'status' => 1,
            ]);

        } else if ($request->status == 3) {

            $new = Requests::where('id', $request->id);
            $new->update([
                'status' => 3,
            ]);

        } else if ($request->status == 4) {
            $trainees = Requests::select('*')->where('training', $request->id)->where('status', 2)->where('university', 1)->update(['status' => 1]);
        } else if ($request->status == 5) {
            $trainees = Requests::select('*')->where('training', $request->id)->where('status', 2)->update(['status' => 1]);
        } else if ($request->status == 6) {
            $trainees = Requests::select('*')->where('training', $request->id)->where('status', 2)->update(['status' => 3]);
        }
        session()->flash('Update', 'Update Done');
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Requests $requests
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        //
    }

    public function Search(Request $request)
    {
        //
        session()->flash('Search', 'Search Done');

        $type = $request->type;
        $status = 0;
        if ($request->training == 'Choose Training' && $request->type == 'Choose Status') {
            $requests = Requests::paginate(10);
            $trainings = TrainingPage::paginate(10);
            $training = $request->training;
            return view('Admin_pages.Requests.Requests', compact('training', 'type', 'requests', 'trainings'));
        } else if ($request->training == 'Choose Training' && $request->type != 'Choose Status') {
            $requests = Requests::select('*')->where('status', '=', $request->type)->paginate(10);
            $trainings = TrainingPage::paginate(10);
            $training = TrainingPage::select('name', 'status')->where('id', $request->training)->first();
            $minya = Requests::where('training', $request->training)->where('university', '1')->count();
            $other = Requests::where('training', $request->training)->count() - $minya;
            $status = $training['status'];
            $training = $training['name'];
            $trainID = $request->training;
            return view('Admin_pages.Requests.Requests', compact('trainID', 'training', 'type', 'requests', 'trainings', 'status', 'minya', 'other'));
        } else if ($request->training != 'Choose Training' && $request->type == 'Choose Status') {
            $requests = Requests::select('*')->where('training', '=', $request->training)->paginate(10);
            $trainings = TrainingPage::paginate(10);
            $training = TrainingPage::select('name', 'status')->where('id', $request->training)->first();
            $minya = Requests::where('training', $request->training)->where('university', '1')->count();
            $other = Requests::where('training', $request->training)->count() - $minya;
            $status = $training['status'];
            $training = $training['name'];
            $trainID = $request->training;
            return view('Admin_pages.Requests.Requests', compact('trainID', 'training', 'type', 'requests', 'trainings', 'status', 'minya', 'other'));
        } else if ($request->training != null && $request->training != 'Choose Training' && $request->type != 'Choose Status') {
            $requests = Requests::select('*')->where('training', '=', $request->training)->where('status', '=', $request->type)->paginate(10);
            $trainings = TrainingPage::paginate(10);
            $training = TrainingPage::select('name', 'status')->where('id', $request->training)->first();
            $minya = Requests::where('training', $request->training)->where('university', '1')->count();
            $other = Requests::where('training', $request->training)->count() - $minya;
            $status = $training['status'];
            $training = $training['name'];
            $trainID = $request->training;
            return view('Admin_pages.Requests.Requests', compact('trainID', 'training', 'type', 'requests', 'trainings', 'status', 'minya', 'other'));
        }


    }

    public function export()
    {
        session()->flash('Excel', 'Excel Done');
        return \Maatwebsite\Excel\Facades\Excel::download(new TraineesExport, 'Trainees.xlsx');
    }

    public function Notify($id)
    {

        $trainees = Requests::where('training', $id)->where('status', 1)->get();
        session()->flash('Notify', 'Notify Done');
        foreach ($trainees as $trainee) {

            $trainee->notify(new Notify());
        }
        return back();

    }


}
