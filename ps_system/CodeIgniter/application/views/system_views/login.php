<!-- Main body of the page -->
<div class="container-fluid">
	<div class="col-md-6 col-md-offset-3">	
		<!-- Page header -->
		<div class="form_head text-center">
			<h1>User Login</h1>
		</div>
		<!--  Login form -->
      <?php
        $data = array(
              'name'  => 'login',
              'id' => 'login',
              'onsubmit'   => 'return login_check()'
            );
      ?>		
      <?php echo form_open('login/check_data', $data);?>
  			<div class="form-group form-gp">
				  <div class="col-md-4 text-right">
            <?php echo form_label('User name', 'user_name', 'class => "control-label"');?>
          </div>
          <div class="col-md-8">
            <?php
              $data = input_array('user_name', 'user_name', "col-md-8 form-control", "User name");
              if(isset($user))
              {
                $data['value'] = $user;
              }
              $data['value'] = set_value('user_name');
              echo form_input($data);
            ?>
            <label class="col-md-8 error_class">
              <?php echo form_error('user_name'); ?>
            </label>
          </div>
        </div>
        <div class="form-group">
          <div class="col-md-4 text-right">
            <?php echo form_label('Password', 'password', 'class => "control-label"');?>
          </div>
          <div class="col-md-8">
            <?php
              $data = input_array('password', 'password', "col-md-8 form-control", "Password");
              echo form_password($data);
            ?>
            <label class="col-md-8 error_class">
              <?php echo form_error('password'); ?>
            </label>
          </div>
        </div>
  			<div>
  				<label for="errors" class="col-md-8  col-md-offset-4 text-danger">
          		<?php 
                if(isset($err_message))
                {
                  echo $err_message;
                }
              ?>
				  </label>
        </div>
  			<div class="form-group form-gp ">
  				<div class="col-md-3 col-md-offset-3">
  					<button type="submit" class="col-md-4 btn btn-block btn-success btn_submit text-right">Login</button>
  				</div>
  				<div class="col-md-3">
         		<a class="btn btn-block btn-success btn_submit" href=<?php echo site_url("registration");?>>Singup</a>
  				</div>
  			</div>
		  <?php echo form_close();?>
	</div>
</div>