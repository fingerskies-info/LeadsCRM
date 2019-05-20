<?php
if($id!=""){
        $ccit_cust_name = $enquirydet[0]->ccit_cust_name;
        $ccit_cust_account = $enquirydet[0]->ccit_cust_account;
        $ccit_custnric = $enquirydet[0]->ccit_custnric;
        $ccit_mobile = $enquirydet[0]->ccit_mobile;
        $ccit_del_address = $enquirydet[0]->ccit_del_address;
        $ccit_orderdate = ($enquirydet[0]->ccit_orderdate!='0000-00-00' && $enquirydet[0]->ccit_orderdate!='1970-01-01')?date('d-m-Y',strtotime($enquirydet[0]->ccit_orderdate)):'';
        $ccit_ip_number =$enquirydet[0]->ccit_ip_number;
        $ccit_brand_name = $enquirydet[0]->ccit_brand_name;
        $ccit_vendor_modelno = $enquirydet[0]->ccit_vendor_modelno;
        $ccit_cust_desc = $enquirydet[0]->ccit_cust_desc; 
        $ccit_ship_date=($enquirydet[0]->ccit_ship_date!='0000-00-00' && $enquirydet[0]->ccit_ship_date!='1970-01-01')?date('d-m-Y',strtotime($enquirydet[0]->ccit_ship_date)):'';
        $ccit_ship_qnty=$enquirydet[0]->ccit_ship_qnty;
        $cit_caller_name=$enquirydet[0]->cit_caller_name;
        $cit_callernum=$enquirydet[0]->cit_callernum;
        $cit_call_times=$enquirydet[0]->cit_call_times;
        $schannel_id_fk=$enquirydet[0]->schannel_id_fk;
        $prdc_cat_id_fk=$enquirydet[0]->prdc_cat_id_fk;
        $tp_id_fk=$enquirydet[0]->tp_id_fk;
        $cn_id_fk = $enquirydet[0]->cn_id_fk;
        $ct_id_fk=$enquirydet[0]->ct_id_fk;
        $prblm_id_fk=$enquirydet[0]->prblm_id_fk;
        $cit_id_fk=$enquirydet[0]->cit_id_fk;
        $rc_id_fk=$enquirydet[0]->rc_id_fk;
        $orc_id_fk=$enquirydet[0]->orc_id_fk;
        $con_id_fk=$enquirydet[0]->con_id_fk;
        $cit_remarks=$enquirydet[0]->cit_remarks;
        $status_id_fk=$enquirydet[0]->status_id_fk;
        $cat_transfer_to=$enquirydet[0]->cat_transfer_to;
        $cat_action_msg=$enquirydet[0]->cat_action_msg;
        $cat_action_duedate=($enquirydet[0]->cat_action_duedate!='0000-00-00' && $enquirydet[0]->cat_action_duedate!='1970-01-01')?date('d-m-Y',strtotime($enquirydet[0]->cat_action_duedate)):'';
        $cat_closuredate=($enquirydet[0]->cat_closuredate!='0000-00-00' && $enquirydet[0]->cat_closuredate!='1970-01-01')?date('d-m-Y',strtotime($enquirydet[0]->cat_closuredate)):'';
        $cat_closuretime=$enquirydet[0]->cat_closuretime;
        $cct_staff_num=$enquirydet[0]->cct_staff_num;
        $cct_staff_name=$enquirydet[0]->cct_staff_name;
        $cct_staff_dept=$enquirydet[0]->cct_staff_dept;
        $cct_staff_store=$enquirydet[0]->cct_staff_store;
        $cct_for=$enquirydet[0]->cct_for;
        $cct_remarks=$enquirydet[0]->cct_remarks;
        $cet_exercised=$enquirydet[0]->cet_exercised;
        $cet_amount=$enquirydet[0]->cet_amount;
        $case_received = date('d-m-Y',strtotime($enquirydet[0]->case_received_date));
        $case_received_time = date('h:i',strtotime($enquirydet[0]->case_received_time));
        $case_number = $enquirydet[0]->case_number;
}
    ?>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Entry of Call Log
            <small>Management panel</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li>Entry of Call Log</li>
            <li class="active"><?= ucwords($title) ?></li>

        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <!-- Small boxes (Stat box) -->
        <div class="row">
            <div class="col-lg-12">
<!--                        <h4><?= ucwords($title) ?></h4>-->
                <form  name="myform" class="form-horizontal" role="form" action='<?php echo base_url(); ?>master/enquiry_save' method="post" onsubmit="return frmvalidate(this.form);">
                    <input type="hidden" name="id" value="<?= $id ?>" />
                    <?php if (isset($message)) { ?>
                        <div class="col-sm-12"><div class="alert alert-success"><?= $message ?></div></div>
                    <?php } else if (isset($error)) { ?>
                        <div class="col-sm-12"><div class="alert alert-danger"><?= $error ?></div></div>
                    <?php } ?>
                    <p><label class="text-danger">Required fields are marked with *</label></p>
                    <div class="form-group col-lg-12">
                        <div class="form-group">
                                <label for="firstName" class="col-lg-2 control-label"><label class="text-danger">*</label> Case Received Date</label>
                                <div class="col-lg-2">
                                    <input type="text" class="form-control datepicker" name="txtrecvd_date" id="txtrecvd_date" required   maxlength="30" onkeypress="return inputLimiter(event, 'NameCharactersAndNumbers')" value="<?= $case_received ?>"/>
                                </div>
                                <label for="firstName" class="col-lg-2 control-label"><label class="text-danger">*</label> Case Received Time</label>
                                <div class="col-lg-2">
                                    <input type="time" class="form-control" name="txtrecvd_time" id="txtrecvd_time"  required onkeypress="return inputLimiter(event, 'NameCharactersAndNumbers')" value="<?= $case_received_time ?>"/>
                                </div>
                                <label for="firstName" class="col-lg-2 control-label">Case Number (#) :</label>
                                <div class="col-lg-2">
                                    <b><input type="text" class="form-control" name="txtcase_number" id="txtcase_number"  readonly="readonly" value="<?= $case_number ?>"/></b>
                                </div>
                            </div>
                        <button type="button" class="btn btn-success" id="btncustinfo" data-toggle="collapse" data-target="#demo" title="Click to view / update customer details">
                            <span class="fa fa-user"></span> Customer Information
                        </button>

                        <div  id="demo" class="collapse">
                            <div class="form-group">
                                <label for="firstName" class="col-lg-2 control-label">Name</label>
                                <div class="col-lg-2">
                                    <input type="text" class="form-control" name="txtcustname" id="txtcustname" autofocus   maxlength="30" onkeypress="return inputLimiter(event, 'NameCharactersAndNumbers')" value="<?= $ccit_cust_name ?>"/>
                                </div>
                                <label for="firstName" class="col-lg-2 control-label">Account Number</label>
                                <div class="col-lg-2">
                                    <input type="text" class="form-control" name="txtcustacc" id="txtcustacc"  maxlength="12" onkeypress="return inputLimiter(event, 'Numbers')" value="<?= $ccit_cust_account ?>"/>
                                </div>
                                <label for="firstName" class="col-lg-2 control-label">NRIC</label>
                                <div class="col-lg-2">
                                    <input type="text" class="form-control" name="txtcustnric" id="txtcustnric"  maxlength="15" onkeypress="return inputLimiter(event, 'NameCharactersAndNumbers')" value="<?= $ccit_custnric ?>"/>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="firstName" class="col-lg-2 control-label">Mobile</label>
                                <div class="col-lg-2">
                                    <input type="text" class="form-control" name="txtcustmobile" id="txtcustmobile"  maxlength="8" onkeypress="return inputLimiter(event, 'Numbers')" value="<?= $ccit_mobile ?>"/>
                                </div>
                                <label for="firstName" class="col-lg-2 control-label">Delivery Address</label>
                                <div class="col-lg-2">
                                    <textarea  class="form-control" name="txtcustaddress" id="txtcustaddress"  cols="8" onkeypress="return inputLimiter(event, 'NameCharactersAndNumbers')" ><?= $ccit_del_address ?></textarea>
                                </div>
                                <label for="firstName" class="col-lg-2 control-label"><label id="f_comp"></label>Order Date</label>
                                <div class="col-lg-2">
                                    <input type="text" class="form-control datepicker" name="txtorderdate" id="txtorderdate"  onkeypress="return inputLimiter(event, 'NameCharactersAndNumbers')" value="<?= $ccit_orderdate ?>"/>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="firstName" class="col-lg-2 control-label">IP Number</label>
                                <div class="col-lg-2">
                                    <input type="text" class="form-control" name="txtcustipnum" id="txtcustipnum"   onkeypress="return inputLimiter(event, 'NameCharactersAndNumbers')" value="<?= $ccit_ip_number ?>"/>
                                </div>
                                <label for="firstName" class="col-lg-2 control-label"><label id="f_comp"></label>Brand Code</label>
                                <div class="col-lg-2">
                                    <input type="text" class="form-control" name="txtbrandcode" id="txtbrandcode"    onkeypress="return inputLimiter(event, 'NameCharactersAndNumbers')" value="<?= $ccit_brand_name ?>"/>
                                </div>
                                <label for="firstName" class="col-lg-2 control-label"><label id="f_comp"></label>Vendor Model No.</label>
                                <div class="col-lg-2">
                                    <input type="text" class="form-control" name="txtmodelno" id="txtmodelno"  onkeypress="return inputLimiter(event, 'NameCharactersAndNumbers')" value="<?= $ccit_vendor_modelno ?>"/>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="firstName" class="col-lg-2 control-label"><label id="f_comp"></label>Description</label>
                                <div class="col-lg-2">
                                    <textarea  class="form-control" name="txtcustdesc" id="txtcustdesc"  cols="8" onkeypress="return inputLimiter(event, 'NameCharactersAndNumbers')" ><?= $ccit_cust_desc ?></textarea>
                                </div>
                                <label for="firstName" class="col-lg-2 control-label"><label id="f_comp"></label>Shipment Date</label>
                                <div class="col-lg-2">
                                    <input type="text" class="form-control datepicker" name="txtshipdate" id="txtshipdate"   onkeypress="return inputLimiter(event, 'NameCharactersAndNumbers')" value="<?= $ccit_ship_date ?>"/>
                                </div>
                                <label for="firstName" class="col-lg-2 control-label"><label id="f_comp"></label>Quantity Shipped</label>
                                <div class="col-lg-2">
                                    <input type="text" class="form-control" name="txtshipqnty" id="txtshipqnty"  maxlength="5" onkeypress="return inputLimiter(event, 'Numbers')" value="<?= $ccit_ship_qnty ?>"/>
                                </div>
                            </div>
                           

                        </div>
                    </div>
                    <div class="form-group col-lg-12">
                        <button type="button" class="btn btn-info" id="btncaseinfo" data-toggle="collapse" data-target="#caseinfo" title="Click to view / update case details">
                            <span class="fa fa-newspaper-o"></span> Case Information
                        </button>

                        <div  id="caseinfo" class="collapse">
                            <div class="form-group">
                                <label for="firstName" class="col-lg-2 control-label"><label class="text-danger">*&nbsp;&nbsp;</label>Caller Name</label>
                                <div class="col-lg-2">
                                    <input type="text" class="form-control" name="txtcallername" id="txtcallername"  required onkeypress="return inputLimiter(event, 'NameCharactersAndNumbers')" value="<?= $cit_caller_name ?>"/>
                                </div>
                                <label for="firstName" class="col-lg-2 control-label"><label class="text-danger">*&nbsp;&nbsp;</label>Caller Number</label>
                                <div class="col-lg-2">
                                    <input type="text" class="form-control" name="txtcallernum" id="txtcallernum"  required maxlength="30" onkeypress="return inputLimiter(event, 'Numbers')" value="<?= $cit_callernum ?>"/>
                                </div>
                                <label for="firstName" class="col-lg-2 control-label"><label class="text-danger">*&nbsp;&nbsp;</label>No. times Customer Calls In </label>
                                <div class="col-lg-2">
                                    <select class="form-control" name="txtcalltimes" id="txtcalltimes" required>
                                        <?php for($i=1;$i<=20;$i++){ 
                                            $sel = $cit_call_times == $i?'selected':'';
                                            ?>
                                        <option value="<?=$i?>" <?=$sel?>><?=$i?></option>
                                        <?php } ?>
                                    </select>
                                    
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="firstName" class="col-lg-2 control-label"><label class="text-danger">*&nbsp;&nbsp;</label>Sales Channel</label>
                                <div class="col-lg-2">
                                   
                                    <select name="selsaleschannel" id="selsaleschannel" class="form-control" required>
                                        <option value="">--Select--</option>
                                        <?php 
                                        $sel = '';
                                        foreach($sales_channel as $sc){ 
                                            $sel = ($schannel_id_fk == $sc->schannel_id_pk)?'selected="selected"':'';
                                            ?>
                                        <option value="<?=$sc->schannel_id_pk?>" <?=$sel?>><?=$sc->scn_name?></option>
                                        <?php } ?>
                                    </select>
                                    
                                </div>
                                <label for="firstName" class="col-lg-2 control-label"><label class="text-danger">*&nbsp;&nbsp;</label>Product Category</label>
                                <div class="col-lg-2">
                                    <select name="selprodcat" id="selprodcat" class="form-control" required>
                                        <option value="">--Select--</option>
                                        <?php $psel = '';
                                        foreach($product_cat as $pc){ 
                                            $psel = ($prdc_cat_id_fk==$pc->prdc_cat_id_pk)?'selected="selected"':''; ?>
                                        <option value="<?=$pc->prdc_cat_id_pk?>" <?=$psel?>><?=$pc->prdc_cat_name?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                                <label for="firstName" class="col-lg-2 control-label"><label class="text-danger">*&nbsp;&nbsp;</label>Touch Point</label>
                                <div class="col-lg-2">
                                    <select name="seltouchpoint" id="seltouchpoint" class="form-control" required>
                                        <option value="">--Select--</option>
                                        <?php $tsel = '';
                                        foreach($touch_point as $tp){ 
                                            $tsel = ($tp_id_fk ==$tp->tp_id_pk)?'selected="selected"':'';
                                            ?>
                                        <option value="<?=$tp->tp_id_pk?>" <?=$tsel?>><?=$tp->tp_name?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="firstName" class="col-lg-2 control-label"><label class="text-danger">*&nbsp;&nbsp;</label>Nature of Case</label>
                                <div class="col-lg-2">
                                    <select name="selcasenature" id="selcasenature" class="form-control" onchange="return getCompField(this.value);" required>
                                        <option value="">--Select--</option>
                                        <?php $nsel="";
                                        foreach($case_nature as $cn){ 
                                            $nsel = ($cn_id_fk ==$cn->cn_id_pk )?'selected="selected"':'';
                                            ?>
                                        <option value="<?=$cn->cn_id_pk?>" <?=$nsel?>><?=$cn->cn_name?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                                <label for="firstName" class="col-lg-2 control-label"><label class="text-danger">*&nbsp;&nbsp;</label>Topic of Case</label>
                                <div class="col-lg-2">
                                    <select name="selcasetopic" id="selcasetopic" class="form-control" onchange="return getTopicIssue(this.value,$('#selcasenature').val(),<?=$prblm_id_fk?>);" required>
                                        <option value="">--Select--</option>
                                        <?php $csel ='';
                                        foreach($case_topic as $ct){ 
                                            $csel = ($ct_id_fk == $ct->ct_id_pk)?'selected="selected"':''?>
                                        <option value="<?=$ct->ct_id_pk?>" <?=$csel?>><?=$ct->ct_name?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                                <label for="firstName" class="col-lg-2 control-label"><label class="text-danger">*&nbsp;&nbsp;</label>Issue of Case</label>
                                <div class="col-lg-2">
                                    <select name="selcaseissue" id="sel_prblm_id" class="form-control" onchange="return getIssueRootCause(this.value);" required></select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="firstName" class="col-lg-2 control-label"><label class="text-danger">*&nbsp;&nbsp;</label>Internal / External</label>
                                <div class="col-lg-2">
                                    <select name="selintext" id="selintext" class="form-control" required>
                                         <option value="">--Select--</option>
                                          <option value="1" <?=($cit_id_fk=='1')?'selected="selected"':'';?>>Internal</option>
                                           <option value="2" <?=($cit_id_fk=='2')?'selected="selected"':'';?>>External</option>
                                    </select>
                                </div>
                                <label for="firstName" class="col-lg-2 control-label">Root Cause</label>
                                <div class="col-lg-2">
                                    <select name="selrootcause" id="selrootcause" class="form-control"></select>
                                </div>
                                <label for="firstName" class="col-lg-2 control-label">Owner of Root Cause</label>
                                <div class="col-lg-2">
                                    <select name="selown_rootcause" id="selown_rootcause" class="form-control">
                                        
                                        <option value="0">--Select--</option>
                                        <?php $osel='';
                                        foreach($owner_cause as $oc){ 
                                            $osel = ($orc_id_fk == $oc->orc_id_pk)?'selected="selected"':'';
                                            ?>
                                        <option value="<?=$oc->orc_id_pk?>" <?=$osel?>><?=$oc->orc_name?></option>
                                        <?php } ?>
                                    
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="firstName" class="col-lg-2 control-label">Name of Supplier</label>
                                <div class="col-lg-2">
                                     <select name="selsupplier" id="selsupplier" class="form-control">     
                                        <option value="0">--Select--</option>
                                        <?php 
                                        $consel = '';
                                        foreach($contractor as $con){ 
                                            $consel = ($con_id_fk == $con->con_id_pk)?'selected="selected"':'';
                                            ?>
                                        <option value="<?=$con->con_id_pk?>" <?=$consel?>><?=$con->con_name?></option>
                                        <?php } ?>
                                    
                                    </select>
                                    
                                </div>
                                <label for="firstName" class="col-lg-2 control-label"><label class="text-danger">*&nbsp;&nbsp;</label>Remarks</label>
                                <div class="col-lg-6">
                                    <textarea  class="form-control" name="cit_remarks" id="cit_remarks"  required cols="8" onkeypress="return inputLimiter(event, 'NameCharactersAndNumbers')" ><?=$cit_remarks ?></textarea>
                                </div>
                                
                            </div>

                        </div>
                    </div>
                    <div class="form-group col-lg-12">
                        <button type="button" class="btn btn-danger" id="btncaseassign" data-toggle="collapse" data-target="#caseassign" title="Click to view / assign cases">
                            <span class="fa fa-chain"></span> Case Assignment
                        </button>

                        <div  id="caseassign" class="collapse">
                            <div class="form-group">
                                <label for="firstName" class="col-lg-2 control-label"><label class="text-danger">*&nbsp;&nbsp;</label>Case Status</label>
                                <div class="col-lg-2">
                                    <select name="selstatus" id="selstatus" class="form-control" onchange="return DoActionOnStatus(this.value);" required>
                                         <option value="0">--Select--</option>
                                        <?php 
                                        $ssel = '';
                                        foreach($status_list as $sl){ 
                                           $ssel= ($status_id_fk == $sl->status_id_pk)?'selected="selected"':'';
                                            ?>
                                        <option value="<?=$sl->status_id_pk?>" <?=$ssel?>><?=$sl->status_name?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                                <label for="firstName" class="col-lg-2 control-label">Case Escalated To</label>
                                <div class="col-lg-2">
                                    <select class="form-control" name="txtcase_to" id="txtcase_to">
                                        <option value="">--Select--</option>
                                        <option value="Team Leader" <?=($cat_transfer_to=="Team Leader")?'selected="selected"':''?>>Team Leader</option>
                                        <option value="Team Manager" <?=($cat_transfer_to=="Team Manager")?'selected="selected"':''?>>Team Manager</option>
                                        <option value="COURTS CS Team" <?=($cat_transfer_to=="COURTS CS Team")?'selected="selected"':''?>>COURTS CS Team</option>
                                        <option value="Follow Up Team" <?=($cat_transfer_to=="Follow Up Team")?'selected="selected"':''?>>Follow Up Team</option>
                                    </select>
                                </div>
                                <label for="firstName" class="col-lg-2 control-label">Action Message</label>
                                <div class="col-lg-2">
                                    <input type="text" class="form-control" name="txtaction_msg" id="txtaction_msg" onkeypress="return inputLimiter(event, 'NameCharactersAndNumbers')" value="<?= $cat_action_msg ?>"/>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="firstName" class="col-lg-2 control-label">Action Due Date</label>
                                <div class="col-lg-2">
                                    <input type="text" class="form-control datepicker" name="txtaction_duedate" id="txtaction_duedate" onkeypress="return inputLimiter(event, 'NameCharactersAndNumbers')" value="<?= $cat_action_duedate ?>"/>
                                </div>
                                <label for="firstName" class="col-lg-2 control-label">Case Closure Date</label>
                                <div class="col-lg-2">
                                    <input type="text" class="form-control datepicker" name="txtclosuredate" id="txtclosuredate"   maxlength="30" onkeypress="return inputLimiter(event, 'Date')" value="<?= $cat_closuredate ?>"/>
                                </div>
                                <label for="firstName" class="col-lg-2 control-label">Case Closure Time</label>
                                <div class="col-lg-2">
                                    <input type="time" class="form-control" name="txtclosuretime" id="txtclosuretime"   onkeypress="return inputLimiter(event, 'NameCharactersAndNumbers')" value="<?=$cat_closuretime?>"/>
                                </div>
                            </div>
       
                        </div>
                    </div>
                    <div class="form-group col-lg-12">
                        <button type="button" class="btn btn-warning" id="btncompliment" data-toggle="collapse" data-target="#divcompliment" title="Click to view / assign cases">
                            <span class="fa fa-star"></span> Compliments
                        </button>

                        <div  id="divcompliment" class="collapse">
                            <div class="form-group">
                                <label for="firstName" class="col-lg-2 control-label">COURTS Staff Number</label>
                                <div class="col-lg-2">
                                    <input type="text" class="form-control" name="txtstaffnum" id="txtstaffnum"  maxlength="30" onkeypress="return inputLimiter(event, 'NameCharactersAndNumbers')" value="<?= $cct_staff_num ?>"/>
                                </div>
                                <label for="firstName" class="col-lg-2 control-label">COURTS Staff Name</label>
                                <div class="col-lg-2">
                                    <input type="text" class="form-control" name="txtstaffname" id="txtstaffname" autofocus   maxlength="30" onkeypress="return inputLimiter(event, 'NameCharactersAndNumbers')" value="<?= $cct_staff_name ?>"/>
                                </div>
                                <label for="firstName" class="col-lg-2 control-label">COURTS Staff Dept</label>
                                <div class="col-lg-2">
                                    <input type="text" class="form-control" name="txtstaffdept" id="txtstaffdept"  onkeypress="return inputLimiter(event, 'NameCharactersAndNumbers')" value="<?= $cct_staff_dept ?>"/>
                                </div>
                                
                            </div>
                            <div class="form-group">
                                <label for="firstName" class="col-lg-2 control-label">COURTS Staff Store</label>
                                <div class="col-lg-2">
                                    <input type="text" class="form-control" name="txtstaffstore" id="txtstaffstore"  onkeypress="return inputLimiter(event, 'NameCharactersAndNumbers')" value="<?= $cct_staff_store ?>"/>
                                </div>
                                <label for="firstName" class="col-lg-2 control-label">Compliment For</label>
                                <div class="col-lg-2">
                                    <select name="selcomp_for" id="selcomp_for" class="form-control">
                                        <option value="">--Select--</option>
                                          <option value="1" <?=($cct_for=='1')?'selected="selected"':''?>>Promoter</option>
                                           <option value="2" <?=($cct_for=='2')?'selected="selected"':''?>>Installer</option>
                                           <option value="3" <?=($cct_for=='3')?'selected="selected"':''?>>Delivery Guys</option>
                                           <option value="4" <?=($cct_for=='4')?'selected="selected"':''?>>Supplier</option>
                                    </select>
                                </div>
                                <label for="firstName" class="col-lg-2 control-label">Compliment Type</label>
                                <div class="col-lg-2">
                                    <select name="selcomp_type" id="selcomp_type" class="form-control">
                                        <option value="">--Select--</option>
                                        <option value="1">Service Recovery</option>
                                        <option value="2">Good Service</option>
                                    </select>
                                </div>
                                
                            </div>
                            <div class="form-group">
                                <label for="firstName" class="col-lg-2 control-label">Remarks From Customer</label>
                                <div class="col-lg-6">
                                    <textarea  class="form-control" name="txtfinal_remarks" id="txtfinal_remarks"  cols="8" onkeypress="return inputLimiter(event, 'NameCharactersAndNumbers')" ><?= $cct_remarks ?></textarea>
                                </div>
                               
                                
                            </div>
                            

                        </div>
                    </div>
                    <div class="form-group col-lg-12">
                        <button type="button" class="btn btn-primary" id="btnempower" data-toggle="collapse" data-target="#divempower" title="Click to view / update empowerment exercise">
                            <span class="fa fa-money"></span> Empowerment Exercised
                        </button>

                        <div  id="divempower" class="collapse">
                            <div class="form-group">
                                <label for="firstName" class="col-lg-2 control-label">Empowerment Exercised</label>
                                <div class="col-lg-3">
                                    <select name="txtemp_exer" id="txtemp_exer" class="form-control">
                                        <option value="">--Select--</option>
                                        <option value="1">Service Recovery</option>
                                        <option value="2">Goodwill Gesture</option>
                                    </select>
                                    
                                </div>
                                <label for="firstName" class="col-lg-2 control-label">Amount</label>
                                <div class="col-lg-3">
                                    <input type="text" class="form-control" name="txtemp_amount" id="txtemp_amount"  onkeypress="return inputLimiter(event, 'NameCharactersAndNumbers')" value="<?= $cet_amount ?>"/>
                                </div>

                            </div>


                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-lg-offset-3 col-lg-10">
                            <button type="submit" class="btn btn-md btn-success col-lg-4">Save</button><span class="col-sm-1">&nbsp;&nbsp;</span>
<!--                            <a href="<?= base_url(); ?>enquiry" class="btn btn-md btn-danger col-lg-4">Cancel</a>-->
                        </div>
                    </div>
                </form>
            </div>

        </div>
        <!-- /.row -->

</div>
<!-- /.container-fluid -->

</div>
<!-- /#page-wrapper -->

</div>
<script>
    $(document).ready(function () {
        $('#btncustinfo').on("click", function () {
            $("#demo").toggle("slow");

        });
        $('#btncaseinfo').on("click", function () {
            $("#caseinfo").toggle("slow");

        });
        $('#btncaseassign').on("click", function () {
            $("#caseassign").toggle("slow");

        });
        $('#btncompliment').on("click", function () {
            $("#divcompliment").toggle("slow");

        });
        $('#btnempower').on("click", function () {
            $("#divempower").toggle("slow");

        });

    });
    
   
    
    <?php if(!empty($id)){ ?>
        getTopicIssue(<?=$ct_id_fk?>,<?=$cn_id_fk?>,<?=$prblm_id_fk?>);
        getIssueRootCause(<?=$prblm_id_fk?>,<?=$rc_id_fk?>);
    <?php } ?>
</script>