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
@WebServlet(name = "LogIn", urlPatterns = {"/LogIn"})
public class LogIn extends HttpServlet {

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
        String email = (String) request.getParameter("email");
        if (email == null || email.length() == 0) {
            //load form and return
            Echo.print("11111111111111111111111");
            loadForm();
            return;
        }
        String password = (String) request.getParameter("password");
        if (password == null || password.length() == 0) {
            //load form and return
            Echo.print("222222222222222222222222");
            loadForm();
            return;
        }
        User user = new User();
        user.setEmail(email.toLowerCase());
        user.setPassword(password);
        DBHelperWeb dbHelper = new DBHelperWeb();
        dbHelper.setmUser(user);
        if (dbHelper.checkLogIn()) {
            //add session and go to diagram
            mySession.addSession();
            gotoDiagram();
        } else {
            //load form and return
            loadForm();
        }
    }

    private void gotoDiagram() {
        try {
            mResponse.sendRedirect(mRequest.getContextPath() + "/Diagram");
        } catch (IOException ex) {
            Logger.getLogger(LogIn.class.getName()).log(Level.SEVERE, null, ex);
        }
    }

    private void loadForm() {
        PrintWriter echo;
        try {
            echo = mResponse.getWriter();
            echo.println("<!DOCTYPE html>\n"
                    + "<html>\n"
                    + "    <head>\n"
                    + "        <title>Log in</title>\n"
                    + "        <meta charset=\"UTF-8\">\n"
                    + "        <meta name=\"viewport\" content=\"width=device-width, initial-scale=1.0\">\n"
                    + "    </head>\n"
                    + "    <body>\n"
                    + "        <form action=\"LogIn\" method=\"post\">\n"
                    + "            Email: <input type=\"email\" name=\"email\"> <br>\n"
                    + "            Password: <input type=\"password\" name=\"password\"> <br>\n"
                    + "            <input type=\"submit\" value=\"Log In\">\n"
                    + "        </form>\n"
                    + "    </body>\n"
                    + "</html>");
        } catch (IOException ex) {
            Logger.getLogger(LogIn.class.getName()).log(Level.SEVERE, null, ex);
        }
    }

    @Override
    protected void doPost(HttpServletRequest request, HttpServletResponse response)
            throws ServletException, IOException {
        processRequest(request, response);
    }

    @Override
    protected void doGet(HttpServletRequest req, HttpServletResponse resp) throws ServletException, IOException {

        processRequest(req, resp);
    }

}
