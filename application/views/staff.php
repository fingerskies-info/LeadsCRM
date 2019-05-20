
       <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Staffs
        <small>Management panel</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Staffs</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <!-- Small boxes (Stat box) -->
      <div class="row">
                    <div class="col-lg-12">
                        
                        <div class="col-lg-6">
                    <form method="post" action="<?= base_url() . 'staff/showRows' ?>">
                        <input type="text" class="" name="txtrows" id="txtrows" placeholder="Rows" onkeypress="return inputLimiter(event, 'Numbers');" maxlength="4" value="<?=$rows?>" /> 
                        <input type="submit" class="btn btn-danger" value="Show" /> 
                    </form>
                </div>
                <div class="table-responsive col-lg-12">
                    <div style="float: right"><div class="col-lg-12">


                            <a href="<?php echo site_url(); ?>staff/add" class="btn btn-success  fa fa-plus-circle"> Add New</a> 
                            <!--<a href="<?= base_url(); ?>index.php/staff/export" class="btn btn-warning fa fa-file-excel-o" > Excel</a> <a href="<?= base_url(); ?>index.php/staff/exportPDF" class="btn btn-info fa fa-file-pdf-o" target="_blank"> PDF</a>-->
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
                                        
                                        <th>Name</th>
										<th>Username</th>
                                        <th>Mobile</th>
										<th>Email</th>
                                         <th>Status</th>
                                         <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if(is_array($STAFF) && count($STAFF) ) {
                                                                $i=1;
                                                                foreach($STAFF as $staff){
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
											if($staff->staff_id_pk!=1){
                                                            ?>
                                    <tr class="<?=$class?>">
                                    
                                         <td><?=$staff->staff_name?></td>
										 <td><?=$staff->staff_uname?></td>
                                        <td><?=$staff->staff_mobile?></td>
										<td><?=$staff->staff_email?></td>
                                        <td><?=($staff->staff_active=='1'?'Active':'Inactive')?></td>
                                         <td><img src="<?php echo base_url();?>images/edit.jpg" title="Update Staff" onclick="window.location.href='<?= base_url();?>index.php/staff/add/<?=$staff->staff_id_pk?>'"/>&nbsp;<img src="<?php echo base_url();?>images/delete.gif" onclick="return confirmDelete('Are you sure to delete staff?','<?php echo base_url();?>index.php/staff/delete/<?=$staff->staff_id_pk?>');" title="Delete Staff"/> </td>
                                    </tr>
                                    <?php $i++; } }}else{ ?>
                                                        <tr class="warning">
                                                            <td colspan="100%" align="center">No Staff Available</td>
                                                        </tr>
                                                         <?php } ?>
                                </tbody>
                            </table>
                                     <?php 
  if($STAFF!=false) {  ?>  
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
