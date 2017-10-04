/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package db.device;

import db.DBC;
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
public class DBHelperDevice extends DBC {
    
    
    protected Device mDevice;
    protected Data mData;
    /*
    * create connection to database
     */
    public DBHelperDevice() {
        getConnection();
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
        String query = "SELECT * FROM `" + mSchemaDatabase + "`.device "
                + "where device.device_imei='" + mDevice.getDeviceIMEI() + "';";
        try {
            statement = connection.createStatement();
            resultSet = statement.executeQuery(query);
            if (resultSet.next()) {
                status = 1;
            }
        } catch (SQLException ex) {
            status = 2;
            Logger.getLogger(DBHelperDevice.class.getName()).log(Level.SEVERE, null, ex);
        }
        return status;
    }

    public int addData() {
        int status = 0;
        if (checkDevice() == 0) {
            //device is not added yet, add device
            String query = "INSERT INTO `" + mSchemaDatabase + "`.`device` "
                    + "(`device_imei`, `device_name`, `user_id`) "
                    + "VALUES ('" + mDevice.getDeviceIMEI() + "', '" + mDevice.getDeviceName() + "', '" + mUser.getUser_id() + "');";
            try {
                Statement statement = connection.createStatement();
                statement.execute(query);
            } catch (SQLException ex) {
                Logger.getLogger(DBHelperDevice.class.getName()).log(Level.SEVERE, null, ex);
            }
        }
        String query = "INSERT INTO `" + mSchemaDatabase + "`.`data` "
                + "(`data_humid`, `data_temp`, `data_time`, `data_coordi`, "
                + "`data_pin`, `data_pressure`, `device_imei`) "
                + "VALUES ('" + mData.getHumidity() + "', '" + mData.getTemperature() + "', '"
                + "" + mData.getTime() + "', '" + mData.getCoordinate() + "', "
                + "'" + mData.getPin() + "', '" + mData.getPressure() + "', '" + mDevice.getDeviceIMEI() + "');";
        try {
            Statement statement = connection.createStatement();
            statement.execute(query);
            status = 1;
        } catch (SQLException ex) {
            Logger.getLogger(DBHelperDevice.class.getName()).log(Level.SEVERE, null, ex);
        }

        return status;
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
}
