<?php
if ($id !== '') {
    $title = "Update Issue";
    
    $prblm_name = $prblmdet[0]->prblm_name;
    $ct_id = $prblmdet[0]->ct_id_fk;
    $checked = ($prblmdet[0]->is_complaint=='1')?'checked="checked"':'';
	
} else {
    $title = "Add Issue";
    $id=$checked='';
   // $level = $desc = '';
}
?>
           <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Issues
        <small>Management panel</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li>Issues</li>
		        <li class="active"><?=$title?></li>

      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <!-- Small boxes (Stat box) -->
      <div class="row">
                    <div class="col-lg-12">
                        <h4><?=$title?></h4>
                        <form  name="myform" class="form-horizontal" role="form" action='<?php echo base_url(); ?>master/prblm_save' method="post">
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
                                          <select name="sel_ct_id" required class="form-control">
										  <?php foreach($TOPIC as $type) { 
                                                                                      $sel = ($ct_id==$type->ct_id_pk)?'selected="selected"':'';
                                                                                      ?>
										  <option value="<?=$type->ct_id_pk?>" <?=$sel?> ><?=$type->ct_name?></option>
										  <?php } ?>
										  </select>
				      </div>
				  </div>
                            <div class="form-group">
                                      <label for="firstName" class="col-lg-3 control-label"><label class="text-danger">*&nbsp;&nbsp;</label>Name</label>
                                      <div class="col-lg-6">
                                          <input type="text" class="form-control" name="txt_prblm_name" id="txt_prblm_name" autofocus  required  onkeypress="return inputLimiter(event,'NameCharactersAndNumbers')" value="<?=$prblm_name?>"/>
				      </div>
				  </div>
                            <div class="form-group">
                                <div class="col-lg-offset-3" style="float:left;" align="right"><input type="checkbox" name="is_complain" id="is_complain" value="1" <?=$checked?> />
                                      </div>
                                <label for="firstName" class="col-lg-2 control-label"> This is complaint</label>
				  </div>
                      
                             <div class="form-group">
				    <div class="col-lg-offset-3 col-lg-10">
				      <button type="submit" class="btn btn-success">Save</button> <a href="<?= base_url();?>master/prblm" class="btn btn-primary">Cancel</a>
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
