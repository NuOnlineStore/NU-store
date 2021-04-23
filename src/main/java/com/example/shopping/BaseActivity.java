package com.example.shopping;


import android.content.Intent;
import android.content.res.Configuration;
import android.content.res.Resources;
import android.os.Bundle;
import android.view.MenuItem;

import androidx.appcompat.app.ActionBarDrawerToggle;
import androidx.appcompat.app.AppCompatActivity;
import androidx.appcompat.widget.Toolbar;
import androidx.drawerlayout.widget.DrawerLayout;

import com.google.android.material.navigation.NavigationView;

import java.util.Locale;


public class BaseActivity extends AppCompatActivity {

    DrawerLayout drawerLayout;
    ActionBarDrawerToggle actionBarDrawerToggle;
    Toolbar toolbar;
    private SessionManager session;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);

        session = new SessionManager(this);
        if(session.getLang() !=null && session.getLang().equals("ar"))
            changeLanguage("ar");

        setContentView(R.layout.activity_base);
        NavigationView navigationView = (NavigationView) findViewById(R.id.nav_view);


        toolbar = (Toolbar) findViewById(R.id.toolbar);
        setSupportActionBar(toolbar);
        drawerLayout = (DrawerLayout) findViewById(R.id.drawer_layout);
        actionBarDrawerToggle = new ActionBarDrawerToggle(this, drawerLayout, toolbar, R.string.navigation_drawer_open, R.string.navigation_drawer_close);
        drawerLayout.setDrawerListener(actionBarDrawerToggle);

        navigationView.setNavigationItemSelectedListener(new NavigationView.OnNavigationItemSelectedListener() {
            @Override
            public boolean onNavigationItemSelected(MenuItem item) {
                final String appPackageName = getPackageName();

                switch (item.getItemId()) {

                    case R.id.home:
                        startActivity( new Intent(getApplicationContext(), MainActivity.class));
                        drawerLayout.closeDrawers();
                        break;


                    case R.id.categories:
                        startActivity( new Intent(getApplicationContext(), categoryListActivity.class));
                        drawerLayout.closeDrawers();
                        break;


                    case R.id.my_cart:
                        startActivity( new Intent(getApplicationContext(), myCartListActivity.class));
                        drawerLayout.closeDrawers();
                        break;

                    case R.id.my_order:
                        startActivity( new Intent(getApplicationContext(), myOrderListActivity.class));
                        drawerLayout.closeDrawers();
                        break;

                    case R.id.my_account:
                        startActivity( new Intent(getApplicationContext(), myAccountActivity.class));
                        drawerLayout.closeDrawers();
                        break;

                    case R.id.student_profile:
                        startActivity( new Intent(getApplicationContext(), profile.class));
                        drawerLayout.closeDrawers();
                        break;

                    case R.id.change_lang:
                        startActivity( new Intent(getApplicationContext(), changLangActivity.class));
                        drawerLayout.closeDrawers();
                        break;

                    case R.id.logout:
                        session.logoutUser();
                        drawerLayout.closeDrawers();
                        finish();
                        break;

                }
                return false;
            }
        });

    }

    @Override
    protected void onPostCreate(Bundle savedInstanceState) {
        super.onPostCreate(savedInstanceState);

        actionBarDrawerToggle.syncState();
    }

    @Override
    public void finish() {
        super.finish();
        overridePendingTransitionExit();
    }

    @Override
    public void startActivity(Intent intent) {
        super.startActivity(intent);
        overridePendingTransitionEnter();
    }

    /**
     * Overrides the pending Activity transition by performing the "Enter" animation.
     */
    protected void overridePendingTransitionEnter() {
        overridePendingTransition(R.anim.slide_from_right, R.anim.slide_to_left);
    }

    /**
     * Overrides the pending Activity transition by performing the "Exit" animation.
     */
    protected void overridePendingTransitionExit() {
        overridePendingTransition(R.anim.slide_from_left, R.anim.slide_to_right);
    }


    private void changeLanguage(String lang) {
        Locale locale = new Locale(lang);
        Locale.setDefault(locale);
        Resources resources =  getResources();
        Configuration config = resources.getConfiguration();
        config.setLocale(locale);
        resources.updateConfiguration(config, resources.getDisplayMetrics());
    }
}