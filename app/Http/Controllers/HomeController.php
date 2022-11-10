<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Car;
use App\Models\CarModel;
use App\Models\User;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = [
            'cars' => Car::all(),
            'user' => new User,
        ];
        return view('form')->with($data);
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
        $request->validate([
            'name' => 'required',
            'age' => 'required|numeric|min:18',
            'email' => 'required|unique:users,email',
            'phone' => 'required|unique:users,phone',
            'model_interest' => 'required'
        ]);
        $new_user = User::create([
            'name' => $request->name,
            'age' => $request->age,
            'email'=> $request->email,
            'phone' => $request->phone,
            'car_model_id' => $request->model_interest
        ]);
        return redirect('/')->with('status', 'Los datos se guardaron correctamente');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = [
            'cars' => Car::all(),
            'user'=> User::with(['car_model', 'car_model.car'])->where('id',$id)->first(),
        ];
        return view('formEdit')->with($data);
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
        $request->validate([
            'name' => 'required',
            'age' => 'required|numeric|min:18',
            'email' => 'required|unique:users,email,'.$id,
            'phone' => 'required|unique:users,phone,'.$id,
            'model_interest' => 'required'
        ]);
        $user = user::find($id);
        $user->update([
            'name' => $request->name,
            'age' => $request->age,
            'email'=> $request->email,
            'phone' => $request->phone,
            'car_model_id' => $request->model_interest
        ]);
        return redirect('/prospects')->with('status', 'Los datos se guardaron correctamente');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::find($id);
        $user->delete();
        return response()->json('ok', 200);
    }

    public function getModelsOfCar($id){
        $carModels = CarModel::where('car_id', $id)->get();
        return $carModels;
     }

     public function listAll()
     {
         $data = [
             'users' => User::with(['car_model', 'car_model.car'])->get(),
         ];
         return view('list')->with($data);
     }
}
