package com.example.hotelnest;

import androidx.appcompat.app.AppCompatActivity;
import androidx.constraintlayout.widget.ConstraintLayout;

import android.content.Context;
import android.content.Intent;
import android.os.Bundle;
import android.util.Log;
import android.view.View;
import android.view.ViewGroup;
import android.widget.Button;
import android.widget.ImageView;
import android.widget.LinearLayout;
import android.widget.ListView;
import android.widget.SimpleAdapter;
import android.widget.TextView;

import com.android.volley.Request;
import com.android.volley.RequestQueue;
import com.android.volley.Response;
import com.android.volley.VolleyError;
import com.android.volley.toolbox.StringRequest;
import com.android.volley.toolbox.Volley;

import org.json.JSONArray;

import java.util.ArrayList;
import java.util.HashMap;
import java.util.List;
import java.util.Map;

public class hotel_details extends AppCompatActivity {

    private String hotelId,checkInDate,checkOutDate,adult,child,email;
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
    private int[] amenities = new int[8];
    private int[] amenities_icons = new int[8];

    private ListView listView;
    private List<HashMap<String, Object>> lstDraftItem;
    private SimpleAdapter adapter;

    private ArrayList<String> room_name = new ArrayList<>();
    private ArrayList<Integer> room_pax = new ArrayList<>();
    private ArrayList<String> room_description = new ArrayList<>();
    private ArrayList<Boolean> room_addBed = new ArrayList<>();
    private ArrayList<Integer> room_id = new ArrayList<>();
    private ArrayList<Integer> room_available_number = new ArrayList<>();
    private ArrayList<Integer> room_hotel_id = new ArrayList<>();
    private ArrayList<Boolean> room_aircond = new ArrayList<>();
    private ArrayList<Boolean> room_bathtub = new ArrayList<>();
    private ArrayList<Boolean> room_tv = new ArrayList<>();
    private ArrayList<Boolean> room_refrigerator = new ArrayList<>();
    private ArrayList<Boolean> room_free_toiletries = new ArrayList<>();
    private ArrayList<Boolean> room_toilet = new ArrayList<>();
    private ArrayList<Boolean> room_fan = new ArrayList<>();
    private ArrayList<Integer> room_price = new ArrayList<>();
    private ArrayList<Integer> room_selected_addbed = new ArrayList<>();

    private ArrayList<Integer> room_id_addbed = new ArrayList<>();
    private ArrayList<String> room_name_addbed = new ArrayList<>();
    private ArrayList<Integer> room_price_addbed = new ArrayList<>();


    private ArrayList<Integer> room_number = new ArrayList<>();

    private TextView total_price;
    private int total=0;
    private int nights, hotelicon_drawable, hotel_star;

    private Boolean added=false;
    private Boolean need_addbed = false;

    private Button book_button;

    private String hotel_name;



    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_hotel_details);

        nights = getIntent().getIntExtra("nights", 0);
        email = getIntent().getStringExtra("email");
        hotelId = getIntent().getStringExtra("hotelId");
        checkInDate = getIntent().getStringExtra("checkInDate");
        checkOutDate = getIntent().getStringExtra("checkOutDate");
        adult = getIntent().getStringExtra("adult");
        child = getIntent().getStringExtra("child");
        total_price = findViewById(R.id.booking_total_price);

        lstDraftItem = new ArrayList<HashMap<String, Object>>();
        //适配器SimpleAdapter数据绑定
        //错误:构造函数SimpleAdapter未定义 需把this修改为MainActivity.this
        adapter = new SimpleAdapter(this, lstDraftItem, R.layout.room_list,
                new String[]{"name", "icon1", "icon2", "icon3", "icon4","add","bed", "price", "description", "available",
                        "facility1", "facility2", "facility3", "facility4", "facility5", "facility6", "facility7", "facility8"},
                new int[]{R.id.room_name, R.id.person1, R.id.person2, R.id.person3, R.id.person4,R.id.add,R.id.bed, R.id.room_price, R.id.room_description, R.id.room_available_number,
                        R.id.facility1, R.id.facility2, R.id.facility3, R.id.facility4, R.id.facility5, R.id.facility6, R.id.facility7, R.id.facility8});

        RequestQueue queue = Volley.newRequestQueue(getApplicationContext());
        String url = "http://10.0.2.2:8000/hotelInfo";



        // Request a string response from the provided URL.
        StringRequest stringRequest = new StringRequest(Request.Method.POST, url,
                new Response.Listener<String>() {
                    @Override
                    public void onResponse(String response) {
                        // Display the first 500 characters of the response string.
                        Log.i("json response", response);
                        try {
                            JSONArray reader = new JSONArray(response);
                            TextView name = findViewById(R.id.hotel_detail_name);
                            name.setText(reader.getJSONObject(0).getString("name"));
                            hotel_name = reader.getJSONObject(0).getString("name");
                            TextView city = findViewById(R.id.hotel_detail_city);
                            city.setText(reader.getJSONObject(0).getString("city")+", Malaysia");

                            ImageView iv1,iv2,iv3,iv4,iv5;
                            int star = reader.getJSONObject(0).getInt("star");
                            hotel_star = star;
                            Log.i("star", String.valueOf(star));
                            switch (star){
                                case 1:
                                    iv1 = findViewById(R.id.star1);
                                    iv1.setImageResource(R.drawable.filled_star);
                                    break;
                                case 2:
                                    iv1 = findViewById(R.id.star1);
                                    iv1.setImageResource(R.drawable.filled_star);
                                    iv2 = findViewById(R.id.star2);
                                    iv2.setImageResource(R.drawable.filled_star);
                                    break;
                                case 3:
                                    iv1 = findViewById(R.id.star1);
                                    iv1.setImageResource(R.drawable.filled_star);
                                    iv2 = findViewById(R.id.star2);
                                    iv2.setImageResource(R.drawable.filled_star);
                                    iv3 = findViewById(R.id.star3);
                                    iv3.setImageResource(R.drawable.filled_star);
                                    break;
                                case 4:
                                    iv1 = findViewById(R.id.star1);
                                    iv1.setImageResource(R.drawable.filled_star);
                                    iv2 = findViewById(R.id.star2);
                                    iv2.setImageResource(R.drawable.filled_star);
                                    iv3 = findViewById(R.id.star3);
                                    iv3.setImageResource(R.drawable.filled_star);
                                    iv4 = findViewById(R.id.star4);
                                    iv4.setImageResource(R.drawable.filled_star);
                                    break;
                                case 5:
                                    iv1 = findViewById(R.id.star1);
                                    iv1.setImageResource(R.drawable.filled_star);
                                    iv2 = findViewById(R.id.star2);
                                    iv2.setImageResource(R.drawable.filled_star);
                                    iv3 = findViewById(R.id.star3);
                                    iv3.setImageResource(R.drawable.filled_star);
                                    iv4 = findViewById(R.id.star4);
                                    iv4.setImageResource(R.drawable.filled_star);
                                    iv5 = findViewById(R.id.star5);
                                    iv5.setImageResource(R.drawable.filled_star);
                                    break;

                                    default:

                            }
                            TextView address = findViewById(R.id.hotel_detail_address);
                            address.setText(reader.getJSONObject(0).getString("address"));
                            TextView office = findViewById(R.id.hotel_detail_office_hour);
                            office.setText("Operation Time: "+reader.getJSONObject(0).getString("operationTime"));
                            TextView description = findViewById(R.id.hotel_detail_description);
                            description.setText(reader.getJSONObject(0).getString("description"));

                            int id = Integer.parseInt(hotelId)-1;
                            if(id==49)
                                id=7;
                            if(id==51)
                                id=8;
                            int size = hotelpictureint[id].length;

                            Log.i("hotel id", String.valueOf(id));
                            Log.i("image array size", String.valueOf(size));
                            LinearLayout images_container_layout = findViewById(R.id.images_layout);
                            hotelicon_drawable = hotelpictureint[id][0];
                            for(int i=0;i<size;i++){
                                LinearLayout.LayoutParams new_image = new LinearLayout.LayoutParams(1080, 728);
                                Context context = getBaseContext();
                                ImageView new_imageView = new ImageView(context);
                                new_imageView.setImageResource(hotelpictureint[id][i]);
                                images_container_layout.addView(new_imageView, new_image);

                            }

                            amenities[0] = reader.getJSONObject(0).getInt("breakfast");
                            amenities[1] = reader.getJSONObject(0).getInt("24hrReception");
                            amenities[2] = reader.getJSONObject(0).getInt("smoking");
                            amenities[3] = reader.getJSONObject(0).getInt("freeWifi");
                            amenities[4] = reader.getJSONObject(0).getInt("gymRoom");
                            amenities[5] = reader.getJSONObject(0).getInt("freeParking");
                            amenities[6] = reader.getJSONObject(0).getInt("petAllow");
                            amenities[7] = reader.getJSONObject(0).getInt("swimmingPool");

                            amenities_icons[0] = R.drawable.breakfast;
                            amenities_icons[1] = R.drawable.hours;
                            amenities_icons[2] = R.drawable.smoke;
                            amenities_icons[3] = R.drawable.wifi;
                            amenities_icons[4] = R.drawable.gym;
                            amenities_icons[5] = R.drawable.parking;
                            amenities_icons[6] = R.drawable.pet;
                            amenities_icons[7] = R.drawable.swim;


                            ArrayList<ImageView> amenities_imageView = new ArrayList<>();



                            for(int i=0;i<8;i++){
                                if(amenities[i]==1){
                                    ImageView temp = new ImageView(getBaseContext());
                                    temp.setImageResource(amenities_icons[i]);
                                    amenities_imageView.add(temp);
                                }

                                if(i==2){
                                    if(amenities[2]==0){
                                        ImageView temp = new ImageView(getBaseContext());
                                        temp.setImageResource(R.drawable.no_smoking);
                                        amenities_imageView.add(temp);
                                    }
                                }
                            }

                            LinearLayout amenities_container1 = findViewById(R.id.amenities_layout_1);
                            LinearLayout amenities_container2 = findViewById(R.id.amenities_layout_2);
                            LinearLayout amenities_container3 = findViewById(R.id.amenities_layout_3);
                            LinearLayout.LayoutParams new_amenity_icon = new LinearLayout.LayoutParams(270, ViewGroup.LayoutParams.MATCH_PARENT);

                            if(amenities_imageView.size()>0){
                                if(amenities_imageView.size()>6){
                                    for(int i=0;i<3;i++){
                                        amenities_container1.addView(amenities_imageView.get(i),new_amenity_icon);
                                    }

                                    for(int i=3;i<6;i++){
                                        amenities_container2.addView(amenities_imageView.get(i),new_amenity_icon);
                                    }

                                    for(int i=6;i<amenities_imageView.size();i++){
                                        amenities_container3.addView(amenities_imageView.get(i),new_amenity_icon);
                                    }
                                }
                                else if(amenities_imageView.size()>3){
                                    for(int i=0;i<3;i++){
                                        amenities_container1.addView(amenities_imageView.get(i),new_amenity_icon);
                                    }

                                    for(int i=3;i<amenities_imageView.size();i++){
                                        amenities_container2.addView(amenities_imageView.get(i),new_amenity_icon);
                                    }
                                }else{
                                    for(int i=0;i<amenities_imageView.size();i++){
                                        amenities_container1.addView(amenities_imageView.get(i),new_amenity_icon);
                                    }
                                }
                            }




                        }catch(Exception e){

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
                params.put("hotelId", hotelId);

                return params;
            }
        };
        queue.add(stringRequest);
        Log.i("test json","queue added" );



        RequestQueue queue2 = Volley.newRequestQueue(getApplicationContext());
        String url2 = "http://10.0.2.2:8000/roomAvailable";



        // Request a string response from the provided URL.
        StringRequest stringRequest2 = new StringRequest(Request.Method.POST, url2,
                new Response.Listener<String>() {
                    @Override
                    public void onResponse(String response) {
                        // Display the first 500 characters of the response string.
                        Log.i("json response2", response);
                        try{

                            JSONArray reader2 = new JSONArray(response);
                            for(int i=0;i<reader2.length();i++){
                                room_id.add(reader2.getJSONObject(i).getInt("roomId"));
                                room_name.add(reader2.getJSONObject(i).getString("type"));
                                room_price.add(reader2.getJSONObject(i).getInt("price"));
                                room_pax.add(reader2.getJSONObject(i).getInt("pax"));
                                room_description.add(reader2.getJSONObject(i).getString("description"));
                                room_available_number.add(reader2.getJSONObject(i).getInt("availableNum"));
                                room_addBed.add(reader2.getJSONObject(i).getInt("addBed")==1);
                                room_hotel_id.add(reader2.getJSONObject(i).getInt("hotelId"));
                                room_aircond.add(reader2.getJSONObject(i).getInt("airConditioning")==1);
                                room_bathtub.add(reader2.getJSONObject(i).getInt("bathtub")==1);
                                room_tv.add(reader2.getJSONObject(i).getInt("TV")==1);
                                room_refrigerator.add(reader2.getJSONObject(i).getInt("refrigerator")==1);
                                room_free_toiletries.add(reader2.getJSONObject(i).getInt("freeToiletries")==1);
                                room_toilet.add(reader2.getJSONObject(i).getInt("toilet")==1);
                                room_fan.add(reader2.getJSONObject(i).getInt("fan")==1);

                            }

                            for(int i=0;i<room_id.size();i++){
                                if(room_addBed.get(i)){
                                    room_id_addbed.add(room_id.get(i));
                                    room_name_addbed.add(room_name.get(i)+" (Ex.Bed)");
                                    room_price_addbed.add(room_price.get(i)+30);

                                }
                            }

                            listView = findViewById(R.id.room_listing_listview);


                            int[] facilities = new int[8];
                            facilities[0] = R.drawable.addbed;
                            facilities[1] = R.drawable.aircond;
                            facilities[2] = R.drawable.bathtub;
                            facilities[3] = R.drawable.tv;
                            facilities[4] = R.drawable.refrigerator;
                            facilities[5] = R.drawable.toiletries;
                            facilities[6] = R.drawable.toilet;
                            facilities[7] = R.drawable.fan;



                            Log.i("number of room type",String.valueOf(room_id.size()));
                            for (int i=0;i<room_id.size();i++){
                                HashMap<String, Object> map = new HashMap<String, Object>();



                                if(need_addbed){
                                    map.put("name", room_name.get(i)+" (Ex.Bed)");
                                }else {
                                    map.put("name", room_name.get(i));
                                }
                                Log.i("test room listing", "name check");
                                switch(room_pax.get(i)){
                                    case 1:
                                        map.put("icon1", R.drawable.person);
                                        map.put("icon2", R.drawable.white);
                                        map.put("icon3", R.drawable.white);
                                        map.put("icon4", R.drawable.white);
                                        break;
                                    case 2:
                                        map.put("icon1", R.drawable.person);
                                        map.put("icon2", R.drawable.person);
                                        map.put("icon3", R.drawable.white);
                                        map.put("icon4", R.drawable.white);
                                        break;
                                    case 3:
                                        map.put("icon1", R.drawable.person);
                                        map.put("icon2", R.drawable.person);
                                        map.put("icon3", R.drawable.person);
                                        map.put("icon4", R.drawable.white);
                                        break;
                                    case 4:
                                        map.put("icon1", R.drawable.person);
                                        map.put("icon2", R.drawable.person);
                                        map.put("icon3", R.drawable.person);
                                        map.put("icon4", R.drawable.person);
                                        break;

                                    default:
                                        map.put("icon1", R.drawable.person);
                                        map.put("icon2", R.drawable.white);
                                        map.put("icon3", R.drawable.person);
                                        map.put("icon4", R.drawable.white);
                                        break;
                                }
                                if(need_addbed){
                                    map.put("add", R.drawable.add);
                                    map.put("bed", R.drawable.bed);
                                }else{
                                    map.put("add", R.drawable.white);
                                    map.put("bed", R.drawable.white);
                                }
                                Log.i("test room listing", "person check");

                                if(need_addbed){
                                    String price = "RM"+(room_price.get(i)+30)+" per night";
                                    map.put("price", price);
                                }else {
                                    String price = "RM" + room_price.get(i) + " per night";
                                    map.put("price", price);
                                }
                                Log.i("test room listing", "price check");

                                map.put("description", room_description.get(i));
                                Log.i("test room listing", "description check");

                                String available = room_available_number.get(i)+" rooms left";
                                map.put("available", available);
                                Log.i("test room listing", "available check");

                                ArrayList<Integer> facilities_in_this = new ArrayList<>();

                                if(room_addBed.get(i))
                                    facilities_in_this.add(facilities[0]);
                                if(room_aircond.get(i))
                                    facilities_in_this.add(facilities[1]);
                                if(room_bathtub.get(i))
                                    facilities_in_this.add(facilities[2]);
                                if(room_tv.get(i))
                                    facilities_in_this.add(facilities[3]);
                                if(room_refrigerator.get(i))
                                    facilities_in_this.add(facilities[4]);
                                if(room_free_toiletries.get(i))
                                    facilities_in_this.add(facilities[5]);
                                if(room_toilet.get(i))
                                    facilities_in_this.add(facilities[6]);
                                if(room_fan.get(i))
                                    facilities_in_this.add(facilities[7]);

                                switch (facilities_in_this.size()){
                                    case 0:
                                        map.put("facility1", R.drawable.white);
                                        map.put("facility2", R.drawable.white);
                                        map.put("facility3", R.drawable.white);
                                        map.put("facility4", R.drawable.white);
                                        map.put("facility5", R.drawable.white);
                                        map.put("facility6", R.drawable.white);
                                        map.put("facility7", R.drawable.white);
                                        map.put("facility8", R.drawable.white);
                                        break;
                                    case 1:
                                        map.put("facility1", facilities_in_this.get(0));
                                        map.put("facility2", R.drawable.white);
                                        map.put("facility3", R.drawable.white);
                                        map.put("facility4", R.drawable.white);
                                        map.put("facility5", R.drawable.white);
                                        map.put("facility6", R.drawable.white);
                                        map.put("facility7", R.drawable.white);
                                        map.put("facility8", R.drawable.white);
                                        break;
                                    case 2:
                                        map.put("facility1", facilities_in_this.get(0));
                                        map.put("facility2", facilities_in_this.get(1));
                                        map.put("facility3", R.drawable.white);
                                        map.put("facility4", R.drawable.white);
                                        map.put("facility5", R.drawable.white);
                                        map.put("facility6", R.drawable.white);
                                        map.put("facility7", R.drawable.white);
                                        map.put("facility8", R.drawable.white);
                                        break;
                                    case 3:
                                        map.put("facility1", facilities_in_this.get(0));
                                        map.put("facility2", facilities_in_this.get(1));
                                        map.put("facility3", facilities_in_this.get(2));
                                        map.put("facility4", R.drawable.white);
                                        map.put("facility5", R.drawable.white);
                                        map.put("facility6", R.drawable.white);
                                        map.put("facility7", R.drawable.white);
                                        map.put("facility8", R.drawable.white);
                                        break;
                                    case 4:
                                        map.put("facility1", facilities_in_this.get(0));
                                        map.put("facility2", facilities_in_this.get(1));
                                        map.put("facility3", facilities_in_this.get(2));
                                        map.put("facility4", facilities_in_this.get(3));
                                        map.put("facility5", R.drawable.white);
                                        map.put("facility6", R.drawable.white);
                                        map.put("facility7", R.drawable.white);
                                        map.put("facility8", R.drawable.white);
                                        break;
                                    case 5:
                                        map.put("facility1", facilities_in_this.get(0));
                                        map.put("facility2", facilities_in_this.get(1));
                                        map.put("facility3", facilities_in_this.get(2));
                                        map.put("facility4", facilities_in_this.get(3));
                                        map.put("facility5", facilities_in_this.get(4));
                                        map.put("facility6", R.drawable.white);
                                        map.put("facility7", R.drawable.white);
                                        map.put("facility8", R.drawable.white);
                                        break;
                                    case 6:
                                        map.put("facility1", facilities_in_this.get(0));
                                        map.put("facility2", facilities_in_this.get(1));
                                        map.put("facility3", facilities_in_this.get(2));
                                        map.put("facility4", facilities_in_this.get(3));
                                        map.put("facility5", facilities_in_this.get(4));
                                        map.put("facility6", facilities_in_this.get(5));
                                        map.put("facility7", R.drawable.white);
                                        map.put("facility8", R.drawable.white);
                                        break;
                                    case 7:
                                        map.put("facility1", facilities_in_this.get(0));
                                        map.put("facility2", facilities_in_this.get(1));
                                        map.put("facility3", facilities_in_this.get(2));
                                        map.put("facility4", facilities_in_this.get(3));
                                        map.put("facility5", facilities_in_this.get(4));
                                        map.put("facility6", facilities_in_this.get(5));
                                        map.put("facility7", facilities_in_this.get(6));
                                        map.put("facility8", R.drawable.white);
                                        break;
                                    case 8:
                                        map.put("facility1", facilities_in_this.get(0));
                                        map.put("facility2", facilities_in_this.get(1));
                                        map.put("facility3", facilities_in_this.get(2));
                                        map.put("facility4", facilities_in_this.get(3));
                                        map.put("facility5", facilities_in_this.get(4));
                                        map.put("facility6", facilities_in_this.get(5));
                                        map.put("facility7", facilities_in_this.get(6));
                                        map.put("facility8", facilities_in_this.get(7));
                                        break;
                                    default:
                                        map.put("facility1", facilities_in_this.get(0));
                                        map.put("facility2", R.drawable.white);
                                        map.put("facility3", facilities_in_this.get(2));
                                        map.put("facility4", R.drawable.white);
                                        map.put("facility5", facilities_in_this.get(4));
                                        map.put("facility6", R.drawable.white);
                                        map.put("facility7", facilities_in_this.get(6));
                                        map.put("facility8", R.drawable.white);
                                        break;
                                }
                                Log.i("test room listing", "facility check");


                                lstDraftItem.add(map);
                                Log.i("test room listing", "room added");
                                if(room_addBed.get(i)){
                                    if(!added){
                                        i--;
                                        need_addbed = true;
                                        added=true;
                                    }else{
                                        added=false;
                                        need_addbed = false;
                                    }
                                }
                            }
                            Log.i("test room listing",String.valueOf(lstDraftItem.size()));
                            listView.setAdapter(adapter);

                            ViewGroup.LayoutParams params = listView.getLayoutParams();
                            Log.i("test listview height", String.valueOf(params.height));
                            params.height = params.height*lstDraftItem.size();
                            Log.i("test listview height", String.valueOf(params.height));
                            listView.setLayoutParams(params);
                            listView.requestLayout();


                            for(int i=0;i<room_id.size();i++){
                                room_number.add(0);
                                room_selected_addbed.add(0);
                            }


                        }catch(Exception e){
                            Log.i("Error", e.getMessage());
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
            params.put("hotelId", hotelId);
            params.put("checkInDate", checkInDate);
            params.put("checkOutDate", checkOutDate);

            return params;
        }
    };
        queue2.add(stringRequest2);
        Log.i("test json","queue added" );
        //$request->fullName, $request->email, $request->phone, $request->icNum,
        //$request->checkInDate, $request->checkOutDate, $request->remark, $request->adult, $request->child,
        //         $request->totalPrice, $request->hotelId, $request->roomId, $request->addBed);

        book_button = findViewById(R.id.book_button);
        book_button.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                Intent intent = new Intent(getBaseContext(), booking.class);
                intent.putExtra("room_number", room_number);
                intent.putExtra("room_name", room_name);
                intent.putExtra("hotelId", hotelId);
                intent.putExtra("room_Id", room_id );
                intent.putExtra("checkInDate", checkInDate);
                intent.putExtra("checkOutDate", checkOutDate);
                intent.putExtra("totalPrice", total);
                intent.putExtra("adult", adult);
                intent.putExtra("child", child);
                intent.putExtra("email", email);
                intent.putExtra("hotel_name", hotel_name);
                intent.putExtra("room_selected_addbed", room_selected_addbed);
                intent.putExtra("room_price", room_price);
                intent.putExtra("nights", nights);
                intent.putExtra("hotelicon_drawable", hotelicon_drawable);
                intent.putExtra("hotel_star", hotel_star);
                startActivity(intent);

            }
        });


    }

    public void Decrement(View view) {
        Log.i("test minusplus", "Decrement");

        ConstraintLayout parentRow = (ConstraintLayout) view.getParent();

        TextView number = parentRow.findViewById(R.id.number);
        TextView name_textView = parentRow.findViewById(R.id.room_name);
        String name = name_textView.getText().toString();

        if(room_name.contains(name)){
            int index = room_name.indexOf(name);

            Log.i("test minusplus roomname", name_textView.getText().toString());

            Log.i("test minusplus index", String.valueOf(index));
            Log.i("test minusplus index", String.valueOf(room_number.get(index)));
            if(room_number.get(index)>0) {
                int update = room_number.get(index) - 1;
                room_number.set(index, update);
                number.setText(String.valueOf(room_number.get(index)-room_selected_addbed.get(index)));
                total = 0;
                for (int i = 0; i < room_number.size(); i++) {
                    total += room_number.get(i) * room_price.get(i);
                    total += room_selected_addbed.get(i)*30;
                }
                total_price.setText("RM" + String.valueOf(total));
            }
        }else{
            int index = room_name_addbed.indexOf(name);
            int index_ori = room_name.indexOf(name.substring(0,name.length()-9));

            Log.i("test minusplus roomname", name_textView.getText().toString());

            Log.i("test minusplus index", String.valueOf(index));
            Log.i("test minusplus index", String.valueOf(room_number.get(index_ori)));
            if(room_number.get(index_ori)>0){
                int update_selected = room_selected_addbed.get(index_ori)-1;
                int update = room_number.get(index_ori)-1;
                room_number.set(index_ori, update);
                room_selected_addbed.set(index_ori, update_selected);
                number.setText(String.valueOf(room_selected_addbed.get(index_ori)));
                total = 0;
                for(int i=0;i<room_number.size();i++){
                    total+=room_number.get(i)*room_price.get(i);
                    total+=room_selected_addbed.get(i)*30;
                }
                total_price.setText("RM"+String.valueOf(total));
            }
        }
    }
    public void Increment(View view) {
        Log.i("test minusplus", "Increment");

        ConstraintLayout parentRow = (ConstraintLayout) view.getParent();


        TextView number = parentRow.findViewById(R.id.number);
        TextView name_textView = parentRow.findViewById(R.id.room_name);
        String name = name_textView.getText().toString();
        Log.i("test minusplus roomname", name_textView.getText().toString());

        if(room_name.contains(name)) {
            int index = room_name.indexOf(name);
            Log.i("test minusplus index", String.valueOf(index));
            Log.i("test minusplus index", String.valueOf(room_number.get(index)));


            int update = room_number.get(index) + 1;
            room_number.set(index, update);

            number.setText(String.valueOf(room_number.get(index)-room_selected_addbed.get(index)));
            total = 0;
            for (int i = 0; i < room_number.size(); i++) {
                total += room_number.get(i) * room_price.get(i);
                total += room_selected_addbed.get(i)*30;
            }
            total_price.setText("RM" + String.valueOf(total));
        }else{
            int index = room_name_addbed.indexOf(name);
            int index_ori = room_name.indexOf(name.substring(0,name.length()-9));

            Log.i("test minusplus roomname", name_textView.getText().toString());

            Log.i("test minusplus index", String.valueOf(index));
            Log.i("test minusplus index", String.valueOf(room_number.get(index_ori)));

                int update_selected = room_selected_addbed.get(index_ori)+1;
                int update = room_number.get(index_ori)+1;
                room_number.set(index_ori, update);
                room_selected_addbed.set(index_ori, update_selected);
                number.setText(String.valueOf(room_selected_addbed.get(index_ori)));
                total = 0;
                for(int i=0;i<room_number.size();i++){
                    total+=room_number.get(i)*room_price.get(i);
                    total+=room_selected_addbed.get(i)*30;
                }
                total_price.setText("RM"+String.valueOf(total));

        }
    }
}
