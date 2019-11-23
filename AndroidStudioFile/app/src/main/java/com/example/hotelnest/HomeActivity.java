package com.example.hotelnest;


import androidx.appcompat.app.AppCompatActivity;

import android.os.Bundle;
import android.widget.TextView;

import com.applandeo.materialcalendarview.CalendarView;
import com.applandeo.materialcalendarview.EventDay;
import com.applandeo.materialcalendarview.listeners.OnDayClickListener;
import com.applandeo.materialcalendarview.listeners.OnSelectDateListener;

import java.text.SimpleDateFormat;
import java.util.ArrayList;
import java.util.Calendar;

import java.util.List;


public class HomeActivity extends AppCompatActivity {

    private CalendarView calendarView;
    private TextView checkInDate;
    private TextView checkOutDate;
    private SimpleDateFormat f = new SimpleDateFormat("EEE, dd MMM yyyy");
    private Calendar currentSelecting = null;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_home);

        checkInDate = findViewById(R.id.checkInDate);
        checkOutDate = findViewById(R.id.checkOutDate);
        calendarView = findViewById(R.id.calendarView);

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
    }

    private OnSelectDateListener listener = new OnSelectDateListener() {
        @Override
        public void onSelect(List<Calendar> calendar) {
            List<Calendar> selectedDates = calendarView.getSelectedDates();
            checkInDate.setText(selectedDates.get(0).toString());
            checkOutDate.setText(selectedDates.get(selectedDates.size()).toString());
        }
    };


}
