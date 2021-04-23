package com.example.shopping;

import android.app.Activity;
import android.app.ProgressDialog;
import android.content.Intent;
import android.os.Bundle;
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

public class login extends Activity {

    // Session Manager Class
    SessionManager session;
    // Email, password edittext
    EditText txtUsername, txtPassword;
    private Button btnLogin;// Alert Dialog Manager
    AlertDialogManager alert = new AlertDialogManager();
    private String serverName;
    private TextView newUser;

    private String sectionName;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.login);

        session = new SessionManager(getApplicationContext());
        txtUsername = (EditText) findViewById(R.id.txtUsername);
        txtPassword = (EditText) findViewById(R.id.txtPassword);
        if(session. isLoggedIn()){
            Intent i = new Intent(getApplicationContext(), MainActivity.class);
            startActivity(i);
            finish();
        }

        // Login button
        btnLogin = (Button) findViewById(R.id.btnLogin);

        // Login button click event
        btnLogin.setOnClickListener(new View.OnClickListener() {

            @Override
            public void onClick(View arg0) {
                // Get username, password from EditText
                String username = txtUsername.getText().toString();
                String password = txtPassword.getText().toString();

                // Check if username, password is filled

                if(username.trim().length() > 0 && password.trim().length() > 0){
                    if(!validation()){
                        Toast.makeText(getApplicationContext(), "You must write invalid email", Toast.LENGTH_SHORT)
                                .show();
                        alert.showAlertDialog(login.this, getString(R.string.login_failed), getString(R.string.invalid_email), false);
                    }else{
                        doPostRequest();
                    }
                }else{
                    // user didn't entered username or password
                    // Show alert asking him to enter the details
                    alert.showAlertDialog(login.this, getString(R.string.login_failed), getString(R.string.username_pass_empty), false);
                }

            }
        });

        TextView newAccLbl = (TextView)findViewById(R.id.newAccLbl);
        newAccLbl.setOnClickListener(new View.OnClickListener(){

            @Override
            public void onClick(View v) {
                Intent i = new Intent(getApplicationContext(), register.class);
                startActivity(i);
            }
        });
        TextView forgetPass = (TextView)findViewById(R.id.forgetPass);
        forgetPass.setOnClickListener(new View.OnClickListener(){

            @Override
            public void onClick(View v) {
                Intent i = new Intent(getApplicationContext(), forgetPasswordActivity.class);
                startActivity(i);
            }
        });
    }


    private boolean validation(){
        boolean validData = true;
        Pattern p = Pattern.compile(URLS.regEx);
        Matcher m = p.matcher(txtUsername.getText().toString());

        if (!m.find()){
            validData = false;
        }
        return validData;
    }
    private void doPostRequest() {
        String em = txtUsername.getText().toString();
        String pass = txtPassword.getText().toString();

        String request = URLS.URL_LOGIN;
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
                        Toast.makeText(login.this,error.toString(), Toast.LENGTH_LONG).show();
                    }
                }){
            @Override
            protected Map<String, String> getParams(){
                Map<String, String> params = new HashMap<String, String>();
                params.put("Email",txtUsername.getText().toString());
                params.put("UserPass",txtPassword.getText().toString());
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
    private String userT = "0";

    public void doAction(String response){
        JSONObject jsonObject = null;
        try {
            jsonObject = new JSONObject(response);
            users = jsonObject.getJSONArray("result");

            JSONObject jo = users.getJSONObject(0);
            String success = jo.getString("success");

            if(success.equals("1")){
                for(int i=1;i<users.length();i++){
                    jo = users.getJSONObject(i);
                    userID = jo.getString("id");
                    userName = jo.getString("name");
                    String active = jo.getString("active");
                    if(active.equals("0")){
                        alert.showAlertDialog(login.this, "Error", "Account not active, please contact with administrator", false);
                        return ;
                    }

                }
                session.createLoginSession(userName, txtUsername.getText().toString() ,userID);

                Intent i = new Intent(getApplicationContext(), MainActivity.class);
                startActivity(i);
                finish();
            }else{
                // username / password doesn't match
                alert.showAlertDialog(login.this, getString(R.string.login_failed), getString(R.string.username_pass_wrong), false);
                //Toast.makeText(login.this,"Database or cennection error",Toast.LENGTH_LONG).show();
            }
        } catch (JSONException e) {
            e.printStackTrace();
        }
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
