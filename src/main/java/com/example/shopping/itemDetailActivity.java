package com.example.shopping;

import android.content.Intent;
import android.os.Bundle;
import android.webkit.WebSettings;
import android.webkit.WebView;
import android.webkit.WebViewClient;
import android.widget.FrameLayout;

import com.google.android.material.navigation.NavigationView;


public class itemDetailActivity extends BaseActivity {

    private SessionManager session;
    private WebView webView = null;
    private String userID= "0";
    private String item_id = "0";

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        FrameLayout contentFrameLayout = (FrameLayout) findViewById(R.id.content_frame);
        getLayoutInflater().inflate(R.layout.web_charging, contentFrameLayout);
        NavigationView navigationView = (NavigationView) findViewById(R.id.nav_view);
        navigationView.getMenu().getItem(0).setChecked(true);

        init();
    }

    private void init() {

        session = new SessionManager(getApplicationContext());


        session.checkLogin();

        userID = session.getUserDetails().get("ID");

        WebView webView = (WebView) findViewById(R.id.webview);

        WebSettings webSettings = webView.getSettings();
        webSettings.setJavaScriptEnabled(true);
        webSettings.setDomStorageEnabled(true);
        JavaScriptReceiver javaScriptReceiver;
        javaScriptReceiver = new JavaScriptReceiver(itemDetailActivity.this);
        webView.addJavascriptInterface(javaScriptReceiver, "JSReceiver");

        webView.setWebViewClient(new WebViewClient());

        Intent intent = getIntent();
        Bundle extra = intent.getExtras();
        if (extra != null) {
            if (extra.containsKey("item_id")) {
                item_id = extra.getString("item_id");
            }
        }
        String lang = "en";
        if(session.getLang() != null && session.getLang().equals("ar"))
            lang = "ar";
        webView.loadUrl(URLS.URL_ITEM_DETAIL+"?item_id="+item_id+"&user_id="+userID+"&lang="+lang);
    }

    @Override
    public void onResume()
    {  // After a pause OR at startup
        super.onResume();
        init();
    }


}
