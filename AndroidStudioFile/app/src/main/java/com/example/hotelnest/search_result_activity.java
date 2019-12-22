package com.example.hotelnest;

import androidx.appcompat.app.AppCompatActivity;

import android.content.Context;
import android.content.Intent;
import android.content.SharedPreferences;
import android.graphics.Bitmap;
import android.graphics.BitmapFactory;
import android.graphics.drawable.Drawable;
import android.os.Bundle;
import android.util.Log;
import android.view.Gravity;
import android.view.LayoutInflater;
import android.view.MotionEvent;
import android.view.View;
import android.widget.AdapterView;
import android.widget.Button;
import android.widget.ImageView;
import android.widget.LinearLayout;
import android.widget.ListView;
import android.widget.PopupWindow;
import android.widget.SimpleAdapter;
import android.widget.TextView;

import com.android.volley.NetworkResponse;
import com.android.volley.ParseError;
import com.android.volley.Request;
import com.android.volley.RequestQueue;
import com.android.volley.Response;
import com.android.volley.VolleyError;
import com.android.volley.toolbox.HttpHeaderParser;
import com.android.volley.toolbox.JsonArrayRequest;
import com.android.volley.toolbox.JsonObjectRequest;
import com.android.volley.toolbox.JsonRequest;
import com.android.volley.toolbox.StringRequest;
import com.android.volley.toolbox.Volley;

import org.json.JSONArray;
import org.json.JSONException;
import org.json.JSONObject;

import java.io.File;
import java.io.FileOutputStream;
import java.io.IOException;
import java.io.InputStream;
import java.io.UnsupportedEncodingException;
import java.net.HttpURLConnection;
import java.net.URL;
import java.text.DateFormat;
import java.text.SimpleDateFormat;
import java.util.ArrayList;
import java.util.Date;
import java.util.HashMap;
import java.util.List;
import java.util.Map;
import java.util.zip.Inflater;

public class search_result_activity extends AppCompatActivity {

    private String email;

    private ListView listview;
    private List<HashMap<String, Object>> lstDraftItem;
    private SimpleAdapter adapter;
    private ArrayList<String> hotelname = new ArrayList<>();
    private ArrayList<String>  hotelpicture = new ArrayList<>();
    private ArrayList<String> hoteldescription = new ArrayList<>();
    private ArrayList<Integer> hotelprice = new ArrayList<>();
    private ArrayList<String> hotelId = new ArrayList<>();
    private int[][] hotelpictureint = {
            {R.drawable.images_1_1,R.drawable.images_1_2,R.drawable.images_1_3},
            {R.drawable.images_2_1,R.drawable.images_2_2,R.drawable.images_2_3,R.drawable.images_2_4,R.drawable.images_2_5},
            {R.drawable.images_3_1,R.drawable.images_3_2,R.drawable.images_3_3,R.drawable.images_3_4,R.drawable.images_3_5,R.drawable.images_3_6},
            {R.drawable.images_4_1,R.drawable.images_4_2,R.drawable.images_4_3,R.drawable.images_4_4,R.drawable.images_4_5},
            {R.drawable.images_5_1,R.drawable.images_5_2,R.drawable.images_5_3,R.drawable.images_5_4,R.drawable.images_5_5,R.drawable.images_5_6,R.drawable.images_5_7,R.drawable.images_5_8},
            {R.drawable.images_6_1,R.drawable.images_6_2,R.drawable.images_6_3,R.drawable.images_6_4,R.drawable.images_6_5,R.drawable.images_6_6,R.drawable.images_6_7},
            {R.drawable.images_7_1,R.drawable.images_7_2,R.drawable.images_7_3,R.drawable.images_7_4,R.drawable.images_7_5,R.drawable.images_7_6,R.drawable.images_7_7,R.drawable.images_7_8},
            {R.drawable.images_50_1,R.drawable.images_50_2,R.drawable.images_50_3,R.drawable.images_50_4,R.drawable.images_50_5,R.drawable.images_50_6,R.drawable.images_50_7,R.drawable.images_50_8},
            {R.drawable.images_52_1,R.drawable.images_52_2,R.drawable.images_52_3,R.drawable.images_52_4,R.drawable.images_52_5,R.drawable.images_52_6}
    };
    private String city, adult, child, room, checkInDate, checkOutDate, userId;
    private int nights;


    private TextView goingCity, checkin, checkout;



    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_search_result_activity);

        userId = getIntent().getStringExtra("userId");
        Log.i("s_result take userId", userId);
        nights = getIntent().getIntExtra("nights",0);
        email = getIntent().getStringExtra("email");
        city = getIntent().getStringExtra("city");
        adult = getIntent().getStringExtra("adult");
        child = getIntent().getStringExtra("child");
        room = getIntent().getStringExtra("room");
        checkInDate = getIntent().getStringExtra("checkInDate");
        checkOutDate = getIntent().getStringExtra("checkOutDate");
        goingCity = findViewById(R.id.goingCity);
        checkin = findViewById(R.id.checkin);
        checkout = findViewById(R.id.checkout);

        Log.i("checkindate", checkInDate);
        Log.i("checkoutdate", checkOutDate);
        try {
            Date checkin = new SimpleDateFormat("dd MMM yyyy").parse(checkInDate);
            Date checkout = new SimpleDateFormat("dd MMM yyyy").parse(checkOutDate);

            DateFormat dateFormat = new SimpleDateFormat("yyyy-MM-dd");
            checkInDate = dateFormat.format(checkin);
            checkOutDate = dateFormat.format(checkout);
            Log.i("checkindate", checkInDate);
            Log.i("checkoutdate", checkOutDate);
        }catch(Exception e){

        }

        listview = findViewById(R.id.search_results_list);
        listview.setOnItemClickListener(new AdapterView.OnItemClickListener() {
            @Override
            public void onItemClick(AdapterView<?> parent, View view, int position, long id) {

                TextView title = view.findViewById(R.id.tv_sub_title);
                String intentId = hotelId.get(hotelname.indexOf(title.getText().toString()));


                Intent intent = new Intent(getBaseContext(), hotel_details.class);
                intent.putExtra("hotelId", intentId);
                intent.putExtra("checkInDate", checkInDate);
                intent.putExtra("checkOutDate", checkOutDate);
                intent.putExtra("adult", adult);
                intent.putExtra("child", child);
                intent.putExtra("email", email);
                intent.putExtra("nights", nights);
                intent.putExtra("userId", userId);
                Log.i("s_result put userId", userId);
                startActivity(intent);
            }
        });
        lstDraftItem = new ArrayList<HashMap<String, Object>>();
        //适配器SimpleAdapter数据绑定
        //错误:构造函数SimpleAdapter未定义 需把this修改为MainActivity.this
        adapter = new SimpleAdapter(this, lstDraftItem, R.layout.item_list,
                new String[]{"logo", "title"},
                new int[]{R.id.img_sub_logo, R.id.tv_sub_title});


        goingCity.setText(city);
        checkin.setText(checkInDate);
        checkout.setText(checkOutDate);


        RequestQueue queue = Volley.newRequestQueue(getApplicationContext());
        String url = "http://10.0.2.2:8000/search";



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
                            for(int i=0; i<reader.length();i++){
                                Log.i("hotel name", reader.getJSONObject(i).getString("name"));
                                hotelId.add(reader.getJSONObject(i).getString("hotelId"));
                                hotelname.add( reader.getJSONObject(i).getString("name"));
                                hotelpicture.add(reader.getJSONObject(i).getString("picturePath"));
                                hoteldescription.add(reader.getJSONObject(i).getString("description"));
                                hotelprice.add(reader.getJSONObject(i).getInt("lowestPrice"));

                                lstDraftItem = new ArrayList<HashMap<String, Object>>();
                                //适配器SimpleAdapter数据绑定
                                //错误:构造函数SimpleAdapter未定义 需把this修改为MainActivity.this
                                adapter = new SimpleAdapter(getBaseContext(), lstDraftItem, R.layout.item_list,
                                        new String[]{"logo", "title"},
                                        new int[]{R.id.img_sub_logo, R.id.tv_sub_title});
                                //titleArrayLast=(String[])hotelname.toArray();
                                //decArrayLast=decArray.clone();
                                for (int j=0;j<hotelname.size();j++){
                                    HashMap<String, Object> map = new HashMap<String, Object>();

                                    int x,y;
                                    Log.i("hotelpicture string", hotelpicture.get(j));

                                    if(hotelpicture.get(j).length()<16) {
                                        x = Integer.parseInt(hotelpicture.get(j).substring(8,9))-1;
                                        Log.i("x:",hotelpicture.get(j).substring(8,9));
                                        y = Integer.parseInt(hotelpicture.get(j).substring(10,11))-1;
                                        Log.i("y:",hotelpicture.get(j).substring(10,11));
                                    }else{
                                        x = Integer.parseInt(hotelpicture.get(j).substring(8,10));
                                        Log.i("x:",hotelpicture.get(j).substring(8,10));
                                        y = Integer.parseInt(hotelpicture.get(j).substring(11,12))-1;
                                        Log.i("y:",hotelpicture.get(j).substring(11,12));
                                        if(x==50){
                                            x=7;
                                        }else if(x==52){
                                            x=8;
                                        }
                                    }
                                    map.put("logo", hotelpictureint[x][y]);




                                    map.put( "title", hotelname.get(j));

                                    lstDraftItem.add(map);
                                }
                                listview.setAdapter(adapter);

                            }
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
                params.put("city", city);
                params.put("checkInDate", checkInDate);
                params.put("checkOutDate",checkOutDate);
                params.put("adult", adult);
                params.put("child", child);
                params.put("room", room);
                Log.i("test search", params.get("city"));
                return params;
            }
        };
        queue.add(stringRequest);
        Log.i("test json","queue added" );




    }
}
