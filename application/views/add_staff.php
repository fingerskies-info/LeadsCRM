<?php
if ($id !== '') {
    $title = "Update Staff";
    
    $staff_name = $staffdet[0]->staff_name;
    $staff_mobile = $staffdet[0]->staff_mobile;
    $staff_email = $staffdet[0]->staff_email;
    $staff_status = $staffdet[0]->staff_active;
    $staff_uname = $staffdet[0]->staff_uname;
    $staff_role = $staffdet[0]->staff_role;
    
} else {
    $title = "Add Staff";
    $id=$staff_role='';
   // $level = $desc = '';
}
?>
           <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Staffs
        <small>Management panel</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li>Staffs</li>
		        <li class="active"><?=$title?></li>

      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <!-- Small boxes (Stat box) -->
      <div class="row">

                    <div class="col-lg-12">
                        <h4><?=$title?></h4>
                        <form  name="myform" class="form-horizontal" role="form" action='<?=base_url();?>staff/save' method="post">
                             <input type="hidden" name="id" value="<?=$id?>" />
                              <?php if(isset($message)){?>
                                     <div class="col-sm-12"><div class="alert alert-success"><?=$message?></div></div>
                                <?php }else if(isset($error)) {?>
                                     <span class="col-sm-12"><div class="alert alert-danger"><?=$error?></div></span>
                                <?php } ?>
                            <p><label class="text-danger">Required fields are marked with *</label></p>
                            <div class="form-group">
                                      <label for="firstName" class="col-lg-3 control-label"><label class="text-danger">*&nbsp;&nbsp;</label>Name</label>
                                      <div class="col-lg-6">
                                          <input type="text" class="form-control" name="txtstaffname" id="txtstaffname" autofocus required maxlength="30" value="<?=$staff_name?>" onkeypress="return inputLimiter(event,'NameCharactersAndNumbers')"/>
				      </div>
				  </div>
                           
                             <div class="form-group">
                                      <label for="firstName" class="col-lg-3 control-label">Mobile</label>
                                      <div class="col-lg-6">
                                          <input type="text" class="form-control" name="txtstaffnumber" id="txtstaffmobile"    maxlength="15" value="<?=$staff_mobile?>" onkeypress="return inputLimiter(event,'MobileNumbers')"/>
				      </div>
				  </div>
				  <div class="form-group">
                                      <label for="firstName" class="col-lg-3 control-label">Email</label>
                                      <div class="col-lg-6">
                                          <input type="text" class="form-control" name="txtstaffemail" id="txtstaffemail"   maxlength="100" value="<?=$staff_email?>"/>
				      </div>
				  </div>
				  <div <?php if($id!=''){ ?> style="display:none" <?php } ?>>
				  <p class="bg-primary col-lg-12">Login Details</p>
				   <div class="form-group">
                                      <label for="firstName" class="col-lg-3 control-label"><label class="text-danger">*&nbsp;&nbsp;</label>Username</label>
                                      <div class="col-lg-6">
                                      <input type="text" class="form-control" name="txtstaffuname" id="txtstaffuname"   <?php if($id==''){ ?> required <?php } ?> maxlength="15"  value="<?=$staff_uname?>"/>
				      </div>
				  </div>
				   <div class="form-group">
                                      <label for="firstName" class="col-lg-3 control-label"><label class="text-danger">*&nbsp;&nbsp;</label>Password</label>
                                      <div class="col-lg-6">
                                          <input type="password" class="form-control" name="txtstaffpwd" id="txtstaffpwd"   <?php if($id==''){ ?> required <?php } ?> maxlength="15" />
				      </div>
				  </div>
				  <div class="form-group">
                                      <label for="firstName" class="col-lg-3 control-label"><label class="text-danger">*&nbsp;&nbsp;</label>Confirm Password</label>
                                      <div class="col-lg-6">
                                          <input type="password" class="form-control" name="txtstaffcpwd" id="txtstaffcpwd"   <?php if($id==''){ ?> required <?php } ?> maxlength="15" />
				      </div>
				  </div>
                                
                                     </div>
                            <div class="form-group">
                                <label for="firstName" class="col-lg-3 control-label">Roles</label>
                                      <div class="col-lg-6">
                                          <select name="selstaffrole" id="selstaffrole" class="form-control">
                                              <option value="1" <?php if($staff_role==1){ ?> selected="selected" <?php } ?>>Agent</option>
                                              <option value="2" <?php if($staff_role==2){ ?> selected="selected" <?php } ?>>Team Leader</option>
                                              <option value="3" <?php if($staff_role==3){ ?> selected="selected" <?php } ?>>Manager</option>
                                              <option value="4" <?php if($staff_role==4){ ?> selected="selected" <?php } ?>>Admin</option>
                                          </select>
                                          
				      </div>
                                </div>
			  <div class="form-group">
                                <label for="firstName" class="col-lg-3 control-label">Status</label>
                                      <div class="col-lg-6">
                                          <select name="selstaffstatus" id="selstaffstatus" class="form-control">
                                              <option value="1" <?php if($staff_status==1){ ?> selected="selected" <?php } ?>>Active</option>
                                              <option value="2"<?php if($staff_status==2){ ?> selected="selected" <?php } ?>>Inactive</option>
                                          </select>
                                          
				      </div>
                            </div>
							 <div class="form-group">
				    <div class="col-lg-offset-3 col-lg-10">
				      <button type="submit" class="btn btn-success">Save</button> <a href="<?= base_url();?>staff" class="btn btn-primary">Cancel</a>
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
    <!-- /#wrapper -->

    <!-- jQuery -->
    <script src="<?php echo base_url();?>js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="<?php echo base_url();?>js/bootstrap.min.js"></script>
 <script src="<?php echo base_url();?>js/general.js"></script>
</body>

</html>
