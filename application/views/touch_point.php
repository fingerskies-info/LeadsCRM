<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Touch Point
        <small>Management panel</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Touch Point</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <!-- Small boxes (Stat box) -->
      <div class="row">
                    <div class="col-lg-12">
                        <!-- <h2>Customers</h2> -->
                        <!--<div class="col-lg-6">
                    <form method="post" action="<?= base_url() . 'master/tp_showrows' ?>">
                        <input type="text" class="" name="txtrows" id="txtrows" placeholder="Rows" onkeypress="return inputLimiter(event, 'Numbers');" maxlength="4" value="<?=$rows?>"/> 
                        <input type="submit" class="btn btn-danger" value="Show" /> 
                    </form>
                </div>-->
                <div class="table-responsive col-lg-12">
                    <div style="float: right"><div class="col-lg-12">


                            <a href="<?php echo site_url(); ?>master/tp_add" class="btn btn-success fa fa-plus-circle"> Add New</a> 
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
                                     <?php if(is_array($TOUCH_POINT) && count($TOUCH_POINT) ) {
                                                                $i=1;
                                                                foreach($TOUCH_POINT as $cmp){
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
                                        <td><?=$cmp->tp_name?></td>
                                         
                                         <td><img src="<?php echo base_url();?>images/edit.jpg" title="Update Touch Point" onclick="window.location.href='<?= base_url();?>index.php/master/tp_add/<?=$cmp->tp_id_pk?>'"/>&nbsp;<img src="<?php echo base_url();?>images/delete.gif" onclick="return confirmDelete('Are you sure to delete touch point?','<?php echo base_url();?>index.php/master/tp_delete/<?=$cmp->tp_id_pk?>');" title="Delete Touch Point"/> </td>
                                    </tr>
                                                                <?php $i++;}}else{ ?>
                                                        <tr class="warning">
                                                            <td colspan="100%" align="center">No Touch Point Available</td>
                                                        </tr>
                                                         <?php } ?>
                                </tbody>
                            </table>
                     <?php 
  if($TOUCH_POINT!=false) {  ?>  
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
