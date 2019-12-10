<?php

namespace App\Http\Controllers;

use App\Hotel;
use Illuminate\Http\Request;
use DataTables;
use Validator;
use App\booking;

class BookingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // if($request->ajax())
        // {
            $list = booking::latest()->get();
            $res = [];
            foreach($list as $data) {
                $arr = [
                    $data->bookingNum, // no,
                    $data->created_at, // booking date
                    $data->checkInDate, // checkin
                    $data->checkOutDate, // checkout
                    $data->fullName, // guest name
                    $data->email, // guest email
                    $data->phone, // guest mobile
                    $data->adult, // adult
                    $data->child, // child
                    $data->roomNo, // room
                ];
                array_push($res, $arr);
            }
            $final = json_decode("{}");
            $final->data = $res;

            return json_encode($final);
            
            // return DataTables::of($data)
            //         ->addColumn('action', function($data){
            //             $button = '<button type="button" name="edit" id="'.$data->id.'" class="edit btn btn-primary btn-sm">Edit</button>';
            //             $button .= '&nbsp;&nbsp;&nbsp;<button type="button" name="edit" id="'.$data->id.'" class="delete btn btn-danger btn-sm">Delete</button>';
            //             return $button;
            //         })
            //         ->rawColumns(['action'])
            //         ->make(true);
        // }
        // return view('testbooking');
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
            'fullName'=> 'required',
            'email'=> 'required',
            'phone'=> 'required',
            'icNum'=> 'required',
            'checkInDate'=> 'required',
            'checkOutDate'=> 'required',
            'remark'=> 'required',
            'adult'=> 'required',
            'child'=> 'required',
            'roomNo' => 'required',
            'totalPrice' => 'required',
                       
        );
        $error = Validator::make($request->all(), $rules);

        if($error->fails())
        {
            return response()->json(['errors' => $error->errors()->all()]);
        }

        $form_data = array(
            'fullName'=> $request->fullName,
            'email'=> $request->email,
            'phone'=> $request->phone,
            'icNum'=> $request->icNum,
            'checkInDate'=> $request->checkInDate,
            'checkOutDate'=> $request->checkOutDate,
            'remark'=> $request->remark,
            'adult'=> $request->adult,
            'child'=> $request->child,
            'roomNo' => $request->child,
            'totalPrice'=> $request->totalPrice,
        );
        booking::create($form_data);

        return response()->json(['success' => 'Data Added successfully.']);
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
        if(request()->ajax())
        {
            $data = booking::findOrFail($id);
            return response()->json(['result' => $data]);
        }
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
        $rules = array(
            'fullName'=> 'required',
            'email'=> 'required',
            'phone'=> 'required',
            'icNum'=> 'required',
            'checkInDate'=> 'required',
            'checkOutDate'=> 'required',
            'remark'=> 'required',
            'adult'=> 'required',
            'child'=> 'required',  
            'roomNo' => 'required',
            'totalPrice'=> 'required',      
        );
        $error = Validator::make($request->all(), $rules);

        if($error->fails())
        {
            return response()->json(['errors' => $error->errors()->all()]);
        }

        $form_data = array(
            'fullName'=> $request->fullName,
            'email'=> $request->email,
            'phone'=> $request->phone,
            'icNum'=> $request->icNum,
            'checkInDate'=> $request->checkInDate,
            'checkOutDate'=> $request->checkOutDate,
            'remark'=> $request->remark,
            'adult'=> $request->adult,
            'child'=> $request->child,
            'roomNo' => $request->roomNo,
            'totalPrice'=> $request->totalPrice,
        );

        booking::whereId($request->hidden_id)->update($form_data);

        return response()->json(['success' => 'Data is successfully updated']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = booking::findOrFail($id);
        $data->delete();
    }
}
