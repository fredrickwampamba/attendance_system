package com.las.attendance;

import androidx.appcompat.app.AppCompatActivity;

import android.app.ProgressDialog;
import android.content.Intent;
import android.graphics.Color;
import android.os.Bundle;
import android.provider.Settings;
import android.view.View;
import android.widget.Button;
import android.widget.EditText;
import android.widget.Toast;

import com.android.volley.AuthFailureError;
import com.android.volley.Request;
import com.android.volley.Response;
import com.android.volley.VolleyError;
import com.android.volley.toolbox.StringRequest;
import com.marcoscg.materialtoast.MaterialToast;

import org.json.JSONException;
import org.json.JSONObject;

import java.util.HashMap;
import java.util.Locale;
import java.util.Map;
import java.util.UUID;

public class LoginActivity extends AppCompatActivity {

    private EditText reg_no;
    private Button submit;
    private ProgressDialog progress;
    private static String android_id;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_login);

        android_id = Settings.Secure.getString(LoginActivity.this.getContentResolver(),
                Settings.Secure.ANDROID_ID);

        if (SharedPrefUser.getInstance(this).isLoggedIn()){
            finish();
            startActivity(new Intent(getApplicationContext(), MainActivity.class));
            return;
        }

        progress = new ProgressDialog(LoginActivity.this);

        submit = findViewById(R.id.submit);
        reg_no = findViewById(R.id.reg_no);

        submit.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                boolean validation = true;
                if (reg_no.getText().toString().isEmpty()){
                    reg_no.setError("Registration No. is empty");
                    validation = false;
                }

                if (validation){

                    progress.setMessage("Please wait");
                    progress.setCanceledOnTouchOutside(true);
                    progress.show();
                    Toast.makeText(LoginActivity.this,  "Please wait", Toast.LENGTH_SHORT).show();

                    StringRequest stringRequest = new StringRequest(Request.Method.POST, "https://kwaug.com/api/insert_student.php", new Response.Listener<String>() {
                        @Override
                        public void onResponse(String response) {
                            try {
                                JSONObject jsonObject = new JSONObject(response);
                                if (jsonObject.getBoolean("status")){
                                    SharedPrefUser.getInstance(getApplicationContext()).userLogin(
                                            reg_no.getText().toString().toUpperCase(Locale.ROOT).trim(),
                                            android_id
                                    );
//                                    MaterialToast.makeText(LoginActivity.this, jsonObject.getString("msg"), R.drawable.ic_baseline_done_outline_24, 4000).setBackgroundColor(Color.GREEN).show();
                                    Intent intent = new Intent(LoginActivity.this, MainActivity.class);
                                    startActivity(intent);
                                    finish();
                                }else {
                                    MaterialToast.makeText(LoginActivity.this, jsonObject.getString("errorMsg"), R.drawable.ic_baseline_error_24, 4000).setBackgroundColor(Color.RED).show();
                                }
                                progress.dismiss();

                            } catch (JSONException e) {
                                e.printStackTrace();
                            }

                        }
                    }, new Response.ErrorListener() {
                        @Override
                        public void onErrorResponse(VolleyError error) {
                            progress.dismiss();
                            MaterialToast.makeText(LoginActivity.this, error.getMessage(), R.drawable.ic_baseline_error_24, 4000).setBackgroundColor(Color.RED).show();
                        }
                    }){
                        @Override
                        protected Map<String, String> getParams() throws AuthFailureError {
                            Map<String, String> params = new HashMap<>();
                            params.put("uuid", android_id);
                            params.put("reg_no", reg_no.getText().toString().toUpperCase(Locale.ROOT).trim());
                            return params;
                        }
                    };

                    RequestHandler.getInstance(LoginActivity.this).addToRequestQueue(stringRequest);
                }
            }
        });
    }
}