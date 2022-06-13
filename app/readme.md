Get device IP address
```xml
<uses-permission
    android:name="android.permission.ACCESS_WIFI_STATE"/>
```
```java
Context context = requireContext().getApplicationContext();
WifiManager wm = (WifiManager) context.getSystemService(Context.WIFI_SERVICE);
String ip = Formatter.formatIpAddress(wm.getConnectionInfo().getIpAddress());
```

Get device imei
```xml
<uses-permission android:name="android.permission.READ_PHONE_STATE"/>
```
```java
imei = ((TelephonyManager)getSystemService(TELEPHONY_SERVICE)).getDeviceId();
```

Get device mac address
```xml
<uses-permission android:name="android.permission.ACCESS_WIFI_STATE"/>
<uses-permission android:name="android.permission.INTERNET"/>
<uses-permission android:name="android.permission.ACCESS_NETWORK_STATE"/>
```
```java function
public String getMacAddress(){
    try{
        List<NetworkInterface> networkInterfaceList = Collections.list(NetworkInterface.getNetworkInterfaces());

        String stringMac = "";

        for(NetworkInterface networkInterface : networkInterfaceList)
        {
            if(networkInterface.getName().equalsIgnoreCase("wlon0"));
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
```
```java function call
/*These might be usefull*/
import java.net.NetworkInterface;
import java.net.SocketException;
import java.util.Collection;
import java.util.Collections;
import java.util.List;
/*---END---*/

String mobile_mac_addres = getMacAddress();  //call the method that return mac address 

Log.d("MyMacIS",mobile_mac_address);   // print the mac address on logcat screen

/*Or you can just use this*/
WifiManager wifiMan = (WifiManager) this.getSystemService(
        Context.WIFI_SERVICE);
WifiInfo wifiInf = wifiMan.getConnectionInfo();
String macAddr = wifiInf.getMacAddress();
```

Get device gps
```xml
<uses-permission android:name="android.permission.ACCESS_FINE_LOCATION"/>
<uses-permission android:name="android.permission.ACCESS_COARSE_LOCATION"/>
```
```java
int LOCATION_REFRESH_TIME = 15000; // 15 seconds to update
int LOCATION_REFRESH_DISTANCE = 500; // 500 meters to update

mLocationManager = (LocationManager) getSystemService(LOCATION_SERVICE);

mLocationManager.requestLocationUpdates(LocationManager.GPS_PROVIDER, LOCATION_REFRESH_TIME,
            LOCATION_REFRESH_DISTANCE, mLocationListener);

```
```java
private final LocationListener mLocationListener = new LocationListener() {
    @Override
    public void onLocationChanged(final Location location) {
        int lat = location.getLatitude();
        int lat = location.getLongitude();
        /*For more here, reference to https://developer.android.com/reference/android/location/Location*/
    }
};

@Override
protected void onCreate(Bundle savedInstanceState) {
    super.onCreate(savedInstanceState);

    mLocationManager = (LocationManager) getSystemService(LOCATION_SERVICE);

    mLocationManager.requestLocationUpdates(LocationManager.GPS_PROVIDER, LOCATION_REFRESH_TIME,
            LOCATION_REFRESH_DISTANCE, mLocationListener);
}
```

Keeping the screen active
```java
Window window = getWindow();
window.addFlags(WindowManager.LayoutParams.FLAG_KEEP_SCREEN_ON);
```
