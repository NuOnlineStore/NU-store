package com.example.shopping;

import android.content.Intent;
import android.os.Bundle;
import android.view.View;
import android.webkit.WebSettings;
import android.webkit.WebView;
import android.webkit.WebViewClient;
import android.widget.Button;
import android.widget.FrameLayout;


import com.google.android.material.navigation.NavigationView;


public class MainActivity  extends BaseActivity {

    private SessionManager session;
    private WebView webView = null;
    private String userID= "0";
    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        FrameLayout contentFrameLayout = (FrameLayout) findViewById(R.id.content_frame);
        getLayoutInflater().inflate(R.layout.main, contentFrameLayout);
        NavigationView navigationView = (NavigationView) findViewById(R.id.nav_view);
        navigationView.getMenu().getItem(0).setChecked(true);

        session = new SessionManager(getApplicationContext());


        session.checkLogin();

        userID = session.getUserDetails().get("ID");

        Button servicesBtn = (Button) findViewById(R.id.servicesBtn);
        Button prodctsBtn = (Button) findViewById(R.id.prodctsBtn);



        prodctsBtn.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                Intent i = new Intent(getApplicationContext(), productsListActivity.class);
                startActivity(i);
            }
        });
        servicesBtn.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                Intent i = new Intent(getApplicationContext(), productsListActivity.class);
                i.putExtra("item_type" , "2");
                startActivity(i);
            }
        });
    }



}
