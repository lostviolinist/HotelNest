<?php

namespace App\Http\Controllers;

use App\Hotel;
use Illuminate\Http\Request;
use DataTables;
use Validator;

class Hotelcontroller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if($request->ajax())
        {
            $data = Hotel::latest()->get();
            return DataTables::of($data)
                    ->addColumn('action', function($data){
                        $button = '<button type="button" name="edit" id="'.$data->id.'" class="edit btn btn-primary btn-sm">Edit</button>';
                        $button .= '&nbsp;&nbsp;&nbsp;<button type="button" name="edit" id="'.$data->id.'" class="delete btn btn-danger btn-sm">Delete</button>';
                        return $button;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }
        return view('hotel');
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
        $rules = array(
            'name' => 'required',
            'checkInTime' => 'required',
            'checkOutTime'=> 'required',
            'city'=> 'required',
            'address'=> 'required',
            'star'=> 'required',
            'operationTime'=> 'required',
            'description' => 'required'
        );
        $error = Validator::make($request->all(), $rules);

        if($error->fails())
        {
            return response()->json(['errors' => $error->errors()->all()]);
        }

        $form_data = array(
            'name'        =>  $request->name,
            'checkInTime' =>  $request->checkInTime,
            'checkOutTime'=>  $request->checkOutTime,
            'city'=>  $request->city,
            'address'=>  $request->address,
            'star'=>  $request->star,
            'operationTime'=>  $request->operationTime,
            'description'=>  $request->description,
        );
        Hotel::create($form_data);

        return response()->json(['success' => 'Data Added successfully.']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Hotel  $hotel
     * @return \Illuminate\Http\Response
     */
    public function show(Hotel $hotel)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Hotel  $hotel
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if(request()->ajax())
        {
            $data = Hotel::findOrFail($id);
            return response()->json(['result' => $data]);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Hotel  $hotel
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Hotel $hotel)
    {
        $rules = array(
            'name' => 'required',
            'checkInTime' => 'required',
            'checkOutTime'=> 'required',
            'city'=> 'required',
            'address'=> 'required',
            'star'=> 'required',
            'operationTime'=> 'required',
            'description' => 'required'
        );

        $error = Validator::make($request->all(), $rules);

        if($error->fails())
        {
            return response()->json(['errors' => $error->errors()->all()]);
        }

        $form_data = array(
            'name'        =>  $request->name,
            'checkInTime' =>  $request->checkInTime,
            'checkOutTime'=>  $request->checkOutTime,
            'city'=>  $request->city,
            'address'=>  $request->address,
            'star'=>  $request->star,
            'operationTime'=>  $request->operationTime,
            'description'=>  $request->description,
        );

        Hotel::whereId($request->hidden_id)->update($form_data);

        return response()->json(['success' => 'Data is successfully updated']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Hotel  $hotel
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = Hotel::findOrFail($id);
        $data->delete();
    }
}
