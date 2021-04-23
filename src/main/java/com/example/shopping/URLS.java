package com.example.shopping;

public class URLS {
    //Email Validation pattern
    public static final String regEx = "\\b[A-Za-z0-9._%+-]+@[A-Za-z0-9.-]+\\.[A-Za-z]{2,4}\\b";

    private static final String URL_ROOT = "http://192.168.64.3/nu_shopping/";

    public static final String URL_REGISTER = URL_ROOT + "register.php";
    public static final String URL_LOGIN = URL_ROOT + "login.php";
    public static final String URL_MAIN = URL_ROOT + "MainActivity.php";
    public static final String URL_MAIN_PRODUCTS = URL_ROOT + "productsMainActivity.php";
    public static final String URL_MAIN_SERVICES = URL_ROOT + "servicesMainActivity.php";
    public static final String URL_ITEM_DETAIL = URL_ROOT + "item_detail.php";
    public static final String URL_MY_CART = URL_ROOT + "my_cart.php";
    public static final String URL_CHECK_OUT = URL_ROOT + "check_out.php";
    public static final String URL_MY_ORDERS = URL_ROOT + "my_orders.php";
    public static final String URL_MY_ACCOUNT =  URL_ROOT + "my_account.php";
    public static final String URL_CATEGORIES = URL_ROOT + "categories.php";
    public static final String URL_PROFILE = URL_ROOT + "profile.php";
    public static final String URL_UPDATE_PROFILE = URL_ROOT + "update_profile.php";
    public static final String FORGET_PASS = URL_ROOT + "forgetPassword.php";
}
