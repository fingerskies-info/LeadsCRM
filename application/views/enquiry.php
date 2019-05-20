<?php
$session = $this->session->userdata('user_id'); ?>      
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Call Logs
        <small>Management panel</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Call Logs</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <!-- Small boxes (Stat box) -->
      <div class="row">
                    <div class="col-lg-12">
                        <!-- <h2>Customers</h2> -->
                        <div class="col-lg-6">
                    <form method="post" action="<?= base_url() . 'master/enquiry_showrows' ?>">
                        <input type="text" class="" name="txtrows" id="txtrows" placeholder="Rows" onkeypress="return inputLimiter(event, 'Numbers');" maxlength="4" value="<?=$rows?>"/> 
                        <input type="submit" class="btn btn-danger" value="Show" /> 
                    </form>
                </div>
                <div class="table-responsive col-lg-12">
                    <div style="float: right">
                        <div class="col-lg-12">


                            <a href="<?php echo site_url(); ?>master/enquiry_add" class="btn btn-success fa fa-plus-circle"> Add New</a> 
                          <!-- <a href="<?= base_url(); ?>master/enquiry_export" class="btn btn-warning fa fa-file-excel-o" > Excel</a> 
                            <a href="<?= base_url(); ?>index.php/enquiry/exportPDF" class="btn btn-info fa fa-file-pdf-o" target="_blank"> PDF</a>-->
                            <br/>
<br/>

                        </div>
                    </div>
                    <form method="post" action="<?= base_url() . 'master/enquiry_search' ?>">
                    <div class="col-lg-12">
                        <div class="form-group">
                                <label for="firstName" class="col-lg-1 control-label">Case ID (#)</label>
                                <div class="col-lg-2">
                                    <input type="text" class="form-control" name="srchcustid" onkeypress="return inputLimiter(event, 'NameCharactersAndNumbers')" value="<?= $srchcustid ?>"/>
                                </div>
                                <label for="firstName" class="col-lg-1 control-label">Account No.</label>
                                <div class="col-lg-2">
                                    <input type="text" class="form-control" name="srchcustacc" onkeypress="return inputLimiter(event, 'NameCharactersAndNumbers')" value="<?= $srchcustacc ?>"/>
                                </div>
                                <label for="firstName" class="col-lg-1 control-label">NRIC</label>
                                <div class="col-lg-2">
                                    <input type="text" class="form-control" name="srchcustnric" onkeypress="return inputLimiter(event, 'NameCharactersAndNumbers')" value="<?= $srchcustnric ?>"/>
                                </div>
                                 <label for="firstName" class="col-lg-1 control-label">Mobile</label>
                                <div class="col-lg-2">
                                    <input type="text" class="form-control" name="srchcustmobile" onkeypress="return inputLimiter(event, 'NameCharactersAndNumbers')" value="<?= $srchcustmobile ?>"/>
                                </div>
                                 
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="form-group">
                            <label for="firstName" class="col-lg-1 control-label">Topic</label>
                                <div class="col-lg-2">
                                     <select name="srchtopic" id="srchtopic" class="form-control" >
                                        <option value="0">--Select--</option>
                                        <?php $csel ='';
                                        foreach($case_topic as $ct){ 
                                            $csel = ($srchtopic == $ct->ct_id_pk)?'selected="selected"':''?>
                                        <option value="<?=$ct->ct_id_pk?>" <?=$csel?>><?=$ct->ct_name?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                                  <label for="firstName" class="col-lg-1 control-label">Nature</label>
                                <div class="col-lg-2">
                                    <select name="srchnature" id="srchnature" class="form-control">
                                        <option value="0">--Select--</option>
                                        <?php $nsel="";
                                        foreach($case_nature as $cn){ 
                                            $nsel = ($srchnature ==$cn->cn_id_pk )?'selected="selected"':'';
                                            ?>
                                        <option value="<?=$cn->cn_id_pk?>" <?=$nsel?>><?=$cn->cn_name?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                                   <label for="firstName" class="col-lg-1 control-label">Product</label>
                                <div class="col-lg-2">
                                    <select name="srchproduct" id="srchproduct" class="form-control">
                                        <option value="0">--Select--</option>
                                        <?php $psel = '';
                                        foreach($product_cat as $pc){ 
                                            $psel = ($srchproduct==$pc->prdc_cat_id_pk)?'selected="selected"':''; ?>
                                        <option value="<?=$pc->prdc_cat_id_pk?>" <?=$psel?>><?=$pc->prdc_cat_name?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                                   <label for="firstName" class="col-lg-1 control-label">Status</label>
                                <div class="col-lg-2">
                                     <select name="srchstatus" id="srchstatus" class="form-control">
                                         <option value="0">--Select--</option>
                                        <?php 
                                        $ssel = '';
                                        foreach($status_list as $sl){ 
                                         $ssel = ($srchstatus==$sl->status_id_pk)?'selected="selected"':'';   
                                               ?>
                                        <option value="<?=$sl->status_id_pk?>" <?=$ssel?>><?=$sl->status_name?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                        </div>
                    </div>
                   
                 <div class="col-lg-12">
                    <br/>
                     <div class="form-group">
                         <label for="firstName" class="col-lg-1 control-label">From Date</label>
                                <div class="col-lg-2">
                                    <input type="text" class="form-control datepicker" name="srchfrmdate"  onkeypress="return inputLimiter(event, 'NameCharactersAndNumbers')" value="<?= $srchfrmdate ?>"/>
                                </div>
                         <label for="firstName" class="col-lg-1 control-label">To Date</label>
                                <div class="col-lg-2">
                                    <input type="text" class="form-control datepicker" name="srchtodate"  onkeypress="return inputLimiter(event, 'NameCharactersAndNumbers')" value="<?= $srchtodate ?>"/>
                                </div>
                         <div class="col-lg-6">
                            <button type="submit" class="btn btn-md btn-success col-lg-3">Search</button>
                            <a href="<?= base_url(); ?>master/enquiry_reset" class="btn btn-md btn-danger col-lg-3">Reset</a>
                            <a href="<?= base_url(); ?>master/enquiry_export" class="btn btn-md btn-info col-lg-3"><i class="fa fa-external-link"> Export</i></a>
                        </div>
                     </div>
                 </div></form>
                          <?php if(isset($message)){?>
                                     <div class="col-sm-12"><div class="alert alert-success"><?=$message?></div></div>
                                <?php }else if(isset($error)) {?>
                                     <span class="col-sm-12"><div class="alert alert-danger"><?=$error?></div></span>
                                <?php } ?>
                                
                            <table class="table table-bordered table-hover table-striped">
                                <thead>
                                    <tr><td colspan="11">
                                            <table width="100%">
                                                <tr>
                                                    <td align="right">Total Open Cases :</td><td>&nbsp;&nbsp;&nbsp;&nbsp;<?=$total_open?></td></tr>
                                                <tr>
                                                    <td align="right">Total Assigned Cases :</td><td>&nbsp;&nbsp;&nbsp;&nbsp;</td></tr>
                                                <tr>
                                                    <td align="right">Total Closed Cases :</td><td>&nbsp;&nbsp;&nbsp;&nbsp;</td></tr>
                                                <tr>
                                                    <td align="right">Total Cases :</td><td>&nbsp;&nbsp;&nbsp;&nbsp;<?=$enquirycnt?></td></tr>
                                                
                                            </table>
                                        </td>
                                    </tr>
                                    <tr>
                                        
                                        <th width="10%">Case&nbsp;ID(#)</th>
                                        <th width="20%">Customer&nbsp;Name</th>
                                        <th width="10%">Account&nbsp;No.</th>
                                        <th width="20%">Topic</th>
                                        <th width="20%">Nature</th>
                                        <th width="20%">Product</th>
                                        <th width="20%">Issue</th>
                                        <th width="10%">Date</th>
                                        <th width="5%">Status</th>
                                        <?php if($session['role'] == '1') { ?>
                                            <th>Agent</th>
					<?php } ?>
                                         <th width="5%">&nbsp;</th>
                                    </tr>
                                </thead>
                                <tbody>
                                     <?php if(is_array($ENQUIRY) && count($ENQUIRY) ) {
                                            $i=1;
                                            foreach($ENQUIRY as $cmp){
                                               if($i%2==0){
                                                  $class='info';
                                               }else{
                                                  $class='active';
                                               }
                                               if ($pageNum > 1) {
                                                  $sr = ($rows * ($pageNum - 1) + ($i));
                                               } else {
                                                  $sr= $i;
                                               }
                                               $topic = $this->Common_Model->select_table('case_topic_mst',' ct_id_pk='.$cmp->ct_id_fk);
                                               $nature = $this->Common_Model->select_table('case_nature_mst',' cn_id_pk='.$cmp->cn_id_fk);
                                               $prodc = $this->Common_Model->select_table('prdc_cat_mst',' prdc_cat_id_pk='.$cmp->prdc_cat_id_fk);
                                               $issue = $this->Common_Model->select_table('prblm_mst',' prblm_id_pk='.$cmp->prblm_id_fk);
                                               $sales_channel = $this->Common_Model->select_table('sales_channel_mst',' schannel_id_pk='.$cmp->schannel_id_fk);
                                              
                                    ?>
                                    <tr class="<?=$class?>">
                                        <td><?='<a href="'.base_url().'master/enquiry_add/'.$cmp->case_id_pk.'" title="Click to update / view details"><b>#'.$cmp->case_number.'</b></a><br/>('.ucwords($sales_channel[0]->scn_name).')'?></td>
                                        <td><?=$cmp->ccit_cust_name.'<br/>( <i class="fa fa-phone"></i> '.$cmp->ccit_mobile.')<br/>( <i class="fa fa-qrcode"></i> '.$cmp->ccit_custnric.')'?></td>
					<td><?=$cmp->ccit_cust_account?></td>
                                        <td><?=$topic[0]->ct_name?></td>
                                        <td><?=$nature[0]->cn_name?></td> 
                                        <td><?=$prodc[0]->prdc_cat_name?></td> 
                                        <td><?=$issue[0]->prblm_name?></td> 
					<td><?=date('d-m-Y',strtotime($cmp->case_created_date))?></td>
                                        <td><?=$cmp->status_name?></td>
					<?php if($session['role'] == '1') { ?>
					<td><?=$cmp->staff_name?></td>
					<?php } ?>
                                        <td><img src="<?php echo base_url();?>images/delete.gif" onclick="return confirmDelete('Are you sure to delete case log?','<?php echo base_url();?>master/enquiry_delete/<?=$cmp->case_id_pk?>');" title="Delete Case Log"/> </td>
                                    </tr>
                                      <?php $i++;}}else{ ?>
                                    <tr class="warning">
                                        <td colspan="100%" align="center">No Call Logs Available</td>
                                    </tr>
                                      <?php } ?>
                                </tbody>
                            </table>
                     <?php 
  if($ENQUIRY!=false) {  ?>  
 <div align="right">
    <ul class="pagination">
   <?=$links;?>
    </ul>
</div>
                            <?php } ?>
                        </div>
                    </div>
                    
                </div>
                <!-- /.row -->

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

    <!-- jQuery -->
    <script src="<?php echo base_url();?>js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="<?php echo base_url();?>js/bootstrap.min.js"></script>
 <script src="<?php echo base_url();?>js/general.js"></script>