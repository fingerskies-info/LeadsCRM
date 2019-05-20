function inputLimiter(e,allow)
{

    var AllowableCharacters = '';

    if (allow == 'Letters'){
        AllowableCharacters=' ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';
    }

    if (allow == 'Numbers'){
        AllowableCharacters='1234567890';
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

function confirmDelete(msg,action){
    var conmsg = confirm(msg);
    if(conmsg){
        window.location.href=action;
    }else{
        return false;
    }
    
}

function serealizeSelects (select)
{
    var array = [];
    select.each(function(){ array.push($(this).val()) });
    return array;
}
function getSearchEnquiryResult(){
    var txt_mobile = $('#txt_mobile').val();
    var sel_staffname = $('#sel_staffname').val();
    var sel_enquiry_type = $('#sel_enquiry_type').val();
    var txt_enquiry_sdate = $('#txt_enquiry_sdate').val();
    var txt_enquiry_edate = $('#txt_enquiry_edate').val();
    $.ajax({
        type: "POST",
        url: SITE+'index.php/report/search',
        data: 'txt_mobile='+txt_mobile+'&sel_staffname='+sel_staffname+'&sel_enquiry_type='+sel_enquiry_type+'&txt_enquiry_sdate='+txt_enquiry_sdate+'&txt_enquiry_edate='+txt_enquiry_edate,
        cache: false,
        beforeSend:function(){
            $("#resultdiv").html('<tr><td colspan="100%" align="center"><img src="'+SITE+'images/loading.gif" /></td></tr>');
        },
        success: function(result) {
            
            $("#resultdiv").html(result);
               
      
        }
    });
}
function getSearchFeedbackResult(){
	var txt_mobile = $('#txt_mobile').val();
    var sel_staffname = $('#sel_staffname').val();
    var txt_feedback_sdate = $('#txt_feedback_sdate').val();
    var txt_feedback_edate = $('#txt_feedback_edate').val();
    $.ajax({
        type: "POST",
        url: SITE+'index.php/report/search_feedback',
        data: 'txt_mobile='+txt_mobile+'&sel_staffname='+sel_staffname+'&txt_feedback_sdate='+txt_feedback_sdate+'&txt_feedback_edate='+txt_feedback_edate,
        cache: false,
        beforeSend:function(){
            $("#resultdiv").html('<tr><td colspan="100%" align="center"><img src="'+SITE+'images/loading.gif" /></td></tr>');
        },
        success: function(result) {
            
            $("#resultdiv").html(result);
               
      
        }
    });
}

function getStaffList(){
	  $.ajax({
        type: "POST",
        url: SITE+'index.php/staff/staffListdrp',
        data: '',
        cache: false,
        success: function(result) {
			$('#staffdropdown_fld').html(result);
		}
			 });
}
function getTopicIssue(compid,natureid,prblmid) {
   //alert(natureid);
    $.ajax({
        type: "POST",
        url: SITE+'index.php/master/prblm_topic',
        data: 'topicid='+compid+'&comp_id='+natureid+'&prblm_id='+prblmid,
        cache: false,
        success: function(result) {
            //alert(result);
            $("#sel_prblm_id").
            html("");
            
            $("#sel_prblm_id").
            html("<option value='0'>Select Issue</option>");
        
            $("#sel_prblm_id").append(result);
        }

    });
}

function getIssueRootCause(compid,rc_id) {
   
    $.ajax({
        type: "POST",
        url: SITE+'index.php/master/rc_issue',
        data: 'issueid='+compid+'&rc_id='+rc_id,
        cache: false,
        success: function(result) {
            //alert(result);
            $("#selrootcause").
            html("");
            if(result==""){
                $("#selrootcause").
            html("<option value='0'>No root cause to choose</option>"); 
            }else{
                      
            $("#selrootcause").
            html("<option value='0'>Select Root Cause</option>");
            }
            $("#selrootcause").append(result);
        }

    });
}
function getCompField(val){
        
        if(val==2 || val==3){
            $('#txtcustname').attr("required","required");
            $('#txtcustname').css({
                    "border": "1px solid red",
                    "background": "#FFCECE"
                });
            $('#txtcustacc').attr("required","required");
            $('#txtcustacc').css({
                    "border": "1px solid red",
                    "background": "#FFCECE"
                });
            $('#txtcustnric').attr("required","required");
            $('#txtcustnric').css({
                    "border": "1px solid red",
                    "background": "#FFCECE"
                });
            $('#txtcustmobile').attr("required","required");
            $('#txtcustmobile').css({
                    "border": "1px solid red",
                    "background": "#FFCECE"
                });
            $('#txtcustaddress').attr("required","required");
            $('#txtcustaddress').css({
                    "border": "1px solid red",
                    "background": "#FFCECE"
                });
            $('#txtorderdate').attr("required","required");
            $('#txtorderdate').css({
                    "border": "1px solid red",
                    "background": "#FFCECE"
                });
            $('#txtcustipnum').attr("required","required");
            $('#txtcustipnum').css({
                    "border": "1px solid red",
                    "background": "#FFCECE"
                });
            $('#txtbrandcode').attr("required","required");
            $('#txtbrandcode').css({
                    "border": "1px solid red",
                    "background": "#FFCECE"
                });
            $('#txtmodelno').attr("required","required");
            $('#txtmodelno').css({
                    "border": "1px solid red",
                    "background": "#FFCECE"
                });
            $('#txtcustdesc').attr("required","required");
            $('#txtcustdesc').css({
                    "border": "1px solid red",
                    "background": "#FFCECE"
                });
            $('#txtshipdate').attr("required","required");
            $('#txtshipdate').css({
                    "border": "1px solid red",
                    "background": "#FFCECE"
                });
            $('#txtshipqnty').attr("required","required");
            $('#txtshipqnty').css({
                    "border": "1px solid red",
                    "background": "#FFCECE"
                });
                
           if(val==3){ //Only Complains
            $('#selrootcause').attr("required","required");
            $('#selrootcause').css({
                    "border": "1px solid red",
                    "background": "#FFCECE"
                });
            $('#selown_rootcause').attr("required","required");
            $('#selown_rootcause').css({
                    "border": "1px solid red",
                    "background": "#FFCECE"
                });
           }
         }else{
            $('#txtcustname').removeAttr("required");
            $('#txtcustname').css({
                    "border": "",
                    "background": ""
                });
                
            $('#txtcustacc').removeAttr("required");
            $('#txtcustacc').css({
                    "border": "",
                    "background": ""
                });
            $('#txtcustnric').removeAttr("required");
            $('#txtcustnric').css({
                    "border": "",
                    "background": ""
                });
            $('#txtcustmobile').removeAttr("required");
            $('#txtcustmobile').css({
                    "border": "",
                    "background": ""
                });
            $('#txtcustaddress').removeAttr("required");
            $('#txtcustaddress').css({
                    "border": "",
                    "background": ""
                });
            $('#txtorderdate').removeAttr("required");
            $('#txtorderdate').css({
                    "border": "",
                    "background": ""
                });
            $('#txtcustipnum').removeAttr("required");
            $('#txtcustipnum').css({
                    "border": "",
                    "background": ""
                });
            $('#txtbrandcode').removeAttr("required");
            $('#txtbrandcode').css({
                    "border": "",
                    "background": ""
                });
            $('#txtmodelno').removeAttr("required");
            $('#txtmodelno').css({
                    "border": "",
                    "background": ""
                });
            $('#txtcustdesc').removeAttr("required");
            $('#txtcustdesc').css({
                    "border": "",
                    "background": ""
                });
            $('#txtshipdate').removeAttr("required");
            $('#txtshipdate').css({
                    "border": "",
                    "background": ""
                });
            $('#txtshipqnty').removeAttr("required");
            $('#txtshipqnty').css({
                    "border": "",
                    "background": ""
                });
            $('#selrootcause').removeAttr("required");
            $('#selrootcause').css({
                    "border": "",
                    "background": ""
                });
            $('#selown_rootcause').removeAttr("required");
            $('#selown_rootcause').css({
                    "border": "",
                    "background": ""
                });
           
        }
    }
    function DoActionOnStatus(statusid){
        var now = new Date();

        var day = ("0" + now.getDate()).slice(-2);
        var month = ("0" + (now.getMonth() + 1)).slice(-2);

        var today = (day)+"-"+(month)+"-"+now.getFullYear() ;
        var totime = now.getHours()+":"+now.getMinutes();
        //1:Open;2:resolved;3:Escalated
        if(statusid==2){
            $('#txtclosuredate').val(today);
            $('#txtclosuredate').attr("required","required");
            $('#txtclosuredate').css({
                    "border": "1px solid red",
                    "background": "#FFCECE"
                });
            $('#txtclosuretime').val(totime);
            $('#txtclosuretime').attr("required","required");
            $('#txtclosuretime').css({
                    "border": "1px solid red",
                    "background": "#FFCECE"
                });
        }else{
            $('#txtclosuredate').val("");
            $('#txtclosuredate').css({
                    "border": "",
                    "background": ""
                });
            $('#txtclosuretime').val("");
            $('#txtclosuretime').css({
                    "border": "",
                    "background": ""
                });
        }
        if(statusid==3){
            $('#txtcase_to').attr("required","required");
            
            $('#txtcase_to').css({
                    "border": "1px solid red",
                    "background": "#FFCECE"
                });
            $('#txtaction_msg').attr("required","required");
            $('#txtaction_msg').css({
                    "border": "1px solid red",
                    "background": "#FFCECE"
                });
            $('#txtaction_duedate').attr("required","required");
            $('#txtaction_duedate').css({
                    "border": "1px solid red",
                    "background": "#FFCECE"
                });
        }else{
            $('#txtcase_to').removeAttr("required");
            $('#txtcase_to').css({
                    "border": "",
                    "background": ""
                });
            $('#txtaction_msg').removeAttr("required");
            $('#txtaction_msg').css({
                    "border": "",
                    "background": ""
                });
            $('#txtaction_duedate').removeAttr("required");
            $('#txtaction_duedate').css({
                    "border": "",
                    "background": ""
                });
    }
}

