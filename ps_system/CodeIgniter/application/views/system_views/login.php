<!-- Main body of the page -->
	<div class="container-fluid">
		<div class="col-md-6 col-md-offset-3">	
			<!-- Page header -->
			<div class="form_head text-center">
				<h1>User Login</h1>
			</div>
			<!--  Login form -->		
      <?php echo form_open('login/check_data');
      ?>
  				<div class="form-group form-gp">
   					<label for="user_name" class="col-md-4 control-label text-right">User name:</label>
   					<div class="col-md-8">
    					<input type="text" class="form-control" id="user_name" name="user_name" placeholder="Enter your user name or email" >
            <label class="col-md-8 has-error error_class">
              <?php echo form_error('user_name'); ?>
            </label>
            </div>
  				</div>
  				<div class="form-group form-gp">
   					<label for="password" class="col-md-4 control-label text-right">Password:</label>
   					<div class="col-md-8">
    					<input type="password" class="form-control " id="password" name="password" placeholder="Password" >
            <label class="col-md-8 has-error error_class">
              <?php echo form_error('password'); ?>
            </label>
            </div>
  				</div>
  				<div>
  					<label for="errors" class="col-md-8  col-md-offset-4 text-danger">
              <?php echo isset($err_message) ? $err_message : '' ?>
					   </label>
				</div>
  				<div class="form-group form-gp ">
  					<div class="col-md-3 col-md-offset-3">
  						<button type="submit" class="col-md-4 btn btn-block btn-success btn_submit text-right">Login</button>
  					</div>
  					<div class="col-md-3">
            			<a class="btn btn-block btn-success btn_submit" href=<?php echo site_url("registration/index");?>>Registration</a>
  					</div>
  				</div>
			<?php echo form_close();?>
		</div>
	</div>