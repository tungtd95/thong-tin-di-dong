/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package db.web;

import db.device.DBHelperDevice;
import java.sql.ResultSet;
import java.sql.SQLException;
import java.sql.Statement;
import java.util.logging.Level;
import java.util.logging.Logger;
import ulti.Echo;

/**
 *
 * @author tungt
 */
public class DBHelperWeb extends DBHelperDevice{
    public DBHelperWeb() {
        getConnection();
    }
    
    public boolean checkLogIn() {
        boolean status = false;
        Statement statement;
        ResultSet resultSet;
        String query = "SELECT * FROM `"+mSchemaDatabase+"`.user where user_email='"+mUser.getEmail()+"';";
        try {
            statement = connection.createStatement();
            resultSet = statement.executeQuery(query);
            if (resultSet.next()) {
                String password = resultSet.getString("user_password");
                if (mUser.getPassword().equals(password)) {
                    status = true;
                } else {
                    Echo.print("Wrong pass word");
                }
            } else {
                Echo.print("Wrong user name");
            }
        } catch (SQLException ex) {
            Logger.getLogger(DBHelperWeb.class.getName()).log(Level.SEVERE, null, ex);
        }
        return status;
    }
    
    public void createUser() {
        String query = "INSERT INTO `"+mSchemaDatabase+"`.`user` "
                + "(`user_email`, `user_password`, `user_name`) "
                + "VALUES ('"+mUser.getEmail()+"', '"+mUser.getPassword()+"', '"+mUser.getUserName()+"');";
        try {
            Statement statement = connection.createStatement();
            statement.execute(query);
        } catch (SQLException ex) {
            Logger.getLogger(DBHelperWeb.class.getName()).log(Level.SEVERE, null, ex);
        }
    }
    
}
