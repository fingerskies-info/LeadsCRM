<?php
$session = $this->session->userdata('user_id'); ?>      
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Issues
        <small>Management panel</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Issues</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <!-- Small boxes (Stat box) -->
      <div class="row">
          
                    <div class="col-lg-12">
                        <!-- <h2>Customers</h2> -->
                        <div class="col-lg-6">
                    <form method="post" action="<?= base_url() . 'master/prblm_showrows' ?>">
                        <input type="text" class="" name="txtrows" id="txtrows" placeholder="Rows" onkeypress="return inputLimiter(event, 'Numbers');" maxlength="4" value="<?=$rows?>"/> 
                        <input type="submit" class="btn btn-danger" value="Show" /> 
                    </form>
                            
                </div>
                <div class="table-responsive col-lg-12">
                    <div style="float: right"><div class="col-lg-12">


                            <a href="<?php echo site_url(); ?>master/prblm_add" class="btn btn-success fa fa-plus-circle"> Add New</a> 
                            <!--<a href="<?= base_url(); ?>index.php/enquiry/export" class="btn btn-warning fa fa-file-excel-o" > Excel</a> <a href="<?= base_url(); ?>index.php/enquiry/exportPDF" class="btn btn-info fa fa-file-pdf-o" target="_blank"> PDF</a>-->
                            <br/>


                        </div></div>
                          <?php if(isset($message)){?>
                                     <div class="col-sm-12"><div class="alert alert-success"><?=$message?></div></div>
                                <?php }else if(isset($error)) {?>
                                     <div class="col-sm-12"><div class="alert alert-danger"><?=$error?></div></div>
                                <?php } ?>
                                
                            <table class="table table-bordered table-hover table-striped">
                                <thead>
                                    <tr>
                                        
                                        <th width="20%">Topic Name</th>
                                        <th width="80%">
                                            <table width="100%">
                                                <tr>
                                                    <td>&nbsp;</td>
                                                    <td width="60%">Issue Name</td>
                                                    <td width="10%">Added Date</td>
                                                     <?php if($session['role'] == '1') { ?>
                                                    <td width="20%">Added By</td>
                                                    <?php } ?>
                                                    <td width="10%">Actions</td>
                                                </tr>
                                            </table>
                                        </th>
						
                                     
                                    </tr>
                                </thead>
                                <tbody>
                                     <?php 
                                     
                                     if(count($CASE_TOPIC)!=0) {
                                         $CI =& get_instance();
                                         //$CI->load->model('Prblm_Model');
                                                                $i=1;
                                                                foreach($CASE_TOPIC as $cmp){
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
                                            $CASE_ISSUE = $CI->Prblm_Model->getIssueList(' where ct_id_fk = '.$cmp->ct_id_pk);
                                            //var_dump($CASE_ISSUE);
						?>					
                                    <tr class="<?=$class?>">
                                        
                                        <td><b><?=$cmp->ct_name?></b></td>
                                        <td><table class="table table-bordered table-hover table-striped">
                                                <?php 
                                                $j=1;
                                                foreach($CASE_ISSUE as $ci){
                                                    if($j%2==0){
                                                                        $class='info';
                                                                     }else{
                                                                        $class='active';
                                                                     }
                                                                     $font_color = '';
                                                                     if($ci->is_complaint=='1'){
                                                                         $font_color = 'style="color:red"';
                                                                     }
                                                    ?>
                                                <tr class="<?=$class?>">
                                                    <td><?=$j?></td>
                                                    <td width="60%" <?=$font_color?>><?=$ci->prblm_name?></td>
                                                    <td width="10%"><?=date('d-m-Y H:i A',strtotime($ci->prblm_date))?></td>
                                                    <?php if($session['role'] == '1') { ?>
                                                    <td width="20%"><?=$ci->staff_name?></td>
                                                    <?php } ?>
                                                    <td width="10%"><img src="<?php echo base_url();?>images/edit.jpg" title="Update Issue" onclick="window.location.href='<?= base_url();?>master/prblm_add/<?=$ci->prblm_id_pk?>'"/>&nbsp;
                                                        <img src="<?php echo base_url();?>images/delete.gif" onclick="return confirmDelete('Are you sure to delete issue?','<?php echo base_url();?>master/prblm_delete/<?=$ci->prblm_id_pk?>');" title="Delete Issue"/> </td>
                                                    
                                                </tr>
                                                <?php $j++; } ?>
                                            </table></td>
                                    </tr>
                                            <?php $i++;}}else{ ?>
                                                        <tr class="warning">
                                                            <td colspan="2" align="center">No Issue Available</td>
                                                        </tr>
                                               <?php } ?>
                                                       
                                </tbody>
                            </table>
                                     
                     <?php 
  if(count($CASE_TOPIC)!=0) {  ?>  
 <div align="right">
    <ul class="pagination">
   <?=$links;?>
    </ul>
</div>
                            <?php } ?>
                                     <div class="alert-warning text-black" align="left"><b>Note:</b> Issues shown in red color should be tagged as a <b>"Complain Case"</b></div>
                        </div>
                        <br/>
                        
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