package com.example.hotelnest;

import androidx.appcompat.app.AppCompatActivity;

import android.content.Intent;
import android.content.SharedPreferences;
import android.os.Bundle;
import android.view.View;
import android.widget.Button;
import android.widget.EditText;
import android.widget.TextView;

import com.android.volley.Request;
import com.android.volley.RequestQueue;
import com.android.volley.Response;
import com.android.volley.VolleyError;
import com.android.volley.toolbox.StringRequest;
import com.android.volley.toolbox.Volley;

import java.util.HashMap;
import java.util.Map;

public class MainActivity extends AppCompatActivity {

    private Button signUpButton;
    private Button signInButton;
    private TextView message;
    private EditText email;
    private EditText password;
    private String email_string;
    private String password_string;

    private SharedPreferences preferences;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_main);
        message=findViewById(R.id.message);
        email=findViewById(R.id.loginEmail);
        password=findViewById(R.id.loginPassword);
        signUpButton = findViewById(R.id.signUpButton);
        preferences = getSharedPreferences("Wodget", MODE_PRIVATE);
        signUpButton.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                openSignUpActivity();
            }
        });

        signInButton = findViewById(R.id.signInButton);

        signInButton.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                email_string = email.getText().toString();
                password_string = password.getText().toString();


                    RequestQueue queue = Volley.newRequestQueue(getApplicationContext());
                    String url = "http://10.0.2.2:8000/loginUser";

                    // Request a string response from the provided URL.
                    StringRequest stringRequest = new StringRequest(Request.Method.POST, url,
                            new Response.Listener<String>() {
                                @Override
                                public void onResponse(String response) {
                                    // Display the first 500 characters of the response string.
                                        if(response.equals(password_string)){
                                            message.setText("Login Successful!");
                                            SharedPreferences.Editor editor = preferences.edit();
                                            int count = preferences.getInt("count", 0);
                                            editor.putInt("count", ++count);// 存入数据
                                            editor.commit();// 提交修改
                                            openHomeActivity();
                                        }else{
                                            message.setText("The email or password is wrong!");
                                        }
                                }
                            }, new Response.ErrorListener() {
                        @Override
                        public void onErrorResponse(VolleyError error) {
                            error.printStackTrace();
                                message.setText("Server Error.");
                        }
                    }) {
                        @Override
                        protected Map<String, String> getParams() {
                            Map<String, String> params = new HashMap<String, String>();
                            params.put("email", email_string);
                            params.put("password", password_string);
                            return params;
                        }
                    };
                    queue.add(stringRequest);


                    //openHomeActivity();
                }

        });
    }

    public void openSignUpActivity(){
        Intent intent = new Intent(this, SignUpActivity.class);
        startActivity(intent);
    }

    public void openHomeActivity(){
        Intent intent = new Intent(this, home_activity.class);
        intent.putExtra("email", email_string);
        startActivity(intent);
    }
}
