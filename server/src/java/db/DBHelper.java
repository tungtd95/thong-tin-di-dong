/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package db;

import java.sql.Connection;
import java.sql.DriverManager;
import java.sql.ResultSet;
import java.sql.SQLException;
import java.sql.Statement;
import java.util.logging.Level;
import java.util.logging.Logger;
import model.Data;
import model.Device;
import model.User;

/**
 *
 * @author tung
 */
public class DBHelper {
    Connection connection;
    User mUser;
    Device mDevice;
    Data mData;
    
    String host = "sql12.freemysqlhosting.net";
    String database = "sql12197053";
    String user = "sql12197053";
    String password = "WrXjqV3NeJ";
    String port = "3306";
    /*
    * create connection to database
    */
    public DBHelper() {
        try { 
            Class.forName("com.mysql.jdbc.Driver");
            connection = DriverManager.getConnection("jdbc:mysql://"+host+":"
                    + ""+port+"/"+database+"?useSSL=false", user, password ); 
        } catch (ClassNotFoundException | SQLException ex) {
            Logger.getLogger(DBHelper.class.getName()).log(Level.SEVERE, null, ex);
        }
        
    }
    
    /*
    *status of checkUser method
    *   -1: not sign in
    *    0: signed in but password does not match
    *    1: password matched and checkUser success
    *    2: database connection error
    */
    public int checkUser() {
        int status;
        Statement statement;
        ResultSet resultSet;
        
        String query = "SELECT * FROM `"+database+"`.user "
                + "where user.user_name='"+mUser.getUserName()+"';";
        
        try {
            statement = connection.createStatement();
            resultSet = statement.executeQuery(query);
            if (resultSet.next()) {
                String password = resultSet.getString("user_password");
                if (mUser.getPassword().equals(password)) {
                    status = 1;
                    mUser.setUser_id(resultSet.getInt("user_id"));
                } else {
                    status = 0;
                }
            } else {
                status = -1;
            }
        } catch (SQLException ex) {
            status = 2;
            Logger.getLogger(DBHelper.class.getName()).log(Level.SEVERE, null, ex);
        }
        
        return status;
    }
    
    /*
    *status of device:
    *    0: not add yet
    *    1: existed
    *    2: error database
    */
    public int checkDevice() {
        int status = 0;
        Statement statement;
        ResultSet resultSet;
        String query = "SELECT * FROM `"+database+"`.device "
                + "where device.device_imei='"+mDevice.getDeviceIMEI()+"';";
        try {
            statement = connection.createStatement();
            resultSet = statement.executeQuery(query);
            if (resultSet.next()) {
                status = 1;
            }
        } catch (SQLException ex) {
            status = 2;
            Logger.getLogger(DBHelper.class.getName()).log(Level.SEVERE, null, ex);
        }
        return status;
    }
    
    public int addData() {
        int status = 0;
        if(checkDevice()==0) {
            //device is not added yet, add device
            String query = "INSERT INTO `"+database+"`.`device` "
                    + "(`device_imei`, `device_name`, `user_id`) "
                    + "VALUES ('"+mDevice.getDeviceIMEI()+"', '"+mDevice.getDeviceName()+"', '"+mUser.getUser_id()+"');";
            try {
                Statement statement = connection.createStatement();
                statement.execute(query);
            } catch (SQLException ex) {
                Logger.getLogger(DBHelper.class.getName()).log(Level.SEVERE, null, ex);
            }
        }
        String query = "INSERT INTO `"+database+"`.`data` "
                + "(`data_humid`, `data_temp`, `data_time`, `data_coordi`, "
                + "`data_pin`, `data_pressure`, `device_imei`) "
                + "VALUES ('"+mData.getHumidity()+"', '"+mData.getTemperature()+"', '"
                + ""+mData.getTime()+"', '"+mData.getCoordinate()+"', "
                + "'"+mData.getPin()+"', '"+mData.getPressure()+"', '"+mDevice.getDeviceIMEI()+"');";
        try {
            Statement statement = connection.createStatement();
            statement.execute(query);
            status = 1;
        } catch (SQLException ex) {
            Logger.getLogger(DBHelper.class.getName()).log(Level.SEVERE, null, ex);
        }
        
        return status;
    }

    public User getmUser() {
        return mUser;
    }

    public void setmUser(User mUser) {
        this.mUser = mUser;
    }

    public Device getmDevice() {
        return mDevice;
    }

    public void setmDevice(Device mDevice) {
        this.mDevice = mDevice;
    }

    public Data getmData() {
        return mData;
    }

    public void setmData(Data mData) {
        this.mData = mData;
    }
    
    public void finish() {
        try {
            connection.close();
        } catch (SQLException ex) {
            Logger.getLogger(DBHelper.class.getName()).log(Level.SEVERE, null, ex);
        }
    }
}
