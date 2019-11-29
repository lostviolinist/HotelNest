package com.example.hotelnest;

import androidx.appcompat.app.AppCompatActivity;

import android.content.Intent;
import android.graphics.Color;
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

public class SignUpActivity extends AppCompatActivity {

    private Button signInButton;
    private EditText firstName;
    private EditText lastName;
    private EditText email;
    private EditText password;
    private EditText conPassword;
    private EditText phone;
    private Button signUpButton;
    private TextView message;
    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_sign_up);
        firstName = findViewById(R.id.signUpFirstName);
        lastName = findViewById(R.id.signUpLastName);
        email = findViewById(R.id.signUpEmailAddress);
        password = findViewById(R.id.signUpPassword);
        conPassword = findViewById(R.id.signUpConfirmPassword);
        phone = findViewById(R.id.signUpPhone);
        signUpButton = findViewById(R.id.signUpButton);
        message = findViewById(R.id.message);

        signInButton = findViewById(R.id.signInButton);
        signInButton.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                openMainActivity();
            }
        });

        signUpButton.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                if(firstName.getText().toString().equals("")||lastName.getText().toString().equals("")||email.getText().toString().equals("")
                ||password.getText().toString().equals("")||conPassword.getText().toString().equals("")||phone.getText().toString().equals("")){
                    message.setText("Please fill in all fields!");
                    message.setTextColor(Color.parseColor("#EE1111"));
                }
                else if(!password.getText().toString().equals(conPassword.getText().toString())){
                    message.setText("Passwords not the same!");
                    message.setTextColor(Color.parseColor("#EE1111"));
                }
                else{
                    RequestQueue queue = Volley.newRequestQueue(getApplicationContext());
                    String url = "http://10.0.2.2:8000/registerUser";

                    // Request a string response from the provided URL.
                    StringRequest stringRequest = new StringRequest(Request.Method.POST, url,
                            new Response.Listener<String>() {
                                @Override
                                public void onResponse(String response) {
                                    // Display the first 500 characters of the response string.
                                    if(response.equals("false")){
                                        message.setText("Register not successful!");
                                        message.setTextColor(Color.parseColor("#EE1111"));
                                    }else{
                                        message.setText("Register Successful!");
                                        message.setTextColor(Color.parseColor("#EE1111"));
                                    }
                                }
                            }, new Response.ErrorListener() {
                        @Override
                        public void onErrorResponse(VolleyError error) {
                            error.printStackTrace();
                            message.setText("Server Error.");
                            message.setTextColor(Color.parseColor("#EE1111"));
                        }
                    }) {
                        @Override
                        protected Map<String, String> getParams() {
                            Map<String, String> params = new HashMap<String, String>();
                            params.put("firstName", firstName.getText().toString());
                            params.put("lastName", lastName.getText().toString());
                            params.put("email", email.getText().toString());
                            params.put("password", password.getText().toString());
                            params.put("phone", phone.getText().toString());

                            return params;
                        }
                    };
                    queue.add(stringRequest);
                }
            }
        });
    }

    public void openMainActivity(){
        Intent intent = new Intent(this, MainActivity.class);
        startActivity(intent);
    }
}
