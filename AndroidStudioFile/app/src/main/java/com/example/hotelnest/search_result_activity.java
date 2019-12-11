package com.example.hotelnest;

import androidx.appcompat.app.AppCompatActivity;

import android.content.Context;
import android.content.SharedPreferences;
import android.graphics.Bitmap;
import android.graphics.BitmapFactory;
import android.os.Bundle;
import android.util.Log;
import android.view.Gravity;
import android.view.LayoutInflater;
import android.view.MotionEvent;
import android.view.View;
import android.widget.AdapterView;
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
import com.android.volley.toolbox.JsonRequest;
import com.android.volley.toolbox.StringRequest;
import com.android.volley.toolbox.Volley;

import org.json.JSONArray;
import org.json.JSONException;

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
    private static final String TAG_HOTEL_ID = "hotelId";
    private static final String TAG_NAME = "name";
    private static final String TAG_CITY = "city";
    private static final String TAG_STAR = "star";
    private static final String TAG_DESCRIPTION = "description";
    private static final String TAG_PICTURE_PATH = "picturePath";

    private ListView listview;
    private List<HashMap<String, Object>> lstDraftItem;
    private SimpleAdapter adapter;
    private String[] titleArrayLast=new String[100];
    private String[] decArrayLast=new String[100];
    private String[] titleArray=new String[]{"Hotel 1","Hotel 2","Hotel 3","Hotel 4","Hotel 5"};
    private String[] logoArray=new String[]{"https://liauroufan.com/hotelNest.png","https://liauroufan.com/hotelNest.png","https://liauroufan.com/hotelNest.png","https://liauroufan.com/hotelNest.png","https://liauroufan.com/hotelNest.png"};
    private String city, adult, child, room, checkInDate, checkOutDate;

    private DateFormat format = new SimpleDateFormat("dd MMM yyyy");

    private ArrayList<String> hotelList = new ArrayList<>();

    private TextView message,goingCity, checkin, checkout;

    public static Bitmap getBitmapFromURL(String src) {
        try {
            Log.e("src",src);
            URL url = new URL(src);
            HttpURLConnection connection = (HttpURLConnection) url.openConnection();
            connection.setDoInput(true);
            connection.connect();
            InputStream input = connection.getInputStream();
            Bitmap myBitmap = BitmapFactory.decodeStream(input);
            Log.e("Bitmap","returned");
            return myBitmap;
        } catch (IOException e) {
            e.printStackTrace();
            Log.e("Exception",e.getMessage());
            return null;
        }
    }

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_search_result_activity);

        city = getIntent().getStringExtra("city");
        adult = getIntent().getStringExtra("adult");
        child = getIntent().getStringExtra("child");
        room = getIntent().getStringExtra("room");
        checkInDate = getIntent().getStringExtra("checkInDate");
        checkOutDate = getIntent().getStringExtra("checkOutDate");
        goingCity = findViewById(R.id.goingCity);
        checkin = findViewById(R.id.checkin);
        checkout = findViewById(R.id.checkout);

        listview = findViewById(R.id.search_results_list);
        listview.setOnItemClickListener(new AdapterView.OnItemClickListener() {
            @Override
            public void onItemClick(AdapterView<?> parent, View view, int position, long id) {
                LayoutInflater inflater = LayoutInflater.from(getParent());
                View popup = inflater.inflate(R.layout.popup_view, null);

            }
        });
        lstDraftItem = new ArrayList<HashMap<String, Object>>();
        //适配器SimpleAdapter数据绑定
        //错误:构造函数SimpleAdapter未定义 需把this修改为MainActivity.this
        adapter = new SimpleAdapter(this, lstDraftItem, R.layout.item_list,
                new String[]{"logo", "title"},
                new int[]{R.id.img_sub_logo, R.id.tv_sub_title});
        titleArrayLast=titleArray.clone();
        //decArrayLast=decArray.clone();
        for (int i=0;i<titleArray.length;i++){
            HashMap<String, Object> map = new HashMap<String, Object>();

                map.put("logo", R.drawable.bg1);

                Log.i("image", "url error.");

            map.put( "title", titleArrayLast[i]);

            lstDraftItem.add(map);
        }
        listview.setAdapter(adapter);

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
                        Log.i("test search", response);
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
                params.put("city", "abc");
                params.put("checkInDate", "12-5-2019");
                params.put("checkOutDate","13-5-2019");
                params.put("adult", "2");
                params.put("child", "1");
                params.put("room", "1");
                Log.i("test search", params.get("city"));
                return params;
            }
        };
        queue.add(stringRequest);
        Log.i("test json","queue added" );




    }
}
