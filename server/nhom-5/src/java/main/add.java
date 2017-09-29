/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package main;

import db.DBHelper;
import java.io.IOException;
import java.io.PrintWriter;
import javax.servlet.ServletException;
import javax.servlet.annotation.WebServlet;
import javax.servlet.http.HttpServlet;
import javax.servlet.http.HttpServletRequest;
import javax.servlet.http.HttpServletResponse;
import model.Data;
import model.Device;
import model.User;

/**
 *
 * @author tung
 */
@WebServlet(name = "add", urlPatterns = {"/add"})
public class add extends HttpServlet {
    protected void processRequest(HttpServletRequest request, HttpServletResponse response)
            throws ServletException, IOException {
        DBHelper dbHelper = new DBHelper();
        
        String userName = request.getParameter("userName");
        String userPassword = request.getParameter("userPassword");
        User user = new User();
        user.setUserName(userName);
        user.setPassword(userPassword);
        dbHelper.setmUser(user);
        
        String deviceIMEI = request.getParameter("deviceIMEI");
        String deviceName = request.getParameter("deviceName");
        Device device = new Device();
        device.setDeviceIMEI(deviceIMEI);
        device.setDeviceName(deviceName);
        dbHelper.setmDevice(device);
        
        float humidity = Float.valueOf(request.getParameter("humid"));
        float temperature = Float.valueOf(request.getParameter("temp"));
        String time = request.getParameter("time");
        String coordinate = request.getParameter("coord");
        float pin = Float.valueOf(request.getParameter("pin"));
        float pressure = Float.valueOf(request.getParameter("pressure"));
        Data data = new Data();
        data.setCoordinate(coordinate)
                .setHumidity(humidity)
                .setPin(pin)
                .setPressure(pressure)
                .setTemperature(temperature)
                .setTime(time);
        dbHelper.setmData(data);
        
        
    }

    @Override
    protected void doPost(HttpServletRequest request, HttpServletResponse response)
            throws ServletException, IOException {
        processRequest(request, response);
    }
}
