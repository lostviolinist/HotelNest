package com.example.hotelnest;

import androidx.appcompat.app.AppCompatActivity;

import android.os.Bundle;
import android.util.Log;
import android.widget.SimpleAdapter;

import com.android.volley.Request;
import com.android.volley.RequestQueue;
import com.android.volley.Response;
import com.android.volley.VolleyError;
import com.android.volley.toolbox.StringRequest;
import com.android.volley.toolbox.Volley;

import org.json.JSONArray;

import java.util.ArrayList;
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

    private String email, checkInDate, checkOutDate;
    private int adult, child, totalPrice, hotelId;
    private int[] roomId, addBed;

    //          $request->fullName, $request->email, $request->phone, $request->icNum,
    //          $request->checkInDate, $request->checkOutDate, $request->remark, $request->adult, $request->child,
    //          $request->totalPrice, $request->hotelId, $request->roomId, $request->addBed);
    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_booking_details);

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
        String url = "http://10.0.2.2:8000/userProfile";

        // Request a string response from the provided URL.
        StringRequest stringRequest = new StringRequest(Request.Method.POST, url,
                new Response.Listener<String>() {
                    @Override
                    public void onResponse(String response) {
                        // Display the first 500 characters of the response string.
                        Log.i("json response", response);
                        try {
                            //JSONObject reader = new JSONObject(response);
                            JSONArray reader = new JSONArray(response);

                        }catch(Exception e){
                            Log.i("test search name", "error");
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
                params.put("userId", city);
                params.put("email", email);

                Log.i("test search", params.get("city"));
                return params;
            }
        };
        queue.add(stringRequest);
        Log.i("test json","queue added" );
    }
}
