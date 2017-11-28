/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package org.netbeans.example;

import java.util.Date;
import javax.ejb.Singleton;
import javax.ejb.LocalBean;
import javax.ejb.Schedule;
import javax.ejb.Startup;
import javax.ejb.Timer;

/**
 *
 * @author jGauravGupta
 */
@Singleton
@LocalBean
public class CalendarAutoTimerDemo {

    @Schedule(second="13,34,57", minute="*", hour="*")
    public void execute(Timer timer) {
        System.out.println("Executing ...");
        System.out.println("Execution Time : " + new Date());
        System.out.println("____________________________________________");   
    }

} 
