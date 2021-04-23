package com.example.shopping;

import android.content.Intent;
import android.os.Bundle;
import android.webkit.WebSettings;
import android.webkit.WebView;
import android.webkit.WebViewClient;
import android.widget.FrameLayout;

import com.google.android.material.navigation.NavigationView;


public class productsListActivity extends BaseActivity {

    private SessionManager session;
    private WebView webView = null;
    private String userID= "0";
    private String item_type = "1";
    private String categ_id = "0";

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        FrameLayout contentFrameLayout = (FrameLayout) findViewById(R.id.content_frame);
        getLayoutInflater().inflate(R.layout.web_charging, contentFrameLayout);
        NavigationView navigationView = (NavigationView) findViewById(R.id.nav_view);
        navigationView.getMenu().getItem(0).setChecked(true);

        session = new SessionManager(getApplicationContext());


        session.checkLogin();

        userID = session.getUserDetails().get("ID");

        WebView webView = (WebView) findViewById(R.id.webview);

        WebSettings webSettings = webView.getSettings();
        webSettings.setJavaScriptEnabled(true);
        webSettings.setDomStorageEnabled(true);
        JavaScriptReceiver javaScriptReceiver;
        javaScriptReceiver = new JavaScriptReceiver(productsListActivity.this);
        webView.addJavascriptInterface(javaScriptReceiver, "JSReceiver");

        webView.setWebViewClient(new WebViewClient());

        Intent i  = getIntent();
        Bundle extra = i.getExtras();

        if(extra != null && extra.containsKey("categ_id"))
        {
            categ_id = extra.getString("categ_id");
        }

        if(extra != null && extra.containsKey("item_type"))
        {
            item_type = extra.getString("item_type");
        }

        String lang = "en";
        if(session.getLang() != null && session.getLang().equals("ar"))
            lang = "ar";

        webView.loadUrl(URLS.URL_MAIN_PRODUCTS+"?categ_id="+categ_id+"&item_type="+item_type+"&lang="+lang);
    }



}
