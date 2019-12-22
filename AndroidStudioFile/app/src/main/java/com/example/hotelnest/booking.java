package com.example.hotelnest;

import androidx.appcompat.app.AppCompatActivity;

import android.content.Intent;
import android.os.Bundle;
import android.view.View;
import android.widget.Button;
import android.widget.ImageView;
import android.widget.ListView;
import android.widget.SimpleAdapter;
import android.widget.TextView;

import java.util.ArrayList;
import java.util.HashMap;
import java.util.List;

public class booking extends AppCompatActivity {
    //$request->fullName, $request->email, $request->phone, $request->icNum,
    //$request->checkInDate, $request->checkOutDate, $request->remark, $request->adult, $request->child,
    //         $request->totalPrice, $request->hotelId, $request->roomId, $request->addBed);
    private String email, checkInDate, checkOutDate, hotel_name;
    private int adult, child, totalPrice, hotelId, nights,hotelicon_drawable, star;

    private ArrayList<Integer> room_number, room_id, room_selected_addbed, room_price;
    private ArrayList<String> room_name;
    private ListView listview;
    private List<HashMap<String, Object>> lstDraftItem;
    private SimpleAdapter adapter;
    private int[] roomId, addBed;

    private TextView hotelname, checkin, checkout, days_nights, total;
    private ImageView hotelicon, star1, star2, star3, star4, star5;

    private Button next_button;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_booking);

        hotelname = findViewById(R.id.booking_hotel_name);
        checkin = findViewById(R.id.booking_checkin);
        checkout = findViewById(R.id.booking_checkout);
        days_nights = findViewById(R.id.days_nights);
        total = findViewById(R.id.booking_total_price);
        hotelicon = findViewById(R.id.hotelicon);
        star1 = findViewById(R.id.star1);
        star2 = findViewById(R.id.star2);
        star3 = findViewById(R.id.star3);
        star4 = findViewById(R.id.star4);
        star5 = findViewById(R.id.star5);

        star = getIntent().getIntExtra("hotel_star", 0);
        hotelicon_drawable = getIntent().getIntExtra("hotelicon_drawable", 0);
        nights = getIntent().getIntExtra("nights", 0);
        room_name = getIntent().getStringArrayListExtra("room_name");
        hotelId = getIntent().getIntExtra("hotelId", -1);
        room_id = getIntent().getIntegerArrayListExtra("room_Id");
        checkInDate = getIntent().getStringExtra("checkInDate");
        checkOutDate = getIntent().getStringExtra("checkOutDate");
        totalPrice = getIntent().getIntExtra("totalPrice", -1);
        adult = getIntent().getIntExtra("adult", -1);
        child = getIntent().getIntExtra("child", -1);
        email = getIntent().getStringExtra("email");
        hotel_name = getIntent().getStringExtra("hotel_name");
        room_number = getIntent().getIntegerArrayListExtra("room_number");
        room_selected_addbed = getIntent().getIntegerArrayListExtra("room_selected_addbed");
        room_price = getIntent().getIntegerArrayListExtra("room_price");

        hotelname.setText(hotel_name);
        checkin.setText(checkInDate);
        checkout.setText(checkOutDate);
        days_nights.setText((nights+1)+" days, "+nights+" nights");
        hotelicon.setImageResource(hotelicon_drawable);

        switch (star){
            case 1:
                star1.setImageResource(R.drawable.filled_star);
                break;
            case 2:
                star1.setImageResource(R.drawable.filled_star);
                star2.setImageResource(R.drawable.filled_star);

                break;
            case 3:
                star1.setImageResource(R.drawable.filled_star);
                star2.setImageResource(R.drawable.filled_star);
                star3.setImageResource(R.drawable.filled_star);

                break;
            case 4:
                star1.setImageResource(R.drawable.filled_star);
                star2.setImageResource(R.drawable.filled_star);
                star3.setImageResource(R.drawable.filled_star);
                star4.setImageResource(R.drawable.filled_star);
                break;
            case 5:
                star1.setImageResource(R.drawable.filled_star);
                star2.setImageResource(R.drawable.filled_star);
                star3.setImageResource(R.drawable.filled_star);
                star4.setImageResource(R.drawable.filled_star);
                star5.setImageResource(R.drawable.filled_star);
                break;

            default:

        }

        listview = findViewById(R.id.cart_list);
        lstDraftItem = new ArrayList<HashMap<String, Object>>();
        //适配器SimpleAdapter数据绑定
        //错误:构造函数SimpleAdapter未定义 需把this修改为MainActivity.this
        adapter = new SimpleAdapter(this, lstDraftItem, R.layout.booking_list,
                new String[]{"room_name", "price_night", "room_total_price", "addbed_number", "addbed_price"},
                new int[]{R.id.booking_room_name, R.id.booking_price_night, R.id.booking_room_price, R.id.booking_addbed_number, R.id.booking_addbed_price});

        totalPrice=0;
        for(int i=0;i<room_name.size();i++){
            if(room_number.get(i)>0){
                HashMap<String, Object> map = new HashMap<String, Object>();
                map.put("room_name", room_name.get(i));
                map.put("price_night", "RM"+room_price.get(i)+" x "+room_number.get(i)+"rooms x "+ nights+"nights");
                map.put("room_total_price", "RM"+(room_price.get(i)*room_number.get(i)*nights));
                totalPrice+=room_price.get(i)*room_number.get(i)*nights;
                map.put("addbed_number", "Added Bed x "+room_selected_addbed.get(i)+" rooms");
                map.put("addbed_price", "RM"+(room_selected_addbed.get(i)*30));
                lstDraftItem.add(map);
            }
        }
        listview.setAdapter(adapter);
        total.setText("RM"+totalPrice);

        next_button = findViewById(R.id.next_button);
        next_button.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                //$request->fullName, $request->email, $request->phone, $request->icNum,
                //$request->checkInDate, $request->checkOutDate, $request->remark, $request->adult, $request->child,
                //         $request->totalPrice, $request->hotelId, $request->roomId, $request->addBed);
                // private String email, checkInDate, checkOutDate, hotel_name;
                //    private int adult, child, totalPrice, hotelId, nights,hotelicon_drawable, star;
                //
                //    private ArrayList<Integer> room_number, room_id, room_selected_addbed, room_price;
                //    private ArrayList<String> room_name;
                //    private ListView listview;
                //    private List<HashMap<String, Object>> lstDraftItem;
                //    private SimpleAdapter adapter;
                //
                //    private TextView hotelname, checkin, checkout, days_nights, total;
                //    private ImageView hotelicon, star1, star2, star3, star4, star5;
                //
                //    private Button next_button;
                ArrayList<Integer> temp = new ArrayList<>();
                ArrayList<Integer> temp_addbed = new ArrayList<>();
                for(int i=0;i<room_id.size();i++){
                    for(int j=0;j<room_number.get(i);j++){
                        temp.add(room_id.get(i));
                        if(room_selected_addbed.get(i)>0){
                            int update = room_selected_addbed.get(i)-1;
                            room_selected_addbed.set(i, update);
                            temp_addbed.add(1);
                        }else {
                            temp_addbed.add(0);
                        }
                    }
                }

                roomId = new int[temp.size()];
                addBed = new int[temp.size()];
                for(int i=0;i<temp.size();i++){
                    roomId[i] = temp.get(i);
                    addBed[i] = temp_addbed.get(i);
                }


                Intent intent = new Intent(getBaseContext(), booking_details.class);
                intent.putExtra("email", email);
                intent.putExtra("checkInDate", checkInDate);
                intent.putExtra("checkOutDate", checkOutDate);
                intent.putExtra("adult", adult);
                intent.putExtra("child", child);
                intent.putExtra("totalPrice", totalPrice);
                intent.putExtra("hotelId", hotelId);
                intent.putExtra("roomId", roomId);
                intent.putExtra("addBed", addBed);
                startActivity(intent);


            }
        });

    }
}
