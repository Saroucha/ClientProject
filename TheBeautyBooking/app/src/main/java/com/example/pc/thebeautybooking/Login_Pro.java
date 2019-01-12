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

public class Login_Pro extends AppCompatActivity {
private EditText email,password;
    private Button btn_login;
    private TextView link_regist;
    private ProgressBar loading;
    private static String URL_LOGIN="http://10.0.67.75/BeautyBooking/Login_Pro.php";
    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.login_pro);
        loading.findViewById(R.id.loading);
        email.findViewById(R.id.email);
        password.findViewById(R.id.password);
        btn_login.findViewById(R.id.btn_login);
        link_regist.findViewById(R.id.link_regist);

       btn_login.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                String mEmail =email.getText().toString().trim();
                String mPass =password.getText().toString().trim();

                if(!mEmail.isEmpty()||!mPass.isEmpty() ){
                    Login(mEmail,mPass);
                }else{
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
                                    Toast.makeText(Login_Pro.this,
                                            "Success Login.\n Your Name : "+ Nom+ "\n Your Email :"+email,Toast.LENGTH_SHORT).show();
                               loading.setVisibility(View.GONE);
                                }
                            }
                        }catch (JSONException e){
                            e.printStackTrace();
                            loading.setVisibility(View.GONE);
                            btn_login.setVisibility(View.VISIBLE);
                            Toast.makeText(Login_Pro.this,"Error"+e.toString(), Toast.LENGTH_SHORT).show();
                    }}
                },
                new Response.ErrorListener() {
                    @Override
                    public void onErrorResponse(VolleyError error) {
                        loading.setVisibility(View.GONE);
                        btn_login.setVisibility(View.VISIBLE);
                        Toast.makeText(Login_Pro.this,"Error" +error.toString(), Toast.LENGTH_SHORT).show();
                    }
                })
        {
            @Override
          protected Map<String,String> getParams() throws AuthFailureError{
                Map<String,String>params = new HashMap<>();
                params.put("Email",email);
                params.put("Password",password);
                return params;
            }
        };

        RequestQueue requestQueue = Volley.newRequestQueue(this);
        requestQueue.add(stringRequest);

    }

}
