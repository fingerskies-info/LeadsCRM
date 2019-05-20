<?php
$session = $this->session->userdata('user_id'); ?>      
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
       Owner of Root Cause
        <small>Management panel</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Owner of Root Cause</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <!-- Small boxes (Stat box) -->
      <div class="row">
          
                    <div class="col-lg-12">
                        <!-- <h2>Customers</h2> -->
                        <div class="col-lg-6">
                    <form method="post" action="<?= base_url() . 'master/orc_showrows' ?>">
                        <input type="text" class="" name="txtrows" id="txtrows" placeholder="Rows" onkeypress="return inputLimiter(event, 'Numbers');" maxlength="4" value="<?=$rows?>"/> 
                        <input type="submit" class="btn btn-danger" value="Show" /> 
                    </form>
                            
                </div>
                <div class="table-responsive col-lg-12">
                    <div style="float: right"><div class="col-lg-12">


                            <a href="<?php echo site_url(); ?>master/orc_add" class="btn btn-success fa fa-plus-circle"> Add New</a> 
                            <!--<a href="<?= base_url(); ?>enquiry/export" class="btn btn-warning fa fa-file-excel-o" > Excel</a> <a href="<?= base_url(); ?>index.php/enquiry/exportPDF" class="btn btn-info fa fa-file-pdf-o" target="_blank"> PDF</a>-->
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
                                        <th>Category</th>
                                        <th>Owner&nbsp;of&nbsp;Root&nbsp;Cause</th>
                                        <th width="20%">Added&nbsp;Date</th>
                                        <th width="15%">Actions</th>
                                    </tr>
                               </thead>
                                <tbody>
                                     <?php 
                                     
                                     if(count($OWNER_TOPIC)!=0) {
                                         $CI =& get_instance();
                                        
                                                                $i=1;
                                                                foreach($OWNER_TOPIC as $cmp){
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
                                            
                                            $category = array('1'=>'DD','2'=>'Branch','3'=>'LC','4'=>'Support Center','5'=>'Customer','6'=>'CS','7'=>'Ecourts','8'=>'Webstore','9'=>'EW','10'=>'QC','11'=>'Pending');
						?>					
                                    <tr class="<?=$class?>">
                                        
                                        <td><b><?=$category[$cmp->cat_id_fk]?></b></td>
                                        <td><?=$cmp->orc_name?></td>
                                                                <td width="20%"><?=date('d-m-Y H:i A',strtotime($cmp->orc_date))?></td>
                                                                
                                                                <td width="15%"><img src="<?php echo base_url();?>images/edit.jpg" title="Update Owner of Root Cause" onclick="window.location.href='<?= base_url();?>index.php/master/orc_add/<?=$cmp->orc_id_pk?>'"/>&nbsp;
                                                                    <img src="<?php echo base_url();?>images/delete.gif" onclick="return confirmDelete('Are you sure to delete owner of root cause?','<?php echo base_url();?>index.php/master/orc_delete/<?=$cmp->orc_id_pk?>');" title="Delete Owner of Root Cause"/> 
                                                                </td>
                                        
                                    </tr>
                                            <?php $i++;}}else{ ?>
                                                        <tr class="warning">
                                                            <td colspan="4" align="center">No Owner of Root Cause Available</td>
                                                        </tr>
                                               <?php } ?>
                                                       
                                </tbody>
                            </table>
                                     
                     <?php 
  if(count($OWNER_TOPIC)!=0) {  ?>  
 <div align="right">
    <ul class="pagination">
   <?=$links;?>
    </ul>
</div>
                            <?php } ?>
                                     
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