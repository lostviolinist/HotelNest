package com.example.hotelnest;

import android.content.Context;
import android.content.Intent;
import android.content.SharedPreferences;
import android.os.Bundle;
import android.preference.PreferenceManager;
import android.util.Log;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.Button;
import android.widget.EditText;
import android.widget.ImageButton;
import android.widget.TextView;

import androidx.annotation.NonNull;
import androidx.annotation.Nullable;
import androidx.fragment.app.Fragment;

import com.applandeo.materialcalendarview.CalendarView;
import com.applandeo.materialcalendarview.EventDay;
import com.applandeo.materialcalendarview.listeners.OnDayClickListener;
import com.applandeo.materialcalendarview.listeners.OnSelectDateListener;

import java.text.DateFormat;
import java.text.ParseException;
import java.text.SimpleDateFormat;
import java.util.ArrayList;
import java.util.Calendar;
import java.util.Date;
import java.util.List;
import java.util.concurrent.TimeUnit;

public class SearchFragment extends Fragment {
    private CalendarView calendarView;
    private TextView checkInDate;
    private TextView checkOutDate;
    private SimpleDateFormat f = new SimpleDateFormat("EEE, dd MMM yyyy");
    private Calendar currentSelecting = null;

    private ImageButton adult_plus;
    private ImageButton adult_minus;
    private ImageButton children_plus;
    private ImageButton children_minus;
    private ImageButton room_plus;
    private ImageButton room_minus;

    private EditText adult_number;
    private EditText children_number;
    private EditText room_number;
    private EditText city_edittext;

    private ImageButton search_button;

    private String email;
    private String userId;

    private int nights;

    private SharedPreferences preferences;
    @Nullable
    @Override
    public View onCreateView(@NonNull LayoutInflater inflater, @Nullable ViewGroup container, @Nullable Bundle savedInstanceState) {
        View view = inflater.inflate(R.layout.fragment_search, container, false);
        email = getActivity().getIntent().getStringExtra("email");
        userId = getActivity().getIntent().getStringExtra("userId");
        if(email==null||userId==null){
            SharedPreferences prefs = PreferenceManager.getDefaultSharedPreferences(getActivity());
            email = prefs.getString("email", "defaultStringIfNothingFound");
            userId = prefs.getString("userId", "defaultStringIfNothingFound");

        }

        checkInDate = view.findViewById(R.id.checkInDate);
        checkOutDate = view.findViewById(R.id.checkOutDate);
        calendarView = view.findViewById(R.id.calendarView);
        adult_plus = view.findViewById(R.id.adult_plus_button);
        adult_minus = view.findViewById(R.id.adult_minus_button);
        adult_number = view.findViewById(R.id.adult_number);
        children_plus = view.findViewById(R.id.children_plus_button);
        children_minus = view.findViewById(R.id.children_minus_button);
        children_number = view.findViewById(R.id.children_number);
        room_plus = view.findViewById(R.id.room_plus_button);
        room_minus = view.findViewById(R.id.room_minus_button);
        room_number = view.findViewById(R.id.room_number);
        city_edittext = view.findViewById(R.id.city);
        search_button = view.findViewById(R.id.searchButton);
        preferences = getActivity().getSharedPreferences("Wodget", Context.MODE_PRIVATE);

        Calendar yesterday, today, tomorrow;
        today = Calendar.getInstance();
        yesterday = Calendar.getInstance();
        tomorrow = Calendar.getInstance();
        yesterday.add(Calendar.DATE,-1);
        tomorrow.add(Calendar.DATE,1);

        checkInDate.setText(f.format(today.getTime()));

        checkOutDate.setText(f.format(tomorrow.getTime()));


        calendarView.setMinimumDate(yesterday);
        List<Calendar> calendars = new ArrayList<>();
        calendars.add(today);
        calendars.add(tomorrow);
        calendarView.setSelectedDates(calendars);
        nights = 1;



        calendarView.setOnDayClickListener(new OnDayClickListener() {
            @Override
            public void onDayClick(EventDay eventDay) {
                if(currentSelecting==null){
                    currentSelecting = eventDay.getCalendar();
                    checkInDate.setText(f.format(currentSelecting.getTime()));
                    checkOutDate.setText(" ");
                }

                if(eventDay.getCalendar()!=currentSelecting){
                    Calendar start, end;
                    if(eventDay.getCalendar().before(currentSelecting)){
                        checkInDate.setText(f.format(eventDay.getCalendar().getTime()));
                        checkOutDate.setText(f.format(currentSelecting.getTime()));

                    }else{
                        checkInDate.setText(f.format(currentSelecting.getTime()));
                        checkOutDate.setText(f.format(eventDay.getCalendar().getTime()));

                    }



                    currentSelecting=null;
                }





            }
        });

        adult_plus.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                adult_number.setText(String.valueOf(Integer.parseInt(adult_number.getText().toString())+1));
            }
        });

        adult_minus.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                if(Integer.parseInt(adult_number.getText().toString())>1) {
                    adult_number.setText(String.valueOf(Integer.parseInt(adult_number.getText().toString()) - 1));
                }
            }
        });

        children_plus.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                children_number.setText(String.valueOf(Integer.parseInt(children_number.getText().toString())+1));
            }
        });

        children_minus.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                if(Integer.parseInt(children_number.getText().toString())>0) {
                    children_number.setText(String.valueOf(Integer.parseInt(children_number.getText().toString()) - 1));
                }
            }
        });

        room_plus.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                room_number.setText(String.valueOf(Integer.parseInt(room_number.getText().toString())+1));
            }
        });

        room_minus.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                if(Integer.parseInt(room_number.getText().toString())>1) {
                    room_number.setText(String.valueOf(Integer.parseInt(room_number.getText().toString()) - 1));
                }
            }
        });

        search_button.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                String city, adult, child, room, checkInDateT, checkOutDateT;

                DateFormat format = new SimpleDateFormat("dd MMM yyyy");
                if(city_edittext.getText().toString().equals("")){
                    city = "Kuala Lumpur";
                }else {
                    city = city_edittext.getText().toString();
                }
                adult = adult_number.getText().toString();
                child = children_number.getText().toString();
                room = room_number.getText().toString();
                try {
                    checkInDateT = checkInDate.getText().toString().substring(5);
                    checkOutDateT = checkOutDate.getText().toString().substring(5);

                        Date date1 = format.parse(checkInDateT);
                        Date date2 = format.parse(checkOutDateT);
                        long diff = date2.getTime() - date1.getTime();
                        System.out.println ("Days: " + TimeUnit.DAYS.convert(diff, TimeUnit.MILLISECONDS));

                    nights = (int)(diff / (1000*60*60*24));
                    Intent intent = new Intent(getActivity(), search_result_activity.class);
                    intent.putExtra("city", city);
                    intent.putExtra("adult", adult);
                    intent.putExtra("child", child);
                    intent.putExtra("room", room);
                    intent.putExtra("checkInDate", checkInDateT);
                    intent.putExtra("checkOutDate", checkOutDateT);
                    intent.putExtra("email", email);
                    intent.putExtra("nights", nights);
                    intent.putExtra("userId", userId);
                    Log.i("search put userId", userId);
                    startActivity(intent);
                }catch(Exception e){

                }



            }
        });

        return view;
}



}
