/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package servlet.web;

import java.io.IOException;
import java.io.PrintWriter;
import java.util.logging.Level;
import java.util.logging.Logger;
import javax.servlet.ServletException;
import javax.servlet.annotation.WebServlet;
import javax.servlet.http.HttpServlet;
import javax.servlet.http.HttpServletRequest;
import javax.servlet.http.HttpServletResponse;
import servlet.MySession;

/**
 *
 * @author tungt
 */
@WebServlet(name = "Diagram", urlPatterns = {"/Diagram"})
public class Diagram extends HttpServlet {
    
    HttpServletRequest mRequest;
    HttpServletResponse mResponse;

    protected void processRequest(HttpServletRequest request, HttpServletResponse response)
            throws ServletException, IOException {
        mRequest = request;
        mResponse = response;
        MySession mySession = new MySession(request);
        if (mySession.check()) {
            loadPage();
        } else {
            gotoLogIn();
        }
    }

    public void loadPage() {
        //load html here
        PrintWriter echo;
        try {
            echo = mResponse.getWriter();
            echo.println("<a href=\"LogOut\">Log out</a>");
        } catch (IOException ex) {
            Logger.getLogger(Diagram.class.getName()).log(Level.SEVERE, null, ex);
        }
    }
    
    public void gotoLogIn() {
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
