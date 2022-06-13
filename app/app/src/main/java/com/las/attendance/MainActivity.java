package com.las.attendance;

import androidx.annotation.NonNull;
import androidx.appcompat.app.AppCompatActivity;
import androidx.core.app.ActivityCompat;
import androidx.core.content.ContextCompat;

import android.Manifest;

import android.app.AlertDialog;
import android.app.ProgressDialog;
import android.content.Context;
import android.content.DialogInterface;
import android.content.pm.PackageManager;
import android.graphics.Color;

import com.google.android.gms.location.FusedLocationProviderClient;
import com.google.android.gms.location.LocationCallback;
import com.google.android.gms.location.LocationRequest;
import com.google.android.gms.location.LocationResult;
import com.google.android.gms.location.LocationServices;

import android.location.Criteria;
import android.location.Location;
import android.location.LocationManager;
import android.net.Uri;
import android.net.wifi.WifiInfo;
import android.net.wifi.WifiManager;
import android.os.Bundle;
import android.os.Looper;
import android.text.TextUtils;
import android.widget.Toast;

import com.android.volley.AuthFailureError;
import com.android.volley.Request;
import com.android.volley.Response;
import com.android.volley.VolleyError;
import com.android.volley.toolbox.StringRequest;
import com.budiyev.android.codescanner.CodeScanner;
import com.budiyev.android.codescanner.CodeScannerView;
import com.budiyev.android.codescanner.DecodeCallback;
import com.google.zxing.Result;
import com.marcoscg.materialtoast.MaterialToast;

import org.json.JSONException;
import org.json.JSONObject;
import java.net.NetworkInterface;
import java.net.SocketException;
import java.util.Collections;
import java.util.Enumeration;
import java.util.HashMap;
import java.util.List;
import java.util.Map;

@SuppressWarnings("ALL")
public class MainActivity extends AppCompatActivity {
    private CodeScanner mCodeScanner;
    private String qr_code_url;
    private String mac_address;
    private String lectureID;
    private String gps;

    private boolean isTracking = false;
    private FusedLocationProviderClient fusedLocationClient;
    private LocationCallback locationCallback;
    private LocationRequest locationRequest;
    private LocationManager locationManager;

    private static final int PERMISSION_REQUEST_CODE = 200;

    public String provider;
    private ProgressDialog progress;
//    private LocationCallback locationCallback;
//    private LocationRequest locationRequest;
//    private FusedLocationProviderClient mFusedLocationClient;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_main);

        checkLocationPermission();

        progress = new ProgressDialog(MainActivity.this);

        fusedLocationClient = LocationServices.getFusedLocationProviderClient(this);
        locationRequest = LocationRequest.create();
        locationRequest.setPriority(LocationRequest.PRIORITY_HIGH_ACCURACY);
        locationRequest.setInterval(1000);
        locationRequest.setFastestInterval(500);
        locationRequest.setWaitForAccurateLocation(true);
        locationRequest.setSmallestDisplacement(0);

        locationCallback = new LocationCallback() {
            @Override
            public void onLocationResult(@NonNull LocationResult locationResult) {
                for (Location location : locationResult.getLocations()) {
                    gps = location.getLatitude() + "," + location.getLongitude();
                }
            }
        };

        if (!isTracking) {
            startLocationUpdates();

        } else {
            stopLocationUpdates();
        }


        // Get the location manager
        locationManager = (LocationManager) getSystemService(Context.LOCATION_SERVICE);
        // Define the criteria how to select the locatioin provider -> use
        // default
        Criteria criteria = new Criteria();
        provider = locationManager.getBestProvider(criteria, false);
        Location location = locationManager.getLastKnownLocation(provider);

        // Initialize the location fields
        if (location != null) {
            gps = location.getLatitude() + "," + location.getLongitude();
            onLocationChanged(location);
        }

        Enumeration<NetworkInterface> networkInterfaces = null;
        try {
            networkInterfaces = NetworkInterface.getNetworkInterfaces();
        } catch (SocketException e) {
            e.printStackTrace();
        }
//        while (networkInterfaces.hasMoreElements()) {
//            NetworkInterface ni = networkInterfaces.nextElement();
//            byte[] hardwareAddress = new byte[0];
//            try {
//                hardwareAddress = ni.getHardwareAddress();
//            } catch (SocketException e) {
//                e.printStackTrace();
//            }
//            if (hardwareAddress != null) {
//                String[] hexadecimalFormat = new String[hardwareAddress.length];
//                for (int i = 0; i < hardwareAddress.length; i++) {
//                    hexadecimalFormat[i] = String.format("%02X", hardwareAddress[i]);
//                }
//                mac_address = TextUtils.join("-", hexadecimalFormat);
//                break;
//            }
//        }

        WifiManager wifiMgr = (WifiManager) getApplicationContext().getSystemService(WIFI_SERVICE);
        WifiInfo wifiInfo = wifiMgr.getConnectionInfo();
        mac_address =  wifiInfo.getMacAddress();

        if (ContextCompat.checkSelfPermission(MainActivity.this, Manifest.permission.CAMERA)
                == PackageManager.PERMISSION_DENIED){
            ActivityCompat.requestPermissions(MainActivity.this, new String[] {Manifest.permission.CAMERA}, 123);
        } else {
            startScanning();
        }
    }


    public void checkLocationPermission() {
        if (ContextCompat.checkSelfPermission(this,
                Manifest.permission.ACCESS_FINE_LOCATION)
                != PackageManager.PERMISSION_GRANTED) {

            // Should we show an explanation?
            if (ActivityCompat.shouldShowRequestPermissionRationale(this,
                    Manifest.permission.ACCESS_FINE_LOCATION)) {

                // Show an explanation to the user *asynchronously* -- don't block
                // this thread waiting for the user's response! After the user
                // sees the explanation, try again to request the permission.
                new AlertDialog.Builder(this)
                        .setTitle("Location Permission")
                        .setMessage("Please allow location")
                        .setPositiveButton("Okay", new DialogInterface.OnClickListener() {
                            @Override
                            public void onClick(DialogInterface dialogInterface, int i) {
                                //Prompt the user once explanation has been shown
                                ActivityCompat.requestPermissions(MainActivity.this,
                                        new String[]{Manifest.permission.ACCESS_FINE_LOCATION},
                                        PERMISSION_REQUEST_CODE);
                            }
                        })
                        .create()
                        .show();


            } else {
                // No explanation needed, we can request the permission.
                ActivityCompat.requestPermissions(this,
                        new String[]{Manifest.permission.ACCESS_FINE_LOCATION},
                        PERMISSION_REQUEST_CODE );
            }
        }

//        mFusedLocationClient = LocationServices.getFusedLocationProviderClient(this);
//
//        locationRequest = new LocationRequest();
//        locationRequest.setInterval(1000);
//        locationRequest.setFastestInterval(1000);
//        locationRequest.setPriority(LocationRequest.PRIORITY_HIGH_ACCURACY);
//        if (android.os.Build.VERSION.SDK_INT >= Build.VERSION_CODES.M) {
//            if (ContextCompat.checkSelfPermission(this,
//                    Manifest.permission.ACCESS_FINE_LOCATION)
//                    == PackageManager.PERMISSION_GRANTED) {
//                //Location Permission already granted
//                mFusedLocationClient.requestLocationUpdates(locationRequest, locationCallback, Looper.myLooper());
//            }
//        } else {
//            mFusedLocationClient.requestLocationUpdates(locationRequest, locationCallback, Looper.myLooper());
//        }
    }

    private void startScanning() {
        CodeScannerView scannerView = findViewById(R.id.scanner_view);
        mCodeScanner = new CodeScanner(this, scannerView);
        mCodeScanner.setDecodeCallback(new DecodeCallback() {
            @Override
            public void onDecoded(@NonNull final Result result) {
                runOnUiThread(new Runnable() {
                    @Override
                    public void run() {
                        qr_code_url = result.getText();

                        if (gps == null){
                            mCodeScanner.startPreview();
                        }

                        Uri uri = Uri.parse(qr_code_url);
                        lectureID = uri.getQueryParameter("lectureID");

                        progress.setMessage("Please wait");
                        progress.setCanceledOnTouchOutside(true);
                        progress.show();

                        Toast.makeText(MainActivity.this,  "Taking attendance, please wait", Toast.LENGTH_LONG).show();
                        StringRequest stringRequest = new StringRequest(Request.Method.POST, "https://kwaug.com/api/insert_attendance.php", new Response.Listener<String>() {
                            @Override
                            public void onResponse(String response) {
                                try {
                                    JSONObject jsonObject = new JSONObject(response);
                                    if (jsonObject.getBoolean("status")){
                                        MaterialToast.makeText(MainActivity.this, jsonObject.getString("msg"), R.drawable.ic_baseline_done_outline_24, 4000).setBackgroundColor(Color.GREEN).show();
                                    }else {
                                        MaterialToast.makeText(MainActivity.this, jsonObject.getString("errorMsg"), R.drawable.ic_baseline_error_24, 4000).setBackgroundColor(Color.RED).show();
                                    }
                                    progress.dismiss();
                                    mCodeScanner.startPreview();

                                } catch (JSONException e) {
                                    e.printStackTrace();
                                }

                            }
                        }, new Response.ErrorListener() {
                            @Override
                            public void onErrorResponse(VolleyError error) {
                                progress.dismiss();
                                MaterialToast.makeText(MainActivity.this, "Oops, something went wrong", R.drawable.ic_baseline_error_24, 10000).setBackgroundColor(Color.RED).show();
                            }
                        }){
                            @Override
                            protected Map<String, String> getParams() throws AuthFailureError {
                                Map<String, String> params = new HashMap<>();
                                params.put("mac", mac_address.toString());
                                params.put("lectureID", lectureID.toString());
                                params.put("uuid", SharedPrefUser.getInstance(MainActivity.this).getKeyUserDevUnique().toString());
                                params.put("gps", gps.toString());
                                params.put("reg_no", SharedPrefUser.getInstance(MainActivity.this).getKeyUserRegNo().toString());
                                return params;
                            }
                        };

                        RequestHandler.getInstance(MainActivity.this).addToRequestQueue(stringRequest);
                    }

                });
            }
        });
    }

    @Override
    public void onRequestPermissionsResult(int requestCode, @NonNull String[] permissions, @NonNull int[] grantResults) {
        super.onRequestPermissionsResult(requestCode, permissions, grantResults);
        if (requestCode == 123) {
            if (grantResults[0] == PackageManager.PERMISSION_GRANTED) {
                Toast.makeText(this, "Camera permission granted", Toast.LENGTH_LONG).show();
                startScanning();
            } else {
                Toast.makeText(this, "Camera permission denied", Toast.LENGTH_LONG).show();
            }
        }

        if (requestCode == PERMISSION_REQUEST_CODE ){
            if (grantResults.length > 0
                    && grantResults[0] == PackageManager.PERMISSION_GRANTED) {

                // permission was granted, yay! Do the
                // location-related task you need to do.
                if (ContextCompat.checkSelfPermission(this,
                        Manifest.permission.ACCESS_FINE_LOCATION)
                        == PackageManager.PERMISSION_GRANTED) {
                    Toast.makeText(this, "Location permission granted", Toast.LENGTH_LONG).show();
                    //Request location updates:
//                    mFusedLocationClient.requestLocationUpdates(locationRequest, locationCallback, Looper.myLooper());
                }

            } else {

                // permission denied, boo! Disable the
                // functionality that depends on this permission.
                Toast.makeText(this, "Grant location permissions", Toast.LENGTH_LONG).show();

            }
        }
    }

    @Override
    protected void onResume() {
        super.onResume();
        if(mCodeScanner != null) {
            mCodeScanner.startPreview();
        }

        if (isTracking) {
            startLocationUpdates();
        }
    }

    private void startLocationUpdates() {
        if (ActivityCompat.checkSelfPermission(this, Manifest.permission.ACCESS_FINE_LOCATION) != PackageManager.PERMISSION_GRANTED || ActivityCompat.checkSelfPermission(this, Manifest.permission.ACCESS_COARSE_LOCATION) != PackageManager.PERMISSION_GRANTED) {
            requestPermissions(new String[]{Manifest.permission.ACCESS_FINE_LOCATION, Manifest.permission.ACCESS_COARSE_LOCATION}, PERMISSION_REQUEST_CODE);
            return;
        }
        fusedLocationClient.requestLocationUpdates(locationRequest,
                locationCallback,
                Looper.getMainLooper());
        isTracking = true;
    }

    private void stopLocationUpdates() {
        fusedLocationClient.removeLocationUpdates(locationCallback);
        isTracking = false;
    }

    public void receiveUpdates(){
        if (ContextCompat.checkSelfPermission(this,
                Manifest.permission.ACCESS_FINE_LOCATION)
                == PackageManager.PERMISSION_GRANTED) {
//            mFusedLocationClient.requestLocationUpdates(locationRequest,
//                    locationCallback,
//                    Looper.getMainLooper());
//            locationManager.requestLocationUpdates(provider, 400, 1, (LocationListener) this);
        }
    }


    @Override
    protected void onPause() {
        if(mCodeScanner != null) {
            mCodeScanner.releaseResources();
        }
        super.onPause();

        if (ContextCompat.checkSelfPermission(this,
                Manifest.permission.ACCESS_FINE_LOCATION)
                == PackageManager.PERMISSION_GRANTED) {

            stopLocationUpdates();
        }
    }

    public String getMacAddress(){
        try{
            List<NetworkInterface> networkInterfaceList = Collections.list(NetworkInterface.getNetworkInterfaces());

            String stringMac = "";

            for(NetworkInterface networkInterface : networkInterfaceList)
            {
                if(networkInterface.getName().equalsIgnoreCase("wlon0"))
                {
                    for(int i = 0 ;i <networkInterface.getHardwareAddress().length; i++){
                        String stringMacByte = Integer.toHexString(networkInterface.getHardwareAddress()[i]& 0xFF);

                        if(stringMacByte.length() == 1)
                        {
                            stringMacByte = "0" +stringMacByte;
                        }

                        stringMac = stringMac + stringMacByte.toUpperCase() + ":";
                    }
                    break;
                }

            }
            return stringMac;
        }catch (SocketException e)
        {
            e.printStackTrace();
        }

        return  "0";
    }

    public void onLocationChanged(@NonNull Location location) {
//        Toast.makeText(MainActivity.this, location.getLatitude() +","+location.getLongitude(), Toast.LENGTH_SHORT).show();
    }

}