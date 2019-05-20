function RoundAmt(amt){
    return parseFloat(Math.round(amt/0.05,0)*0.05).toFixed(2);
}
function confirmDelete(msg,action){
    var conmsg = confirm(msg);
    if(conmsg){
        window.location.href=action;
    }else{
        return false;
    }
    
}
function inputLimiter(e,allow)
{

    var AllowableCharacters = '';

    if (allow == 'Letters'){
        AllowableCharacters=' ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';
    }

    if (allow == 'Numbers'){
        AllowableCharacters='1234567890.';
    }

    if (allow == 'MobileNumbers'){
        AllowableCharacters='1234567890+-().';
    }

    if (allow == 'NameCharacters'){
        AllowableCharacters=' ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz-.\'';
    }

    if (allow == 'NameCharactersAndNumbers'){
        AllowableCharacters='1234567890 ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz-\'';
    }

    if (allow == 'Price'){
        AllowableCharacters='1234567890.';
    }

    if (allow == 'Password'){
        AllowableCharacters='ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz1234567890';
    }
 
    if (allow == 'Date'){
        AllowableCharacters='1234567890-';
    }

    var k;

    k=document.all?parseInt(e.keyCode): parseInt(e.which);

    if (k!=13 && k!=8 && k!=0){

        if ((e.ctrlKey==false) && (e.altKey==false)) {

            return (AllowableCharacters.indexOf(String.fromCharCode(k))!=-1);

        } else {

            return true;

        }

    } else {

        return true;

    }
}






function CalcAge(d){
    var today = new Date(); 

    if (!/\d{2}\-\d{2}\-\d{4}/.test(d)) {   // check valid format
        return false;
    }
    d = d.split("-");
    var byr = parseInt(d[2]); 
  
    var nowyear = today.getFullYear();
    if (byr > nowyear || byr < 1900) {  // check valid year
        return false;
    }
    var bmth = parseInt(d[1],10)-1;  
 
    var bdy = parseInt(d[0],10); 
 
    var age = nowyear - byr;
    var nowmonth = today.getMonth();
    var nowday = today.getDate();
    if (bmth > nowmonth) {
        age = age - 1
    }  // next birthday not yet reached
    else if (bmth == nowmonth && nowday < bdy) {
        age = age - 1
    }
    return age;
}


function GetConfirmation(msg,formid){
   var conmsg = confirm(msg);
   if(conmsg){
       $(formid).submit();
       return true;
   }else{
       return false;
   }
}

function OpenInNewTab(transid,agrt_id)
{
  var win=window.open(SITE+'trans/receiptprint/'+agrt_id+'/'+transid, '_blank');
  win.focus();
}