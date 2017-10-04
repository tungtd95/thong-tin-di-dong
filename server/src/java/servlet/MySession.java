package servlet;

import java.util.Enumeration;
import javax.servlet.DispatcherType;
import javax.servlet.http.HttpServletRequest;
import javax.servlet.http.HttpSession;
import ulti.SessionUlti;

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 *
 * @author tungt
 */
public class MySession {
    HttpServletRequest mRequest;
    
    public MySession(HttpServletRequest request) {
        this.mRequest = request;
    }
    public boolean check() {
        boolean status = false;
        HttpSession session = mRequest.getSession();
        Enumeration e = session.getAttributeNames();
        if (e.hasMoreElements()) {
            String name = e.nextElement().toString();
            String login_status = session.getAttribute(name).toString();
            if (name == SessionUlti.NAME && login_status == SessionUlti.STATUS_OK) {
                status = true;
            }
        }
        return status;
    }
    public void addSession() {
        mRequest.getSession().setAttribute(ulti.SessionUlti.NAME, ulti.SessionUlti.STATUS_OK);
    }
}
