<?php
if ($id !== '') {
    $title = "Update Enquiry";
    
    $person_name = $enquirydet[0]->cust_name;
    $email = $enquirydet[0]->cust_email;
    $mobile = $enquirydet[0]->cust_mobile;
    $home_tel = $enquirydet[0]->cust_hometel;
    $off_tel = $enquirydet[0]->cust_offtel;
    $address = $enquirydet[0]->cust_address;
    $postal_code = $enquirydet[0]->cust_postalcode;
    $company_name = $enquirydet[0]->cust_company; 
	$designation = $enquirydet[0]->cust_designation;
	$enquiry_msg = $enquirydet[0]->enquiry_msg;
	
} else {
    $title = "Add Enquiry";
    $id='';
   // $level = $desc = '';
}
?>
           <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Enquiries
        <small>Management panel</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li>Enquiries</li>
		        <li class="active"><?=$title?></li>

      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <!-- Small boxes (Stat box) -->
      <div class="row">
                    <div class="col-lg-12">
                        <h4><?=$title?></h4>
                        <form  name="myform" class="form-horizontal" role="form" action='<?php echo base_url(); ?>enquiry/save' method="post">
                            <input type="hidden" name="id" value="<?=$id?>" />
                              <?php if(isset($message)){?>
                                     <div class="col-sm-12"><div class="alert alert-success"><?=$message?></div></div>
                                <?php }else if(isset($error)) {?>
                                     <span class="col-sm-12"><div class="alert alert-danger"><?=$error?></div></span>
                                <?php } ?>
                            <p><label class="text-danger">Required fields are marked with *</label></p>
							<div class="form-group">
                                      <label for="firstName" class="col-lg-3 control-label"><label class="text-danger">*&nbsp;&nbsp;</label>Enquiry Type</label>
                                      <div class="col-lg-6">
                                          <select name="sel_equiry_type" required class="form-control">
										  <?php foreach($EnquiryTypes as $type) { ?>
										  <option value="<?=$type->enquiry_type_id_pk?>"><?=$type->type_name?></option>
										  <?php } ?>
										  </select>
				      </div>
				  </div>
                            <div class="form-group">
                                      <label for="firstName" class="col-lg-3 control-label"><label class="text-danger">*&nbsp;&nbsp;</label>Name</label>
                                      <div class="col-lg-6">
                                          <input type="text" class="form-control" name="txtcustname" id="txtcustname" autofocus  required maxlength="30" onkeypress="return inputLimiter(event,'NameCharactersAndNumbers')" value="<?=$person_name?>"/>
				      </div>
				  </div>
                          <div class="form-group">
                                      <label for="firstName" class="col-lg-2 control-label"><label class="text-danger">*&nbsp;&nbsp;</label>Email</label>
                                      <div class="col-lg-4">
                                          <input type="text" class="form-control" name="txtcustemail" id="txtcustemail"   required maxlength="50" value="<?=$email?>"/>
				      </div>
				  
                                      <label for="firstName" class="col-lg-2 control-label"><label class="text-danger">*&nbsp;&nbsp;</label>Mobile</label>
                                      <div class="col-lg-4">
                                          <input type="text" class="form-control" name="txtcustmobile" id="txtcustmobile"   required maxlength="15" onkeypress="return inputLimiter(event,'MobileNumbers')" value="<?=$mobile?>"/>
				      </div>
				  </div>
                            <div class="form-group">
                                      <label for="firstName" class="col-lg-2 control-label">Home Telephone</label>
                                      <div class="col-lg-4">
                                          <input type="text" class="form-control" name="txtcusthome" id="txtcusthome"    maxlength="15" onkeypress="return inputLimiter(event,'MobileNumbers')" value="<?=$home_tel?>"/>
				     
				  </div>
                                      <label for="firstName" class="col-lg-2 control-label">Office Telephone</label>
                                      <div class="col-lg-4">
                                          <input type="text" class="form-control" name="txtcustoffice" id="txtcustoffice"  maxlength="15" onkeypress="return inputLimiter(event,'MobileNumbers')" value="<?=$off_tel?>"/>
				      </div>
				  </div> 
                            
                            
                            <div class="form-group">
                                      <label for="firstName" class="col-lg-2 control-label">Address</label>
                                      <div class="col-lg-4">
                                          <textarea rows="3" cols="10" class="form-control" name="txtcustaddr" id="txtcustaddr"><?=$address?></textarea>
                                          
				      </div>
				  
                                      <label for="firstName" class="col-lg-2 control-label">Postal Code</label>
                                      <div class="col-lg-4">
                                          <input type="text" class="form-control" name="txtcustpostal" id="txtcustpostal" maxlength="10" value="<?=$postal_code?>"/>
				      </div>
				  </div>

				   <div class="form-group">
                                      <label for="firstName" class="col-lg-2 control-label">Company Name</label>
                                      <div class="col-lg-4">
                                          <input type="text" class="form-control" name="txtcustcomp" id="txtcustcomp"  maxlength="150" onkeypress="return inputLimiter(event,'NameCharactersAndNumbers')" value="<?=$company_name?>"/>
				      </div>
				  
                                      <label for="firstName" class="col-lg-2 control-label">Designation</label>
                                      <div class="col-lg-4">
                                          <input type="text" class="form-control" name="txtcustdesignation" id="txtcustdesignation"  maxlength="50" value="<?=$designation?>"/>
				      </div>
				  </div>
                             <div class="form-group">
                                      <label for="firstName" class="col-lg-3 control-label"><label class="text-danger">*&nbsp;&nbsp;</label>Enquiry</label>
                                      <div class="col-lg-6">
                                           <textarea rows="6" cols="10" class="form-control" name="txtcustenquiry" id="txtcustenquiry"><?=$enquiry_msg?></textarea>
				      </div>
				  </div>
                             <div class="form-group">
				    <div class="col-lg-offset-3 col-lg-10">
				      <button type="submit" class="btn btn-success">Save</button> <a href="<?= base_url();?>enquiry" class="btn btn-primary">Cancel</a>
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
