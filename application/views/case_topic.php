<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Case Topic
        <small>Management panel</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active"> Case Topic</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <!-- Small boxes (Stat box) -->
      <div class="row">
                    <div class="col-lg-12">
                        <!-- <h2>Customers</h2> -->
                        <!--<div class="col-lg-6">
                    <form method="post" action="<?= base_url() . 'master/ct_showrows' ?>">
                        <input type="text" class="" name="txtrows" id="txtrows" placeholder="Rows" onkeypress="return inputLimiter(event, 'Numbers');" maxlength="4" value="<?=$rows?>"/> 
                        <input type="submit" class="btn btn-danger" value="Show" /> 
                    </form>
                </div>-->
                <div class="table-responsive col-lg-12">
                    <div style="float: right"><div class="col-lg-12">


                            <a href="<?php echo site_url(); ?>master/ct_add" class="btn btn-success fa fa-plus-circle"> Add New</a> 
							<!--<a href="<?= base_url(); ?>enquiry/export_type" class="btn btn-warning fa fa-file-excel-o" > Excel</a> <a href="<?= base_url(); ?>enquiry/exportPDF_type" class="btn btn-info fa fa-file-pdf-o" target="_blank"> PDF</a>-->
							<br/>


                        </div></div>
                          <?php if(isset($message)){?>
                                     <div class="col-sm-12"><div class="alert alert-success"><?=$message?></div></div>
                                <?php }else if(isset($error)) {?>
                                     <span class="col-sm-12"><div class="alert alert-danger"><?=$error?></div></span>
                                <?php } ?>
                                
                            <table class="table table-bordered table-hover table-striped">
                                <thead>
                                    <tr>
                                        
                                        <th width="70%">Name</th>
                                        
                                         <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                     <?php if(is_array($CASE_TOPIC) && count($CASE_TOPIC) ) {
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
											
                                                            ?>
                                    <tr class="<?=$class?>">
                                        <td><?=$cmp->ct_name?></td>
                                         
                                         <td><img src="<?php echo base_url();?>images/edit.jpg" title="Update case topic" onclick="window.location.href='<?= base_url();?>master/ct_add/<?=$cmp->ct_id_pk?>'"/>&nbsp;<img src="<?php echo base_url();?>images/delete.gif" onclick="return confirmDelete('Are you sure to delete case topic?','<?php echo base_url();?>master/ct_delete/<?=$cmp->ct_id_pk?>');" title="Delete case topic"/> </td>
                                    </tr>
                                                                <?php $i++;}}else{ ?>
                                                        <tr class="warning">
                                                            <td colspan="100%" align="center">No Case Topic Available</td>
                                                        </tr>
                                                         <?php } ?>
                                </tbody>
                            </table>
                     <?php 
  if($CASE_TOPIC!=false) {  ?>  
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
