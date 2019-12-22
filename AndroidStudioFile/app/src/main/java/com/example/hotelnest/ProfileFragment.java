package com.example.hotelnest;

import android.content.Context;
import android.content.Intent;
import android.content.SharedPreferences;
import android.os.Bundle;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.Button;
import android.widget.TextView;

import androidx.annotation.NonNull;
import androidx.annotation.Nullable;
import androidx.fragment.app.Fragment;

public class ProfileFragment extends Fragment {
    private TextView username;
    private Button signout;
    private SharedPreferences preferences;
    @Nullable
    @Override
    public View onCreateView(@NonNull LayoutInflater inflater, @Nullable ViewGroup container, @Nullable Bundle savedInstanceState) {
        View view = inflater.inflate(R.layout.fragment_profile, container, false);
        preferences = getActivity().getSharedPreferences("Wodget", Context.MODE_PRIVATE);
        signout = view.findViewById(R.id.signout_buton);
        signout.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                SharedPreferences.Editor editor = preferences.edit();
                int count = preferences.getInt("count", 0);
                // 存入数据
                editor.putInt("count", 0);
                // 提交修改
                editor.commit();
                startActivity(new Intent(getActivity(), MainActivity.class));

            }
        });
        username = view.findViewById(R.id.profileUsername);
        String un = getActivity().getIntent().getStringExtra("username");
        username.setText(un);
        return view;
    }
}
