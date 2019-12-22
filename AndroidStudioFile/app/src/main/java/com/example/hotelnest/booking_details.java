package com.example.hotelnest;

import androidx.appcompat.app.AppCompatActivity;

import android.os.Bundle;
import android.util.Log;
import android.view.View;
import android.widget.Button;
import android.widget.EditText;
import android.widget.SimpleAdapter;

import com.android.volley.Request;
import com.android.volley.RequestQueue;
import com.android.volley.Response;
import com.android.volley.VolleyError;
import com.android.volley.toolbox.StringRequest;
import com.android.volley.toolbox.Volley;

import org.json.JSONArray;

import java.text.DateFormat;
import java.text.SimpleDateFormat;
import java.util.ArrayList;
import java.util.Date;
import java.util.HashMap;
import java.util.Map;

public class booking_details extends AppCompatActivity {

    //Intent intent = new Intent(getBaseContext(), booking_details.class);
    //                intent.putExtra("email", email);
    //                intent.putExtra("checkInDate", checkInDate);
    //                intent.putExtra("checkOutDate", checkOutDate);
    //                intent.putExtra("adult", adult);
    //                intent.putExtra("child", child);
    //                intent.putExtra("totalPrice", totalPrice);
    //                intent.putExtra("hotelId", hotelId);
    //                intent.putExtra("roomId", roomId);
    //                intent.putExtra("addBed", addBed);
    //                startActivity(intent);

    private String email, checkInDate, checkOutDate, userId, full_name;
    private int adult, child, totalPrice, hotelId, phone;
    private int[] roomId, addBed;

    private EditText IC, remarks;
    private Button confirm_booking;

    //          $request->fullName, $request->email, $request->phone, $request->icNum,
    //          $request->checkInDate, $request->checkOutDate, $request->remark, $request->adult, $request->child,
    //          $request->totalPrice, $request->hotelId, $request->roomId, $request->addBed);
    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_booking_details);

        IC = findViewById(R.id.IC);
        remarks = findViewById(R.id.remarks);
        confirm_booking = findViewById(R.id.confirm_booking);

        confirm_booking.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                RequestQueue queue = Volley.newRequestQueue(getApplicationContext());
                String url = "http://10.0.2.2:8000/createBooking";

                //return InsertBookingController::newBooking($request->fullName, $request->email, $request->phone, $request->icNum,
                //        $request->checkInDate, $request->checkOutDate, $request->remark, $request->adult, $request->child,
                //         $request->totalPrice, $request->hotelId, $request->roomId, $request->addBed);


                // Request a string response from the provided URL.
                StringRequest stringRequest = new StringRequest(Request.Method.POST, url,
                        new Response.Listener<String>() {
                            @Override
                            public void onResponse(String response) {
                                // Display the first 500 characters of the response string.
                                Log.i("create booking response", response);

                            }
                        }, new Response.ErrorListener() {
                    @Override
                    public void onErrorResponse(VolleyError error) {
                        error.printStackTrace();
                        Log.i("test search", "Server Error.");
                    }
                }) {
                    @Override
                    protected Map<String, String> getParams() {
                        Map<String, String> params = new HashMap<String, String>();
                        params.put("fullName", full_name);
                        params.put("email", email);
                        params.put("phone",String.valueOf(phone));
                        params.put("icNum", IC.getText().toString());
                        params.put("checkInDate", checkInDate);
                        params.put("checkOutDate", checkOutDate);
                        params.put("remark", remarks.getText().toString());
                        params.put("adult", String.valueOf(adult));
                        params.put("child", String.valueOf(child));
                        params.put("totalPrice", String.valueOf(totalPrice));
                        params.put("hotelId", String.valueOf(hotelId));

                        try{
                            JSONArray jsonArray = new JSONArray();
                            for(int i=0;i<roomId.length;i++){
                                jsonArray.put(String.valueOf(roomId[i]));
                            }
                            Log.i("roomId json string", jsonArray.toString());
                            params.put("roomId", jsonArray.toString());


                            JSONArray jsonArray_addBed = new JSONArray();
                            for(int i=0;i<roomId.length;i++){
                                jsonArray_addBed.put(String.valueOf(addBed[i]));
                            }
                            params.put("addBed", jsonArray_addBed.toString());
                            Log.i("addbed json string", jsonArray_addBed.toString());
                        }catch(Exception e){

                        }

                        return params;
                    }
                };
                queue.add(stringRequest);
                Log.i("test json","queue added" );
            }
        });

        userId = getIntent().getStringExtra("userId");
        Log.i("b_details take userId", userId);
        email = getIntent().getStringExtra("email");
        checkInDate = getIntent().getStringExtra("checkInDate");
        checkOutDate = getIntent().getStringExtra("checkOutDate");
        adult = getIntent().getIntExtra("adult", 0);
        child = getIntent().getIntExtra("child", 0);
        totalPrice = getIntent().getIntExtra("totalPrice", 0);
        hotelId = getIntent().getIntExtra("hotelId", 0);
        roomId = getIntent().getIntArrayExtra("roomId");
        addBed = getIntent().getIntArrayExtra("addBed");



        RequestQueue queue = Volley.newRequestQueue(getApplicationContext());
        String url = String.format("http://10.0.2.2:8000/userProfile?userId=%1$s&email=%2$s",userId,email);

        // Request a string response from the provided URL.
        StringRequest stringRequest = new StringRequest(Request.Method.GET, url,
                new Response.Listener<String>() {
                    @Override
                    public void onResponse(String response) {
                        // Display the first 500 characters of the response string.
                        Log.i("json response", response);
                        try {
                            //JSONObject reader = new JSONObject(response);
                            JSONArray reader = new JSONArray(response);
                            full_name = reader.getJSONObject(0).getString("firstName")+" "+reader.getJSONObject(0).getString("lastName");
                            phone = reader.getJSONObject(0).getInt("phone");

                        }catch(Exception e){
                            Log.i("test userProfile", "error");
                        }


                    }
                }, new Response.ErrorListener() {
            @Override
            public void onErrorResponse(VolleyError error) {
                error.printStackTrace();
                Log.i("test search", "Server Error.");
            }
        }) {
            @Override
            protected Map<String, String> getParams() {
                Map<String, String> params = new HashMap<String, String>();
                params.put("userId", userId);
                params.put("email", email);
                Log.i("params userid", userId);
                Log.i("params email", email);


                return params;
            }
        };
        queue.add(stringRequest);
        Log.i("test json","queue added" );
    }
}
