/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package servlet.device;

import db.device.DBHelperDevice;
import java.io.IOException;
import java.io.PrintWriter;
import java.util.logging.Level;
import java.util.logging.Logger;
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

    @Override
    protected void doPost(HttpServletRequest request, HttpServletResponse response){
        DBHelperDevice dbHelper = new DBHelperDevice();
        int user_status;
        int data_status = -1;
        
        String userEmail = request.getParameter("userEmail");
        String userPassword = request.getParameter("userPassword");
        User user = new User();
        user.setEmail(userEmail);
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
        
        user_status = dbHelper.checkUser();
        if (user_status == 1) {
            data_status = dbHelper.addData();
        }
        
        PrintWriter echo;
        try {
            echo = response.getWriter();
            String content = "-1";
            if (user_status == 1 && data_status==1) {
                content = "1";
            }
//            String content = "{\"user status\":" + user_status+","
//                    + "\"data status\":"+data_status+"}";
            echo.println(content);
        } catch (IOException ex) {
            Logger.getLogger(add.class.getName()).log(Level.SEVERE, null, ex);
        }
        dbHelper.finish();
    }
}
