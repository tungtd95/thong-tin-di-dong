/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package org.netbeans.example;

import java.util.Date;
import javax.annotation.PostConstruct;
import javax.annotation.Resource;
import javax.ejb.Singleton;
import javax.ejb.LocalBean;
import javax.ejb.ScheduleExpression;
import javax.ejb.Startup;
import javax.ejb.Timeout;
import javax.ejb.Timer;
import javax.ejb.TimerConfig;
import javax.ejb.TimerService;

/**
 *
 * @author jGauravGupta
 */
@Singleton
@LocalBean
@Startup
public class CalendarProgTimerDemo {

    @Resource
    private TimerService timerService;

    @PostConstruct
    private void init() {
        TimerConfig timerConfig = new TimerConfig();
        timerConfig.setInfo("CalendarProgTimerDemo_Info");
        ScheduleExpression schedule = new ScheduleExpression();
        schedule.hour("*").minute("*").second("13,34,57");
        timerService.createCalendarTimer(schedule, timerConfig); 
    } 

    @Timeout
    public void execute(Timer timer) {
        System.out.println("Timer Service : " + timer.getInfo());
        System.out.println("Execution Time : " + new Date());
        System.out.println("____________________________________________");   
    }

}
