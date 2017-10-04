/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package db;

import db.device.DBHelperDevice;
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
 * @author tungt
 */
public abstract class DBC {
   
    protected Connection connection = null;
    protected User mUser;
    
//      ONLINE DATABASE
//    String mHostDatabase = "sql12.freemysqlhosting.net";
//    String mSchemaDatabase = "sql12197053";
//    String mUserDatabase = "sql12197053";
//    String mPasswordDatabase = "WrXjqV3NeJ";
//    String mPortDatabase = "3306";
    
//      OFFLINE DATABASE
    protected final String mHostDatabase = "localhost";
    protected final String mSchemaDatabase = "thong-tin-di-dong";
    private final String mUserDatabase = "root";
    private final String mPasswordDatabase = "Javafirst";
    private final String mPortDatabase = "3307";
    
    public void getConnection() {
        try {
            Class.forName("com.mysql.jdbc.Driver");
            connection = DriverManager.getConnection("jdbc:mysql://" + mHostDatabase + ":"
                    + "" + mPortDatabase + "/" + mSchemaDatabase + "?useSSL=false", mUserDatabase, mPasswordDatabase);
        } catch (ClassNotFoundException | SQLException ex) {
            Logger.getLogger(DBHelperDevice.class.getName()).log(Level.SEVERE, null, ex);
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

        String query = "SELECT * FROM `" + mSchemaDatabase + "`.user "
                + "where user.user_name='" + mUser.getUserName() + "';";

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
            Logger.getLogger(DBHelperDevice.class.getName()).log(Level.SEVERE, null, ex);
        }

        return status;
    }

    public User getmUser() {
        return mUser;
    }

    public void setmUser(User mUser) {
        this.mUser = mUser;
    }

    public void finish() {
        try {
            connection.close();
        } catch (SQLException ex) {
            Logger.getLogger(DBHelperDevice.class.getName()).log(Level.SEVERE, null, ex);
        }
    }
}
