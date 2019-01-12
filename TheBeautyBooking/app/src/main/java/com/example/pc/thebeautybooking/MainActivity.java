package com.example.pc.thebeautybooking;

import android.support.v7.app.AppCompatActivity;
import android.os.Bundle;
import android.view.View;
import android.widget.Button;
import android.widget.EditText;
import android.widget.ProgressBar;
import android.widget.TextView;
import android.widget.Toast;

import com.android.volley.AuthFailureError;
import com.android.volley.DefaultRetryPolicy;
import com.android.volley.Request;
import com.android.volley.RequestQueue;
import com.android.volley.Response;
import com.android.volley.VolleyError;
import com.android.volley.toolbox.StringRequest;
import com.android.volley.toolbox.Volley;

import org.json.JSONArray;
import org.json.JSONException;
import org.json.JSONObject;

import java.util.HashMap;
import java.util.Map;

public class MainActivity extends AppCompatActivity {
private EditText email;
    private EditText password;
    private Button btn_login;
    private ProgressBar loading;
    private static String URL_LOGIN="http://172.20.10.10/Login_Pro.php";
    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_main);
        email = findViewById(R.id.email);
        password = findViewById(R.id.password);
        btn_login = findViewById(R.id.btn_login);
        loading = findViewById(R.id.loading);

        btn_login.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                String mEmail = email.getText().toString().trim();
                String mPass = password.getText().toString().trim();

                if (!mEmail.isEmpty() || !mPass.isEmpty()) {
                    Login(mEmail, mPass);
                } else {
                    email.setError("Please insert email !!");
                    password.setError("Please insert password !!");
                }

            }
        });
    }
        private void Login(final String email, final String password){
            loading.setVisibility(View.VISIBLE);
            btn_login.setVisibility(View.GONE);

            StringRequest stringRequest =new StringRequest(Request.Method.POST, URL_LOGIN, new
                    Response.Listener<String>() {
                        @Override
                        public void onResponse(String response) {
                            try {
                                JSONObject jsonObject = new JSONObject(response);
                                String success = jsonObject.getString("success");
                                JSONArray jsonArray = jsonObject.getJSONArray("login");
                                if (success.equals("1")){
                                    for(int i =0;i<jsonArray.length();i++){
                                        JSONObject object=jsonArray.getJSONObject(i);
                                        String Nom= object.getString("Nom").trim();
                                        String email = object.getString("email").trim();
                                        Toast.makeText(MainActivity.this,
                                                "Success Login.\n Your Name : "+ Nom+ "\n Your Email :"+email,Toast.LENGTH_SHORT).show();
                                        loading.setVisibility(View.GONE);


                                    }
                                }
                            }catch (JSONException e){
                                e.printStackTrace();
                                loading.setVisibility(View.GONE);
                                btn_login.setVisibility(View.VISIBLE);
                                Toast.makeText(MainActivity.this,"Error"+e.toString(), Toast.LENGTH_SHORT).show();
                            }}
                    },
                    new Response.ErrorListener() {
                        @Override
                        public void onErrorResponse(VolleyError error) {
                            loading.setVisibility(View.GONE);
                            btn_login.setVisibility(View.VISIBLE);
                            Toast.makeText(MainActivity.this,"Error" +error.toString(), Toast.LENGTH_SHORT).show();
                        }

                    })
            {
                @Override
                protected Map<String,String> getParams() throws AuthFailureError {
                    Map<String,String>params = new HashMap<>();
                    params.put("email",email);
                    params.put("password",password);
                    return params;
                }
            };

            RequestQueue requestQueue = Volley.newRequestQueue(this);
            requestQueue.add(stringRequest);


stringRequest.setRetryPolicy(new DefaultRetryPolicy(20 * 1000, 2, DefaultRetryPolicy.DEFAULT_BACKOFF_MULT));
            requestQueue.add(stringRequest);
    }
}
