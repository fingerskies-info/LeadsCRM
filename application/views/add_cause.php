<?php
if ($id !== '') {
    $title = "Update Root Cause";
    
    $rc_name = $root_causedet[0]->rc_name;
    $ct_id = $root_causedet[0]->ct_id_fk;
    $prblm_id = $root_causedet[0]->prblm_id_fk;
    //$checked = ($prblmdet[0]->is_complaint=='1')?'checked="checked"':'';
	
} else {
    $title = "Add Root Cause";
    $id=$ct_id='';
   // $level = $desc = '';
}
?>
           <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Root Cause
        <small>Management panel</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li>Root Cause</li>
		        <li class="active"><?=$title?></li>

      </ol>
    </section>
 
    <!-- Main content -->
    <section class="content">
      <!-- Small boxes (Stat box) -->
      <div class="row">
                    <div class="col-lg-12">
                        <h4><?=$title?></h4>
                        <form  name="myform" class="form-horizontal" role="form" action='<?php echo base_url(); ?>master/rc_save' method="post">
                            <input type="hidden" name="id" value="<?=$id?>" />
                              <?php if(isset($message)){?>
                                     <div class="col-sm-12"><div class="alert alert-success"><?=$message?></div></div>
                                <?php }else if(isset($error)) {?>
                                     <div class="col-sm-12"><div class="alert alert-danger"><?=$error?></div></div>
                                <?php } ?>
                            <p><label class="text-danger">Required fields are marked with *</label></p>
							<div class="form-group">
                                      <label for="firstName" class="col-lg-3 control-label"><label class="text-danger">*&nbsp;&nbsp;</label>Topic</label>
                                      <div class="col-lg-6">
                                          <select name="sel_ct_id" required id="sel_ct_id" class="form-control" onchange="return getTopicIssue(this.value,3);">
										  <?php foreach($TOPIC as $type) { 
                                                                                      $sel = ($ct_id==$type->ct_id_pk)?'selected="selected"':'';
                                                                                      ?>
										  <option value="<?=$type->ct_id_pk?>" <?=$sel?> ><?=$type->ct_name?></option>
										  <?php } ?>
										  </select>
				      </div>
				  </div>
                            <div class="form-group">
                                <span class="tooltip"><i class="fa fa-2x fa-info-circle"></i>
                                        <span class="tooltiptext">Issues marked as a complaint will be listed out.</span>
                                      </span><label for="firstName" class="col-lg-3 control-label"><label class="text-danger">*&nbsp;&nbsp;</label>Issues</label>
                                      <div class="col-lg-6">
                                          <select name="sel_prblm_id" required class="form-control" id="sel_prblm_id" style="float: left"></select>
				      
                                      
                                      </div>
                                      
				  </div>
                            
                            <div class="form-group">
                                      <label for="firstName" class="col-lg-3 control-label"><label class="text-danger">*&nbsp;&nbsp;</label>Name</label>
                                      <div class="col-lg-6">
                                          <input type="text" class="form-control" name="txt_cause_name" id="txt_cause_name" autofocus  required onkeypress="return inputLimiter(event,'NameCharactersAndNumbers')" value="<?=$rc_name?>"/>
				      </div>
				  </div>
                            
                             <div class="form-group">
				    <div class="col-lg-offset-3 col-lg-10">
				      <button type="submit" class="btn btn-success">Save</button> <a href="<?= base_url();?>master/rc" class="btn btn-primary">Cancel</a>
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
    <script>  getTopicIssue($("#sel_ct_id").val(),'3');</script>  
 