package com.example.shopping;

import android.app.Activity;
import android.app.ProgressDialog;
import android.content.DialogInterface;
import android.content.Intent;
import android.os.Bundle;
import android.text.TextUtils;
import android.view.MenuItem;
import android.view.View;
import android.widget.Button;
import android.widget.EditText;
import android.widget.TextView;
import android.widget.Toast;

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
import java.util.regex.Matcher;
import java.util.regex.Pattern;

public class register extends Activity {

    // Session Manager Class
    SessionManager session;

    private Button btnRegister;
    public AlertDialogManager alert ;
    EditText txtUsername,txtEmail, txtPassword, txtPhoneNumber, txtAcademicId , RetxtPassword;


    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.register);
        session = new SessionManager(getApplicationContext());
        alert = new AlertDialogManager(register.this);
        // Email, Password input text
        txtUsername = (EditText) findViewById(R.id.txtUsername);
        txtPassword = (EditText) findViewById(R.id.txtPassword);
        txtEmail = (EditText) findViewById(R.id.txtEmail);
        txtPhoneNumber = (EditText) findViewById(R.id.txtPhoneNumber);
        txtAcademicId = (EditText) findViewById(R.id.txtAcademicId);
        RetxtPassword = (EditText) findViewById(R.id.RetxtPassword);


        // Login button
        btnRegister = (Button) findViewById(R.id.btnRegister);

        // Login button click event
        btnRegister.setOnClickListener(new View.OnClickListener() {

            @Override
            public void onClick(View arg0) {

                if(validation()){
                    doPostRequest();
                }

            }
        });

    }

    String email, password, phone, ac_id,username;
    public boolean validation(){
        boolean validData = true;
        username = txtUsername.getText().toString().trim();
        email = txtEmail.getText().toString().trim();
        password = txtPassword.getText().toString().trim();


        phone =txtPhoneNumber.getText().toString().trim();
        ac_id =txtAcademicId.getText().toString().trim();

        //validations
        if (TextUtils.isEmpty(username)) {
            txtUsername.setError("You must set your name");
            txtUsername.requestFocus();
            validData = false;
        }



        String regex = "\\d+";
        String regEx = "\\b[A-Za-z0-9._%+-]+@[A-Za-z0-9.-]+\\.[A-Za-z]{2,4}\\b";
        Pattern p = Pattern.compile(regEx);
        Matcher m = p.matcher(phone);

        if (TextUtils.isEmpty(email)) {
            txtEmail.setError("Email is required");
            txtEmail.requestFocus();
            validData = false;
        }

        if (!android.util.Patterns.EMAIL_ADDRESS.matcher(email).matches()) {
            txtEmail.setError("Please set invalid email");
            txtEmail.requestFocus();
            validData = false;
        }

        if (TextUtils.isEmpty(phone)) {
            txtPhoneNumber.setError("please set your phone");
            txtPhoneNumber.requestFocus();
            validData = false;
        }else if(phone.length() != 10){
            txtPhoneNumber.setError("PHone number must be 10 numbers");
            txtPhoneNumber.requestFocus();
            validData = false;
        }else if(m.matches()){
            txtPhoneNumber.setError("Input must be only numbers");
            txtPhoneNumber.requestFocus();
            validData = false;
        }

        if (TextUtils.isEmpty(ac_id)) {
            txtAcademicId.setError("You must write your academic ID");
            txtAcademicId.requestFocus();
            validData = false;
        }


        if (TextUtils.isEmpty(password)) {
            txtPassword.setError("You must set your password");
            txtPassword.requestFocus();
            validData = false;
        }
        if (TextUtils.isEmpty(password)) {
            txtPassword.setError("You must set your password");
            txtPassword.requestFocus();
            validData = false;
        }

        String repassword = RetxtPassword.getText().toString();
        if (TextUtils.isEmpty(repassword)) {
            RetxtPassword.setError("You must confirm your password");
            RetxtPassword.requestFocus();
            validData = false;
        }

        if (!repassword.equals(password)) {
            RetxtPassword.setError("Password are not match");
            RetxtPassword.requestFocus();
            validData = false;
        }
        return validData;
    }


    private void doPostRequest() {
        String request = URLS.URL_REGISTER;
        final ProgressDialog loading = ProgressDialog.show(this, "Loading", "Please wait...", false, false);

        //Creating a string request
        StringRequest stringRequest = new StringRequest(Request.Method.POST, request,
                new Response.Listener<String>() {
                    @Override
                    public void onResponse(String response) {
                        loading.dismiss();
                        doAction(response);
                        //Toast.makeText(login.this, response, Toast.LENGTH_LONG).show();
                    }
                },
                new Response.ErrorListener() {
                    @Override
                    public void onErrorResponse(VolleyError error) {
                        loading.dismiss();
                        Toast.makeText(register.this,error.toString(), Toast.LENGTH_LONG).show();
                    }
                }){
            @Override
            protected Map<String, String> getParams(){
                Map<String, String> params = new HashMap<String, String>();

                params.put("UserName",username);
                params.put("Email",email);
                params.put("Password",password);
                params.put("Phone",phone);
                params.put("academic_id",ac_id);
                return params;
            }

        };

        //Adding the request to request queue
        RequestQueue requestQueue = Volley.newRequestQueue(this);
        requestQueue.add(stringRequest);
    }

    private JSONArray users = null;
    private String json;
    private String userID = "0";
    private String userName = "";

    public void doAction(String response){
        JSONObject jsonObject = null;
        try {
            jsonObject = new JSONObject(response);
            users = jsonObject.getJSONArray("result");

            JSONObject jo = users.getJSONObject(0);
            String success = jo.getString("success");

            if(success.equals("1")){
                onSuccess();
            }else{
                onField();
            }
        } catch (JSONException e) {
            e.printStackTrace();
        }
    }

    private void onField() {
        // username / password doesn't match
        alert.showAlertDialog(register.this, getString(R.string.login_failed), getString(R.string.username_pass_wrong), false);
        //Toast.makeText(login.this,"Database or cennection error",Toast.LENGTH_LONG).show();
    }

    private void onSuccess(){

        alert.showMessageOKCancel("Your account is created successfully", new DialogInterface.OnClickListener() {
            @Override
            public void onClick(DialogInterface dialog, int which) {
                Intent i = new Intent(getApplicationContext(), login.class);
                startActivity(i);
                finish();
            }
        });
    }

    @Override
    public boolean onOptionsItemSelected(MenuItem item) {
        switch (item.getItemId()) {
            case android.R.id.home:

                // app icon in action bar clicked; goto parent activity.
                this.finish();
                return true;
            default:
                return super.onOptionsItemSelected(item);
        }
    }

}
