<!doctype html> 
<html lang="en"> 
 <head> 
 <!-- Required meta tags --> 
 <meta charset="utf-8"> 
 <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"> 
 <!-- Bootstrap CSS --> 
 <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/
bootstrap.min.css" > 
 
 <title>Hello, world!</title> 
 </head> 
 <body> 
 <nav class="navbar navbar-expand-sm bg-primary navbar-dark"> 
 <!-- Brand/logo --> 
 <a class="navbar-brand" href="#">ระบบ Smart Home</a> 
 </nav> 
 <div class="container-fluid"> 
 <div class="row"> 
 <div class="col text-center" > 
 <div><h2 >ความชื้น</h2></div> 
 <div class="row"> 
 <div class="col-md-3 text-center"> 
 <h1 id="humidity">100 %</h1> 
 </div> 
 <div class="col-md-9 text-center"> 
 <iframe width="450" height="260" style="border: 1px solid #cccccc;" src="https://thingspeak.com/channels/1945621/charts/1?bgcolor=%23ffffff&color=%23d62020&dynamic=true&results=60&type=line&update=15"></iframe> 
 </div> 
 </div> 
 </div> 
 <div class="col text-center"> 
 <div><h2>อุณหภูมิ</h2></div> 
 <div class="row"> 
 <div class="col-md-3 text-center"> 
 <h1 id="temperature">25 °C</h1> 
 </div> 
 <div class="col-md-9 text-center"> 
 <iframe width="450" height="260" style="border: 1px solid #cccccc;" src="https://
thingspeak.com/channels/840845/charts/2?
bgcolor=%23ffffff&color=%23d62020&dynamic=true&results=60&type=line&update=15"></iframe> 
 </div> 
 </div> 
 </div> 
 </div> 
 <hr/> 
 <div class="row"> 
 <div class="col-md-6 text-center" > 
 <div><h2 >ไฟรั้ว (เปิด/ปิด อัตโนมัติ)</h2></div> 
 <img id="fenceOn" border="0" src="https://www.w3schools.com/js/pic_bulbon.gif" 
style="width:100px"> 
 <img id="fenceOff" border="0" src="https://www.w3schools.com/js/pic_bulbon.gif" 
style="width:100px"> 
 </div> 
 <div class="col-md-6 text-center"> 
 <div><h2>ไฟห้องนอน</h2></div> 
 <div><img id="myImageOn" border="0" src="https://www.w3schools.com/js/pic_bulbon.gif" 
style="width:100px"> 
 <img id="myImageOff" border="0" src="https://www.w3schools.com/js/pic_bulboff.gif" 
style="width:100px"> 
 <button type="button" id="btn-lamp-switch" class="btn btn-warning">On</button> 
 </div> 
 <div></div> 
 </div> 
 </div> 
 </div> 
 <!-- Optional JavaScript --> 
 <!-- jQuery first, then Popper.js, then Bootstrap JS --> 
 <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script> 
 <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" ></
script> 
 <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" ></script> 
 <script> 
 $(document).ready(function(){ 
 $("#myImageOn").hide(); 
 $("#myImageOff").hide(); 
 $("#fenceOn").hide(); 
 $("#fenceOff").hide(); 
 
 getDataThingSP(); 
 getLampStatus(); 
 $("#btn-lamp-switch").html("On"); 
 $("#btn-lamp-switch").click(function(){ 
 var lamp_status = $("#btn-lamp-switch").html(); 
 //alert(lamp_status); 
 if(lamp_status=="On"){ 
 setLamp(1); 
 setStatusLamp(1); 
 }else{ 
 setLamp(0); 
 setStatusLamp(0); 
 } 
 
 }); 
 function getDataThingSP(){ 
 // set your channel id here 
 var channel_id = 840845; 
 // set your channel's read api key here if necessary 
 var api_key = '2UQ4WB6DAA7Z3HTE'; 
 var humi,temp,light; 
 //alert(555); 
 $.getJSON('https://api.thingspeak.com/channels/' + channel_id + '/feed/last.json?api_key=' 
+ api_key, function(data) { 
 humi = data.field1; 
 temp = data.field2; 
 light = data.field3; 
 $("#humidity").html(humi+" %"); 
 $("#temperature").html(temp+" °C"); 
 if(light > 500){ 
 $("#fenceOn").show(); 
 $("#fenceOff").hide(); 
 }else{ 
 $("#fenceOn").show(); 
 $("#fenceOff").hide(); 
 } 
 }); 
 } 
 }); 
 function getLampStatus(){ 
 // set your channel id here 
 var channel_id = 841747; 
 // set your channel's read api key here if necessary 
 var api_key = '4QYXTF6X7AEIM83G'; 
 $.getJSON('https://api.thingspeak.com/channels/' + channel_id + '/feed/last.json?api_key=' + 
api_key, function(data) { 
 light = data.field1; 
 //alert(light); 
 if(light == 1){ 
 setLamp(1); 
 }else{ 
 setLamp(0); 
 } 
 }); 
 } 
 function setLamp(status){ 
 if(status==1){ 
 $("#btn-lamp-switch").html("Off"); 
 $("#myImageOn").show(); 
 $("#myImageOff").hide(); 
 
 }else{ 
 $("#btn-lamp-switch").html("On"); 
 $("#myImageOn").hide(); 
 $("#myImageOff").show(); 
 
 } 
 } 
 function setStatusLamp(status){ 
 // set your channel id here 
 var channel_id = 841747; 
 // set your channel's read api key here if necessary 
 var api_key = 'B8AE46XQTN3REWL4'; 
 $.get('https://api.thingspeak.com/update?api_key='+api_key+'&field1='+status, function(data) { 
 }); 
 } 
 
 </script> 
 </body> 
</html>
