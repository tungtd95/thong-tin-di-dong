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
    
    /*
    * create connection to database
    */
    public DBHelper() {
        try { 
            Class.forName("com.mysql.jdbc.Driver");
            connection = DriverManager.getConnection("jdbc:mysql://localhost:"
                    + "3306/thong-tin-di-dong?useSSL=false", "root", "Javafirst"); 
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
        
        String query = "SELECT * FROM `thong-tin-di-dong`.user "
                + "where user.user_name='"+mUser.getUserName()+"';";
        
        try {
            statement = connection.createStatement();
            resultSet = statement.executeQuery(query);
            if (resultSet.next()) {
                String password = resultSet.getString("user_password");
                if (mUser.getPassword().equals(password)) {
                    status = 1;
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
    */
    public int checkDevice() {
        int status = -1;
        Statement statement;
        ResultSet resultSet;
        String query = "";
        
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
