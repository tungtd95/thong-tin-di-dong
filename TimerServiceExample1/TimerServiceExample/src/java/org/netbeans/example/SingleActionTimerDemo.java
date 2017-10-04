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
public class SingleActionTimerDemo {

    @Resource
    private TimerService timerService;

    @PostConstruct
    private void init() {
        TimerConfig timerConfig = new TimerConfig();
        timerConfig.setInfo("SingleActionTimerDemo_Info");
        timerService.createSingleActionTimer(5000, timerConfig); // after 5 seconds
        System.out.println("INIT Time : " + new Date());
    }

    @Timeout
    public void execute(Timer timer) {
        System.out.println("Timer Service : " + timer.getInfo());
        System.out.println("Execution Time : " + new Date());
        System.out.println("____________________________________________");   
    }

}
