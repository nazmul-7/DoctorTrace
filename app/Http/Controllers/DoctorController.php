<?php

namespace App\Http\Controllers;

use App\Doctor;
use App\Appointment;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class DoctorController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
       $this->middleware('auth:doctor');
    }
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    // public function index()
    // {
    //     return redirect()->route("profile");
    // }

    // Doctor dashboard
    public function dashboard(){

        // $appointment = Appointment::where([['doctor_id', 1],['date', '2018-12-22']])->orderBy('created_at', 'asc')
        //                             ->join('users', 'users.id', '=', 'user_id')
        //                             ->get();
        // $appointment = Appointment::where('date', '2018-12-22')->orderBy('created_at', 'asc')
        //                             ->get();

       $appointment= $this->dashBoardFetchData(date('Y-m-d'));
        
        return view('doctor.pages.dashboard', ['appointment' => $appointment]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {

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
    }



    /**
     * Display the specified resource.
     *
     * @param  \App\Doctor  $doctor
     * @return \Illuminate\Http\Response
     */
    public function show(Doctor $doctor)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Doctor  $doctor
     * @return \Illuminate\Http\Response
     */
    public function edit(Doctor $doctor)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Doctor  $doctor
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Doctor $doctor)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Doctor  $doctor
     * @return \Illuminate\Http\Response
     */
    public function destroy(Doctor $doctor)
    {
        //
    }

    public function appointmentSearchByDate(Request $request){

     

        $appointment= $this->dashBoardFetchData($request->date);

        return view('doctor.pages.dashboard', ['appointment' => $appointment,'date'=>$request->date]);

    }

    public function dashBoardFetchData($date){

        $appointment = DB::table('appointments')
        ->join('users', 'users.id', '=', 'appointments.user_id')
        ->select('appointments.*', 'users.name', 'users.email')
        ->where([['appointments.doctor_id', 1],['appointments.date', $date]])
        ->orderBy('appointments.created_at', 'asc')
        ->get();
        Log::info('I am Date: '.$date);
        Log::info('I am Data: '.$appointment);
        return $appointment;

    }
}
