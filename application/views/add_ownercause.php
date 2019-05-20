<?php
if ($id !== '') {
    $title = "Update Owner of Root Cause";
    
    $orc_name = $root_causedet[0]->orc_name;
    $orc_cat_id = $root_causedet[0]->cat_id_fk;
    
	
} else {
    $title = "Add Owner of Root Cause";
    $id=$orc_cat_id='';
   
}
?>
           <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Owner of Root Cause
        <small>Management panel</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li>Owner of Root Cause</li>
		        <li class="active"><?=$title?></li>

      </ol>
    </section>
 
    <!-- Main content -->
    <section class="content">
      <!-- Small boxes (Stat box) -->
      <div class="row">
                    <div class="col-lg-12">
                        <h4><?=$title?></h4>
                        <form  name="myform" class="form-horizontal" role="form" action='<?php echo base_url(); ?>master/orc_save' method="post">
                            <input type="hidden" name="id" value="<?=$id?>" />
                              <?php if(isset($message)){?>
                                     <div class="col-sm-12"><div class="alert alert-success"><?=$message?></div></div>
                                <?php }else if(isset($error)) {?>
                                     <div class="col-sm-12"><div class="alert alert-danger"><?=$error?></div></div>
                                <?php } ?>
                            <p><label class="text-danger">Required fields are marked with *</label></p>
					
                            <div class="form-group">
                                <span class="tooltip"><i class="fa fa-2x fa-info-circle"></i>
                                        <span class="tooltiptext">Choose department or origin of the cause</span>
                                      </span><label for="firstName" class="col-lg-3 control-label"><label class="text-danger">*&nbsp;&nbsp;</label>Category</label>
                                      <div class="col-lg-6">
                                          <select name="sel_cat_id" required class="form-control" id="sel_cat_id" style="float: left">
                                              <option value="">--Select Category--</option>
                                              <option value="1" <?=($orc_cat_id==1)?'selected':''?>>DD</option>
                                              <option value="2" <?=($orc_cat_id==2)?'selected':''?>>Branch</option>
                                              <option value="3" <?=($orc_cat_id==3)?'selected':''?>>LC</option>
                                              <option value="4" <?=($orc_cat_id==4)?'selected':''?>>Support Center</option>
                                              <option value="5" <?=($orc_cat_id==5)?'selected':''?>>Customer</option>
                                              <option value="6" <?=($orc_cat_id==6)?'selected':''?>>CS</option>
                                              <option value="7" <?=($orc_cat_id==7)?'selected':''?>>Ecourts</option>
                                              <option value="8" <?=($orc_cat_id==8)?'selected':''?>>Webstore</option>
                                              <option value="9" <?=($orc_cat_id==9)?'selected':''?>>EW</option>
                                              <option value="10" <?=($orc_cat_id==10)?'selected':''?>>QC</option>
                                              <option value="11" <?=($orc_cat_id==11)?'selected':''?>>Pending</option>
                                              
                                          </select>
				      
                                      
                                      </div>
                                      
				  </div>
                            
                            <div class="form-group">
                                      <label for="firstName" class="col-lg-3 control-label"><label class="text-danger">*&nbsp;&nbsp;</label>Name</label>
                                      <div class="col-lg-6">
                                          <input type="text" class="form-control" name="txt_ownercause_name" id="txt_ownercause_name" autofocus  required onkeypress="return inputLimiter(event,'NameCharactersAndNumbers')" value="<?=$orc_name?>"/>
				      </div>
				  </div>
                            
                             <div class="form-group">
				    <div class="col-lg-offset-3 col-lg-10">
				      <button type="submit" class="btn btn-success">Save</button> <a href="<?= base_url();?>master/orc" class="btn btn-primary">Cancel</a>
				    </div>
				  </div>
                        </form>
               
                    </div>
                    
                </div>
                <!-- /.row -->

            </div>
            <!-- /.container-fluid -->

       
    