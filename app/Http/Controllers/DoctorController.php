<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Doctor;
use Illuminate\Support\Facades\Auth;


//use this library for uploading image
use Illuminate\Http\UploadedFile;

//user this intervention image library to resize/crop image
use Intervention\Image\Facades\Image; 
// import the Intervention Image Manager Class
use Intervention\Image\ImageManager;
class DoctorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $doctors = Doctor::latest()->paginate(3);
        return view('');
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
        
        request()->validate([
            'name'=>'required',
            'reg'=>'required',
            'photo'=>'sometimes|image',
            'education'=>'required',
            'is_active'=>'required'
        ]);
        $doctor = Doctor::create([
            'name'=> $request->name,
            'reg'=> $request->reg,
            'education'=>$request->education,
            'is_active'=>$request->is_active,
            'user_id'=> Auth::user()->id,
        ]);

        // dd($doctor);
        $this->storeImage($doctor);
        return back()->with('message','Data has been created successfully!!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    function storeImage($doctor){
        if (request()->has('photo')) {
            $doctor->update([
                'photo'=>request()->photo->store('doctors','public'),
            ]);

            // echo $doctor->photo.' '; exit;
            $image = Image::make(public_path('storage/'.$doctor->photo))->fit(300,300);
            $image->save();
            // $img = Image::make($request->file('photo')->getRealPath());
        }
    }
}
