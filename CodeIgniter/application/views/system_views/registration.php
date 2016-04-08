<!-- Main body of the page -->
<div class="container-fluid">
	<div class="col-md-6 col-md-offset-3">	
		<!-- Page header -->
		<div class="form_head text-center">
			<h1>Registration Form</h1>
		</div>
		<!-- Registration form -->
	  <?php
	    $data = array(
	            'name'  => 'registration',
	            'id' => 'registration',
	            'onsubmit'   => 'return form_validation()'
	          );
	  ?>
		<?php echo form_open('registration/validate_user', $data);?>
      <div class="form-group">
				<div class="col-md-4 text-right">
          <?php echo form_label('First name', 'first_name', 'class => "control-label"');?>
        </div>
        <div class="col-md-8">
          <?php 
            $data = input_array('first_name', 'first_name', 'col-md-8 form-control', 'First name');
             $data['value'] = set_value('first_name');
            echo form_input($data);
          ?>
          <label class="col-md-8 has-error error_class">
            <?php echo form_error('first_name'); ?>
          </label>
  			</div>
			</div>
			<div class="form-group">
  			<div class="col-md-4 text-right">
          <?php echo form_label('Last name', 'last_name', 'class => "control-label"');?>
        </div>
        <div class="col-md-8">
          <?php
            $data = input_array('last_name', 'last_name', 'col-md-8 form-control', 'Last name');       
            $data['value'] = set_value('last_name');
            echo form_input($data);
          ?>
          <label class="col-md-8 error_class">
           	<?php echo form_error('last_name'); ?>
          </label>
      	</div>
  		</div>
  		<div class="form-group">
				<div class="col-md-4 text-right">
          <?php echo form_label('Email id', 'email_id', 'class => "control-label"');?>
        </div>
        <div class="col-md-8">
          <?php
            $data = input_array('email_id', 'email_id', 'col-md-8 form-control', 'Example@Email.com');       
             $data['value'] = set_value('email_id');
            echo form_input($data);
          ?>
          <label class="col-md-8 error_class">
            <?php echo form_error('email_id'); ?>
          </label>
        </div>
  		</div>
  		<div class="form-group">
				<div class="col-md-4 text-right">
          <?php echo form_label('User name', 'user_name', 'class => "control-label"');?>
        </div>
        <div class="col-md-8">
          <?php
            $data = input_array('user_name', 'user_name', 'col-md-8 form-control', 'User name');
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
            $data = input_array('password', 'password', 'col-md-8 form-control', 'Password');
            echo form_password($data);
          ?>
          <label class="col-md-8 error_class">
            <?php echo form_error('password'); ?>
          </label>
        </div>
  		</div>
  		<div class="form-group">
   			<div class="col-md-4  text-right">
            <?php echo form_label('Confirm password', 'confirm_password', 'class => "control-label"');?>
        </div>
        <div class="col-md-8">
          <?php
            $data = input_array('confirm_password', 'confirm_password', 'col-md-8 form-control', 'Confirm Password');
            echo form_password($data);
          ?>
          <label class="col-md-8 error_class">
            <?php echo form_error('confirm_password'); ?>
          </label>
        </div>
  		</div>
  		<div class="form-group">
   			<div class="col-md-4 text-right">
          <?php echo form_label('Address', 'Address', 'class => "control-label"');?>
        </div>
        <div class="col-md-8">
          <?php
            $data = input_array('address_line1', 'address_line1', 'col-md-8 form-control', 'Address line1');  
            $data['value'] = set_value('address_line1');
            echo form_input($data);
          ?>
          <label class="col-md-8 error_class">
            <?php echo form_error('address_line1'); ?>
          </label>
        </div>
    	</div>
    	<div class="form-group">
    		<div class="col-md-8 col-md-offset-4">
          <?php
            $data = input_array('address_line2', 'address_line2', 'col-md-8 form-control', 'Address line2');
            $data['value'] = set_value('address_line2');
            echo form_input($data);
          ?>
          <label class="col-md-8 error_class">
            <?php echo form_error('address_line2'); ?>
          </label>
        </div>
      </div>
  		<div class="form-group">
				<div class="col-md-4 text-right">
          <?php echo form_label('City', 'city', 'class => "control-label"');?>
        </div>
        <div class="col-md-8">
          <?php
            $data = input_array('city', 'city', 'col-md-8 form-control', 'City'); 
            $data['value'] = set_value('city');
            echo form_input($data);
          ?>
        <label class="col-md-8 error_class">
          <?php echo form_error('city'); ?>
        </label>
      </div>
  		<div class="form-group">
				<div class="col-md-4  text-right">
          <?php echo form_label('Zip code', 'zip-code', 'class => "control-label"');?>
        </div>
        <div class="col-md-8 ">
          <?php
            $data = input_array('zip_code', 'zip_code', 'col-md-8 form-control', 'Zip code');    
            $data['value'] = set_value('zip_code');
            echo form_input($data);
          ?>
          <label class="col-md-8 error_class">
            <?php echo form_error('zip_code'); ?>
          </label>
        </div>
  		</div>
  		<div class="form-group">
   			<div class="col-md-4  text-right">
          <?php echo form_label('State', 'state', 'class => "control-label"');?>
        </div>
        <div class="col-md-8">
          <?php
            $data = input_array('state', 'state', 'col-md-8 form-control', 'State');   
            $data['value'] = set_value('state');
            echo form_input($data);
          ?>
          <label class="col-md-8 error_class">
            <?php echo form_error('state'); ?>
          </label>
        </div>
  		</div>
  		<div class="form-group">
   			<div class="col-md-4  text-right">
          <?php echo form_label('Country', 'country', 'class => "control-label"');?>
        </div>
        <div class="col-md-8">
          <?php
            $data = input_array('country', 'country', 'col-md-8 form-control', 'Country');
            $data['value'] = set_value('country');
            echo form_input($data);
          ?>
          <label class="col-md-8 error_class">
            <?php echo form_error('country'); ?>
          </label>
        </div>
  		</div>
      <div class="form-group">
        <div class="col-md-3 col-md-offset-3">
  			  <button type="submit" class="btn btn-block btn-success btn_submit">Submit</button>
        </div>
        <div class="col-md-3">
         	<a class="btn btn-block btn-success btn_submit" href=<?php echo site_url("login");?>>Login</a>
			  </div>
      </div>
    <?php echo form_close()?>
	</div>
</div>