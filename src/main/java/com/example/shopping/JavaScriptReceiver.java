package com.example.shopping;

import android.app.Activity;
import android.app.ProgressDialog;
import android.content.DialogInterface;
import android.content.Intent;
import android.os.Bundle;
import android.webkit.JavascriptInterface;
import android.webkit.WebView;

public class JavaScriptReceiver {
    Activity mContext;
    AlertDialogManager alert ;
    private ProgressDialog loading;
    WebView wbview;
    /** Instantiate the receiver and set the context */
    public JavaScriptReceiver(Activity c) {
        mContext = c;
        alert = new AlertDialogManager(c);
    }

    public JavaScriptReceiver(Activity c , WebView wbview) {
        mContext = c;
        alert = new AlertDialogManager(c);
        this.wbview = wbview;
    }

    private String userID = "";



    @JavascriptInterface
    public void showErrMessage(String msg){
        alert.showAlertDialog(mContext, mContext.getString(R.string.info), msg, false);
    }

    @JavascriptInterface
    public void showMessage(String msg){
        alert.showAlertDialog(mContext, mContext.getString(R.string.info), msg, true);
    }


    @JavascriptInterface
    public void loadProcess() {
        loading = ProgressDialog.show(mContext, "Loading", "Please wait...", false, false);
    }

    public void dismissLoadProcess() {
        loading.dismiss();
    }

    @JavascriptInterface
    public void loadDismiss(){
        loading.dismiss();
    }


    @JavascriptInterface
    public void itemsDetailActivity(String item_id){
        Intent i = new Intent(mContext, itemDetailActivity.class);
        i.putExtra("item_id" , item_id);
        mContext.startActivity(i);
        loading.dismiss();
    }

    @JavascriptInterface
    public void categoryListActivity(String categ_id, String  item_type){
        Intent i = new Intent(mContext, productsListActivity.class);
        i.putExtra("categ_id" , categ_id);
        i.putExtra("item_type" , item_type);
        mContext.startActivity(i);
        loading.dismiss();
    }

    @JavascriptInterface
    public void addCartDone(){
        Intent i = new Intent(mContext, msgActivity.class);
        i.putExtra("operation" , "add_cart");
        i.putExtra("success" , true);
        i.putExtra("msg" , mContext.getString(R.string.success_add));
        mContext.startActivity(i);
    }

    @JavascriptInterface
    public void updateCartDone(){
        Intent i = new Intent(mContext, msgActivity.class);
        i.putExtra("operation" , "add_cart");
        i.putExtra("success" , true);
        i.putExtra("msg" , mContext.getString(R.string.success_update));
        mContext.startActivity(i);
    }


    @JavascriptInterface
    public void updateCartError(){
        Intent i = new Intent(mContext, msgActivity.class);
        i.putExtra("operation" , "add_cart");
        i.putExtra("success" , true);
        i.putExtra("msg" , mContext.getString(R.string.update_failure));
        mContext.startActivity(i);
    }

    @JavascriptInterface
    public void addCartError(){
        Intent i = new Intent(mContext, msgActivity.class);
        i.putExtra("operation" , "add_cart");
        i.putExtra("success" , false);
        i.putExtra("msg" , mContext.getString(R.string.add_failure));
        mContext.startActivity(i);
    }

    @JavascriptInterface
    public void deleteItemDone(){
        Intent i = new Intent(mContext, msgActivity.class);
        i.putExtra("operation" , "delete_item");
        i.putExtra("success" , true);
        i.putExtra("msg" , mContext.getString(R.string.remove_success));
        mContext.startActivity(i);
    }

    @JavascriptInterface
    public void updateItemDone(){
        Intent i = new Intent(mContext, msgActivity.class);
        i.putExtra("operation" , "add_cart");
        i.putExtra("success" , true);
        i.putExtra("msg" , mContext.getString(R.string.item_add_sucess));
        mContext.startActivity(i);
    }



    @JavascriptInterface
    public void checkOutDone(){
        Intent i = new Intent(mContext, msgActivity.class);
        i.putExtra("operation" , "check_done");
        i.putExtra("success" , true);
        i.putExtra("msg" , mContext.getString(R.string.req_done_success));
        mContext.startActivity(i);
    }


    @JavascriptInterface
    public void checkOut(){
        Intent i = new Intent(mContext, checkOutMainActivity.class);
        mContext.startActivity(i);
    }

    @JavascriptInterface
    public void cash(){
        alert.showMessageOKCancel(mContext.getString(R.string.ask_select_acc), new DialogInterface.OnClickListener() {
            @Override
            public void onClick(DialogInterface dialogInterface, int i) {
                if(i == -1)
                {
                    wbview .post(new Runnable() {
                        @Override
                        public void run() {
                            wbview.loadUrl("javascript:doCashProcess()");
                        }
                    });

                }
            }
        });
    }

}
