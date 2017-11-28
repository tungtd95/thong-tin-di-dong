document.addEventListener("DOMContentLoaded", function(event) { 
    document.getElementById("time").value = Date();
    var arr = [8407892043,7407892043,1407892043,5407892043,
        6407892043,3407892043,44407892043,9407892043,123492834412, 182019283412, 3821392803,0234125214];
    var arr2 = [1, 2, 22, 33, 44, 55, 21, 90, 99, 82, 67, 54, 89];
    var index = Math.floor(Math.random()*10);
    document.getElementById("deviceIMEI").value = arr[index];
    var cam = Math.floor(Math.random()*100+1);
    document.getElementById("deviceName").value = "CAM-L" + arr2[index];
    document.getElementById("humid").value = Math.floor(Math.random()*100+1);
    document.getElementById("temp").value = Math.floor(Math.random()*100+1);
    document.getElementById("pin").value = Math.floor(Math.random()*100+1);
    document.getElementById("pressure").value  = Math.floor(Math.random()*1000+1);
    document.getElementById("coord").value = Math.random()*180 + " " + Math.random()*180;
});