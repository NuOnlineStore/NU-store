package com.example.shopping;

import android.content.Intent;
import android.os.Bundle;
import android.view.View;
import android.webkit.WebSettings;
import android.webkit.WebView;
import android.webkit.WebViewClient;
import android.widget.Button;
import android.widget.FrameLayout;
import android.widget.ImageView;
import android.widget.TextView;

import androidx.core.content.ContextCompat;

import com.google.android.material.navigation.NavigationView;


public class msgActivity extends BaseActivity {

    private SessionManager session;
    private WebView webView = null;
    private String userID= "0";
    private String msg, operation;;
    private boolean success;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        FrameLayout contentFrameLayout = (FrameLayout) findViewById(R.id.content_frame);
        getLayoutInflater().inflate(R.layout.msg_activity, contentFrameLayout);
        NavigationView navigationView = (NavigationView) findViewById(R.id.nav_view);
        navigationView.getMenu().getItem(0).setChecked(true);

        session = new SessionManager(getApplicationContext());


        session.checkLogin();

        userID = session.getUserDetails().get("ID");


        Intent intent = getIntent();
        Bundle extra = intent.getExtras();
        if (extra != null) {
            if (extra.containsKey("msg")) {
                msg = extra.getString("msg");
                operation = extra.getString("operation");
                success = extra.getBoolean("success");
            }
        }

        ImageView img = (ImageView)findViewById(R.id.msg_icon);
        if(success)
            img.setImageDrawable(ContextCompat.getDrawable(getApplicationContext(), R.drawable.success_png));
        else
            img.setImageDrawable(ContextCompat.getDrawable(getApplicationContext(), R.drawable.error));

        TextView msgTxt = (TextView)findViewById(R.id.msgLbl);
        msgTxt.setText(msg);
        Button back = (Button)findViewById(R.id.backBtn);
        back.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                if(operation.equals("check_done")){
                    Intent i = new Intent(msgActivity.this, myOrderListActivity.class);
                    startActivity(i);
                }else {
                    finish();
                }
            }
        });
    }



}
