
#include <ESP8266HTTPClient.h>
#include <ESP8266WiFi.h>
#include <DHT.h>
#define DHTTYPE DHT22   // DHT 22  (AM2302), AM2321
const char* ssid = "iPhone";
const char* password = "password";

// DHT Sensor
const int DHTPin = 5;
// Initialize DHT sensor.
DHT dht(DHTPin, DHTTYPE);

// Temporary variables
static char celsiusTemp[7];
static char fahrenheitTemp[7];
static char humidityTemp[7];

void setup() {
  // put your setup code here, to run once:
  Serial.begin(115200);                 //Serial connection
  WiFi.begin(ssid, password);   //WiFi connection
 
  while (WiFi.status() != WL_CONNECTED) {  //Wait for the WiFI connection completion
 
    delay(500);
    Serial.println("Waiting for connection");
 
  }
  Serial.println("WiFi connected");

  dht.begin();


}
void loop() {
  if(WiFi.status()== WL_CONNECTED){   //Check WiFi connection status
            
            // Sensor readings may also be up to 2 seconds 'old' (its a very slow sensor)
            float h = dht.readHumidity();
            // Read temperature as Celsius (the default)
            float t = dht.readTemperature();
            // Read temperature as Fahrenheit (isFahrenheit = true)
            float f = dht.readTemperature(true);
            // Check if any reads failed and exit early (to try again).
            if (isnan(h) || isnan(t) || isnan(f)) {
              Serial.println("Failed to read from DHT sensor!");
              strcpy(celsiusTemp,"Failed");
              strcpy(fahrenheitTemp, "Failed");
              strcpy(humidityTemp, "Failed");         
            }
            else{
              char hh[100] = "";
              char tt[100] = "";
              sprintf(hh, "token=ekJaU2JCYzJGK3V5cUwvSjEvTTNMUT09&type=humidity&data=%.2f", h);
              sprintf(tt, "token=ekJaU2JCYzJGK3V5cUwvSjEvTTNMUT09&type=temp&data=%.2f", t);
              
              // Computes temperature values in Celsius + Fahrenheit and Humidity
              float hic = dht.computeHeatIndex(t, h, false);       
              dtostrf(hic, 6, 2, celsiusTemp);             
              float hif = dht.computeHeatIndex(f, h);
              dtostrf(hif, 6, 2, fahrenheitTemp);         
              dtostrf(h, 6, 2, humidityTemp);
              // You can delete the following Serial.print's, it's just for debugging purposes
              Serial.print("Humidity: ");
              Serial.print(h);
              Serial.print(" %\t Temperature: ");
              Serial.print(t);
              Serial.print(" *C \n");
   
             HTTPClient http;    //Declare object of class HTTPClient
            http.begin("http://example.com/iot/public/api/v1/new_data");      //Specify request destination
            http.addHeader("Content-Type", "application/x-www-form-urlencoded");
             int httpCode = http.POST(tt);   //Send the request
             String payload = http.getString();                  //Get the response payload
             Serial.println(httpCode);   //Print HTTP return code
             Serial.println(payload);    //Print request response payload
             http.end();  //Close connection
            
            HTTPClient http2;    //Declare object of class HTTPClient
            http2.begin("http://example.com/iot/public/api/v1/new_data");      //Specify request destination
            http2.addHeader("Content-Type", "application/x-www-form-urlencoded");
             int httpCode2 = http2.POST(hh);   //Send the request
             String payload2 = http2.getString();                  //Get the response payload
             Serial.println(httpCode2);   //Print HTTP return code
             Serial.println(payload2);    //Print request response payload
             http2.end();  //Close connection

        //   ---------------------------------
            }
   }else{
      Serial.println("Error in WiFi connection");   
   }
    delay(5000);  //Send a request every 2 minutes
}
