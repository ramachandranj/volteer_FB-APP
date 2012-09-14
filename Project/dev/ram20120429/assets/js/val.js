
$(document).ready(function()
{
var time= $("#time");
var timeinfo= $("#timeinfo");
var long1= $("#long");
var long1info= $("#longinfo");
var why = $("#why");
var where = $("#where");
var whereinfo = $("#whereinfo");
var whyinfo = $("#whyinfo");
var wheninfo = $("#wheninfo");
var form = $("#myform");
var submit=$("#submit");
var name = $("#eventname");
var nameinfo = $("#nameinfo");
var input = $("#fileinput");
var select = $("#select");
var selectinfo = $("#selectinfo");
var date=$("#dp1");
var now = new Date();
long1info.text(" hour(s) ");
date.datepicker({
    duration:"fast",
    changeMonth: true,
	mode: 'multiple',
    changeYear: true,
    constrainInput: true,
    minDate: 0,
 });

 
function validatename()
{
if(name.val().length<3)
{
nameinfo.addClass("error");
//name.addClass("error");
nameinfo.text("Enter names with more than 3 letters");
//name.placeholder("enter more than 5 u ass");
return false; }
else
{
nameinfo.text(" ");
nameinfo.removeClass("error");
return true;
}
}


function validatewhy()
{
if(why.val().length<3)
{
whyinfo.addClass("error");
//name.addClass("error");
whyinfo.text("Enter name with 3 letters");

return false; 
}
else
{
whyinfo.text(" ");
whyinfo.removeClass("error");
return true;
}
}

function validatewhere()
{
//alert('aaaaa');
var text=where.val() ;
var t=text.split(",");
//alert( t[1]);
var len=t.length;
var zip=t[len-1].split(" ");
//alert(t.length );

//whereinfo.text(t[0]);



if(t.length <3 || (zip[1]==null))
{
whereinfo.addClass("error");
//name.addClass("error");
whereinfo.text("Enter as street address,city,state zip");
//name.placeholder("enter more than 5 u ass");
return false; 
}

else
{
whereinfo.text(" ");
whereinfo.removeClass("error");
return true;
} 
}

function validateselect()
{
if(select.val().length <1)
{
selectinfo.addClass("error");
//name.addClass("error");
selectinfo.text("please choose a category");
//name.placeholder("enter more than 5 u ass");
return false; }
else
{
selectinfo.text(" ");
selectinfo.removeClass("error");
return true;
}
}

function validatetime()
{
if(time.val().length <1)
{
timeinfo.addClass("error");
//name.addClass("error");
timeinfo.text("please enter a time");
//name.placeholder("enter more than 5 u ass");
return false; }
else
{
timeinfo.text(" ");
timeinfo.removeClass("error");
return true;
}
}

function validatelong1()
{
if(long1.val().length <1)
{
long1info.addClass("error");
//name.addClass("error");
long1info.text("please enter the duration");
//name.placeholder("enter more than 5 u ass");
return false; }
else
{
long1info.text(" hour(s) ");
long1info.removeClass("error");
return true;
}
}

long1.keydown(function(event) {
   if(event.shiftKey)
   {
        event.preventDefault();
   }

   if (event.keyCode == 46 || event.keyCode == 8)    {
   }
   else {
        if (event.keyCode < 95) {
          if (event.keyCode < 48 || event.keyCode > 57) {
                event.preventDefault();
          }
        } 
        else {
              if (event.keyCode < 96 || event.keyCode > 105) {
                  event.preventDefault();
              }
        }
      }
   });
function dispdate()
{
var twoDigitMonth = ((now.getMonth().length+1) === 1)? (now.getMonth()+1) : '0' + (now.getMonth()+1);
var currentDate = twoDigitMonth + "/" + now.getDate() + "/" + ((now.getFullYear()) % 100);
wheninfo.text('date today:' + now + 'formatted :' + currentDate);

var dateval=date.val();   // selected values
var mm=dateval.substring(0,2);  // selected month
var dd=dateval.substring(3,5);  // selected date
var yy=dateval.substring(6,8); // selected year

( dd<  now.getDate() )
if( (yy < ((now.getFullYear()) % 100) ) || ((yy == ((now.getFullYear()) % 100)) & (mm<twoDigitMonth)  )  || ((yy == ((now.getFullYear()) % 100)) & (mm==twoDigitMonth) && ( dd<  now.getDate() )  )    )
{
wheninfo.addClass("error");
wheninfo.text('Time travel to past has not been invented yet, please choose a date in the future.');
return false;
}
else
{
wheninfo.text(" ");
wheninfo.removeClass("error");
return true;
}
}

date.change(dispdate);
date.focusout(dispdate);
name.blur(validatename);
time.blur(validatetime); 
long1.blur(validatelong1); 
why.blur(validatewhy); 
where.blur(validatewhere); 
select.blur(validateselect);  
//pass2.blur(validatePass2);  
//On key press  
name.keyup(validatename);  
time.keyup(validatetime);  
time.focusout(validatetime);
where.keyup(validatewhere);  
long1.focusout(validatelong1); 
why.keyup(validatewhy); 
long1.keyup(validatelong1); 
select.focusout(validateselect);  
//message.keyup(validateMessage);  

form.submit(function(){  
 
    if(validatewhy() & validatename()& validatewhere() &validateselect() & validatetime() & validatelong1() & dispdate()){
	
        return true 
 }
    else  {
	
        return false;  
 }
});
});