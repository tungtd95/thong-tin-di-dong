/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package servlet.web;

import db.web.DBHelperWeb;
import java.io.IOException;
import java.io.PrintWriter;
import java.util.logging.Level;
import java.util.logging.Logger;
import javax.servlet.ServletException;
import javax.servlet.annotation.WebServlet;
import javax.servlet.http.HttpServlet;
import javax.servlet.http.HttpServletRequest;
import javax.servlet.http.HttpServletResponse;
import model.User;
import servlet.MySession;
import ulti.Echo;

/**
 *
 * @author tungt
 */
@WebServlet(name = "SignIn", urlPatterns = {"/SignIn"})
public class SignIn extends HttpServlet {

    HttpServletRequest mRequest;
    HttpServletResponse mResponse;

    protected void processRequest(HttpServletRequest request, HttpServletResponse response)
            throws ServletException, IOException {
        mRequest = request;
        mResponse = response;
        MySession mySession = new MySession(request);
        if (mySession.check()) {
            gotoDiagram();
            return;
        }
        String email = request.getParameter("email");
        if (email == null || email.length() == 0) {
            //load form and return
            Echo.print("11111111111111111111111");
            loadForm();
            return;
        }
        String name = request.getParameter("name");
        if (name == null || name.length() == 0) {
            //load form and return
            Echo.print("222222222222222222222222");
            loadForm();
            return;
        }
        String password = request.getParameter("password");
        if (password == null || password.length() == 0) {
            //load form and return
            Echo.print("3333333333333333333333333");
            loadForm();
            return;
        }
        User user = new User();
        user.setEmail(email);
        user.setPassword(password);
        user.setUserName(name);
        DBHelperWeb dbHelper = new DBHelperWeb();
        dbHelper.setmUser(user);
        if (dbHelper.checkLogIn()) {
            loadForm();
        } else {
            dbHelper.createUser();
            gotoLogin();
        }
    }

    public void loadForm() {
        try {
            PrintWriter echo = mResponse.getWriter();
            echo.println("<!DOCTYPE html>\n"
                    + "<html>\n"
                    + "<style>\n"
                    + "    form {\n"
                    + "        border: 3px solid #f1f1f1;\n"
                    + "    }\n"
                    + "    input[type=text], input[type=password] {\n"
                    + "        width: 100%;\n"
                    + "        padding: 12px 20px;\n"
                    + "        margin: 8px 0;\n"
                    + "        display: inline-block;\n"
                    + "        border: 1px solid #ccc;\n"
                    + "        box-sizing: border-box;\n"
                    + "    }\n"
                    + "    button {\n"
                    + "        background-color: #4CAF50;\n"
                    + "        color: white;\n"
                    + "        padding: 14px 20px;\n"
                    + "        margin: 8px 0;\n"
                    + "        border: none;\n"
                    + "        cursor: pointer;\n"
                    + "        width: 100%;\n"
                    + "    }\n"
                    + "    button:hover {\n"
                    + "        opacity: 0.8;\n"
                    + "    }\n"
                    + "    .cancelbtn {\n"
                    + "        width: auto;\n"
                    + "        padding: 10px 18px;\n"
                    + "        background-color: #f44336;\n"
                    + "    }\n"
                    + "    .imgcontainer {\n"
                    + "        text-align: center;\n"
                    + "        margin: 24px 0 12px 0;\n"
                    + "    }\n"
                    + "    img.avatar {\n"
                    + "        width: 10%;\n"
                    + "        border-radius: 50%;\n"
                    + "    }\n"
                    + "    .container {\n"
                    + "        padding: 16px;\n"
                    + "    }\n"
                    + "    span.psw {\n"
                    + "        float: right;\n"
                    + "        padding-top: 16px;\n"
                    + "    }\n"
                    + "    @media screen and (max-width: 300px) {\n"
                    + "        span.psw {\n"
                    + "            display: block;\n"
                    + "            float: none;\n"
                    + "        }\n"
                    + "        .cancelbtn {\n"
                    + "            width: 100%;\n"
                    + "        }\n"
                    + "    }\n"
                    + "    .dangki{\n"
                    + "        width: 1200px;\n"
                    + "        margin: 0 auto;\n"
                    + "    }\n"
                    + "</style>\n"
                    + "<body>\n"
                    + "<div class=\"dangki\">\n"
                    + "    <div style=\"width: 100%;float: left;color: blue;font-weight: bold;text-align: center;\">\n"
                    + "    <h2> ĐĂNG KÍ </h2>\n"
                    + "    </div>\n"
                    + "    <form action=\"SignIn\">\n"
                    + "        <div class=\"container\">\n"
                    + "            <label style=\"width: 100%;float: left;color: blue;font-weight: bold;\"><b> EMAL </b></label><br>\n"
                    + "            <input style=\"width: 95%\" type=\"text\" placeholder=\"EMAIL\" name=\"email\" required><br>\n"
                    + "            <label style=\"width: 100%;float: left;color: blue;font-weight: bold;\"><b> TÊN NGƯỜI DÙNG </b></label><br>\n"
                    + "            <input style=\"width: 95%\"type=\"text\" placeholder=\"TÊN\" name=\"name\" required><br>\n"
                    + "            <label style=\"width: 100%;float: left;color: blue;font-weight: bold;\"><b>MẬT KHẨU</b></label><br>\n"
                    + "            <input style=\"width: 95%\"type=\"password\" placeholder=\"MẬT KHẨU\" name=\"password\" required><br>\n"
                    + "            <label style=\"width: 100%;float: left;color: blue;font-weight: bold;\"><b> NHẬP LẠI MẬT KHẨU</b></label><br>\n"
                    + "            <input style=\"width: 95%\"type=\"password\" placeholder=\"NHẬP LẠI MẬT KHẨU\" name=\"password\" required><br>\n"
                    + "            <button style=\"width: 95%\"type=\"submit\"> ĐĂNG KÝ </button>\n"
                    + "        </div>\n"
                    + "        <div class=\"container\" style=\"background-color:#f1f1f1\">\n"
                    + "            <button type=\"button\" class=\"cancelbtn\">Cancel</button>\n"
                    + "        </div>\n"
                    + "</div>\n"
                    + "\n"
                    + "</form>\n"
                    + "</body>\n"
                    + "</html>");
        } catch (IOException ex) {
            Logger.getLogger(SignIn.class.getName()).log(Level.SEVERE, null, ex);
        }

    }

    private void gotoDiagram() {
        try {
            mResponse.sendRedirect(mRequest.getContextPath() + "/Diagram");
        } catch (IOException ex) {
            Logger.getLogger(LogIn.class.getName()).log(Level.SEVERE, null, ex);
        }
    }
    
    private void gotoLogin() {
        try {
            mResponse.sendRedirect(mRequest.getContextPath() + "/LogIn");
        } catch (IOException ex) {
            Logger.getLogger(LogIn.class.getName()).log(Level.SEVERE, null, ex);
        }
    }

    @Override
    protected void doGet(HttpServletRequest request, HttpServletResponse response)
            throws ServletException, IOException {
        processRequest(request, response);
    }

    @Override
    protected void doPost(HttpServletRequest request, HttpServletResponse response)
            throws ServletException, IOException {
        processRequest(request, response);
    }
}
