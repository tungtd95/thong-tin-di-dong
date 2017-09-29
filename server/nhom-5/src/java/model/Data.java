/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package model;

/**
 *
 * @author tung
 */
public class Data {
    float humidity;
    float temperature;
    String time;
    String coordinate;
    float pin;
    float pressure;
    public Data() {
        this.humidity = 0;
        this.temperature = 0;
        this.temperature = 0;
        this.time = "";
        this.coordinate = "";
        this.pin = 0;
        this.pressure = 0;
    }

    public float getHumidity() {
        return humidity;
    }

    public Data setHumidity(float humidity) {
        this.humidity = humidity;
        return this;
    }

    public float getTemperature() {
        return temperature;
    }

    public Data setTemperature(float temperature) {
        this.temperature = temperature;
        return this;
    }

    public String getTime() {
        return time;
    }

    public Data setTime(String time) {
        this.time = time;
        return this;
    }

    public String getCoordinate() {
        return coordinate;
    }

    public Data setCoordinate(String coordinate) {
        this.coordinate = coordinate;
        return this;
    }

    public float getPin() {
        return pin;
    }

    public Data setPin(float pin) {
        this.pin = pin;
        return this;
    }

    public float getPressure() {
        return pressure;
    }

    public Data setPressure(float pressure) {
        this.pressure = pressure;
        return this;
    }
    
}
