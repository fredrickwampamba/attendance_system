package com.las.attendance;

import android.content.Context;
import android.content.SharedPreferences;

import java.util.UUID;

public class SharedPrefUser {
    private static SharedPrefUser instance;
    private static Context ctx;

    private static final String SHARED_PREF_NAME = "sharedprefLogin";
    private static final String KEY_USER_REG_NO = "reg_no";
    private static final String KEY_USER_UNIQUE = "dev_unique";

    private SharedPrefUser(Context context) {
        ctx = context;
    }

    public static synchronized SharedPrefUser getInstance(Context context) {
        if (instance == null) {
            instance = new SharedPrefUser(context);
        }
        return instance;
    }

    public boolean userLogin(String reg_no, String androidID){
        SharedPreferences sharedPreferences = ctx.getSharedPreferences(SHARED_PREF_NAME, Context.MODE_PRIVATE);
        SharedPreferences.Editor editor = sharedPreferences.edit();

        editor.putString(KEY_USER_REG_NO, reg_no);
        editor.putString(KEY_USER_UNIQUE, androidID);

        editor.apply();

        return true;
    }

    public boolean isLoggedIn(){
        SharedPreferences sharedPreferences = ctx.getSharedPreferences(SHARED_PREF_NAME, Context.MODE_PRIVATE);
        if (sharedPreferences.getString(KEY_USER_REG_NO, null) == null){
            return false;
        }
        return  true;
    }

    public String getKeyUserRegNo() {
        SharedPreferences sharedPreferences = ctx.getSharedPreferences(SHARED_PREF_NAME,Context.MODE_PRIVATE);
        return sharedPreferences.getString(KEY_USER_REG_NO, null);
    }

    public String getKeyUserDevUnique() {
        SharedPreferences sharedPreferences = ctx.getSharedPreferences(SHARED_PREF_NAME,Context.MODE_PRIVATE);
        return sharedPreferences.getString(KEY_USER_UNIQUE, null);
    }
}

