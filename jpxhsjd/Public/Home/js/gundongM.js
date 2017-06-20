// JavaScript Document

var speed=20; //数字越大速度越慢
var tabM=document.getElementById("demoM");
var tab1M=document.getElementById("demo1M");
var tab2M=document.getElementById("demo2M");
tab2M.innerHTML=tab1M.innerHTML;
function Marquee(){
if(tab2M.offsetWidth-tabM.scrollLeft<=0)
tabM.scrollLeft-=tab1M.offsetWidth
else{
tabM.scrollLeft++;
}
}
var MyMar=setInterval(Marquee,speed);
