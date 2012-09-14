
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
var form = $("#myform");
var submit=$("#submit");
var name = $("#eventname");
var nameinfo = $("#nameinfo");
var input = $("#fileinput");
var select = $("#select");
var selectinfo = $("#selectinfo");
var date=$("#date");

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
whyinfo.text("is this shown or not ?? fuck you");
//name.placeholder("enter more than 5 u ass");
return false; 
}
else
{
whyinfo.text(" ");
whyinfo.removeClass("error");
return true;
}
}

function dispdate()
{

$("#date").datepicker();

}


function validatewhere()
{
alert('aaaaa');
var text=where.val() ;
var t=text.split(" ");
//alert( t[1]);
/*
var arraystr=where.val.split(',');
for (var i=0; i < arraystr.length; i++)  
    alert(arraystr[i]); 
alert(i); */
//alert(t.length );
//alert(t.length()) ;
whereinfo.text("t[0]");
selectinfo.text(t[0]);
//selectinfo.text()
/*
if(where.val().indexOf(",") <2)
{
whereinfo.addClass("error");
//name.addClass("error");
whereinfo.text("Enter as <street address>,<city>,<state> <zip>");
//name.placeholder("enter more than 5 u ass");
return false; 
}

else
{
whereinfo.text(" ");
whereinfo.removeClass("error");
return true;
} */
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
long1info.text(" ");
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



$('#date').focus(function() {
  alert('Handler for .focus() called.');
});

date.focus(dispdate);
//On blur  
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
 
    if(validatewhy() & validatename()& validatewhere() &validateselect() & validatetime() & validatelong1()){
	
        return true 
 }
    else  {
	
        return false;  
 }
});






});