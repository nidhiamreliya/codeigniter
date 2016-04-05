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
	              'onsubmit'   => 'form_validation()'
	            );
	    ?>
		<?php echo form_open('registration/validate_user', $data);?>
      	<div class="form-group">
				<label for="first name" class="col-md-4 control-label text-right">First name:</label>
					<div class="col-md-8">
    				<input type="text" class="form-control" id="first_name" name="first_name" placeholder="First name" value="<?php echo set_value('first_name'); ?>">
            <label class="col-md-8 has-error error_class">
              <?php echo form_error('first_name'); ?>
            </label>
  				</div>
			</div>
			<div class="form-group">
  			<label for="last name" class="col-md-4 control-label text-right">Last name:</label>
  			<div class="col-md-8">
     				<input type="text" class="form-control" id="last_name" name="last_name" placeholder="Last name" value="<?php echo set_value('last_name'); ?>">
            	<label class="col-md-8 error_class">
             		<?php echo form_error('last_name'); ?>
            	</label>
    		</div>
  			</div>
  			<div class="form-group">
				<label for="email id" class="col-md-4 control-label text-right">E-mail:</label>
				<div class="col-md-8">
 					<input type="email" class="form-control" id="email_id" name="email_id" placeholder="Example@Email.com" value="<?php echo set_value('email_id'); ?>">
         		<label class="col-md-8 error_class">
           			<?php echo form_error('email_id'); ?>
         		</label>
 				</div>
  			</div>
  			<div class="form-group">
				<label for="user name" class="col-md-4 control-label text-right">User name:</label>
				<div class="col-md-8">
    				<input type="text" class="form-control" id="user_name" name="user_name" placeholder="User name" value="<?php echo set_value('user_name'); ?>">
	            <label class="col-md-8 error_class">
	             <?php echo form_error('user_name'); ?>
	            </label>
 				</div>
  			</div>
  			<div class="form-group">
				<label for="Password" class="col-md-4 control-label text-right">Password:</label>
				<div class="col-md-8">
 					<input type="password" class="form-control" id="password"  name="password" placeholder="Password">
         		<label class="col-md-8 error_class">
           			<?php echo form_error('password'); ?>
         		</label>
 				</div>
  			</div>
  			<div class="form-group">
   			<label for="confirm password" class="col-md-4 control-label text-right">Confirm Password:</label>
   			<div class="col-md-8">
    				<input type="password" class="form-control" id="confirm_password" name="confirm_password" placeholder="Confirm password">
    				<label class="col-md-8 error_class">
         	   	<?php echo form_error('confirm_password'); ?>
            	</label>
            </div>
  			</div>
  			<div class="form-group">
   			<label for="address line1" class="col-md-4 control-label text-right">Address:</label>
   			<div class="col-md-8">
    				<input type="text" class="form-control" id="address_line1" name="address_line1" placeholder="Address line1" value="<?php echo set_value('address_line1'); ?>">
    				<label class="col-md-8 error_class">
         	     <?php echo form_error('address_line1'); ?>
            	</label>
            </div>
    		</div>
    		<div class="form-group">
    			<div class="col-md-8 col-md-offset-4">
    				<input type="text" class="form-control" id="address_line2" name="address_line2" placeholder="Address line2" value="<?php echo set_value('address_line2'); ?>">
            	<label class="col-md-8 error_class"></label>
            </div>
  				</div>
  			<div class="form-group">
				<label for="City" class="col-md-4 control-label text-right">City:</label>
				<div class="col-md-8">
 					<input type="text" class="form-control" id="city" name="city" placeholder="City" value="<?php echo set_value('city'); ?>">
		         <label class="col-md-8 error_class">
		           <?php echo form_error('city'); ?>
		         </label>
 				</div>
  			</div>
  			<div class="form-group">
				<label for="Zip code" class="col-md-4 control-label text-right">Zip Code:</label>
				<div class="col-md-8">
 					<input type="text" class="form-control" id="zip_code" name="zip_code" placeholder="Zip-code" value="<?php echo set_value('zip_code'); ?>">
					<label class="col-md-8 error_class">
					  <?php echo form_error('zip_code'); ?>
					</label>
 				</div>
  			</div>
  			<div class="form-group">
   			<label for="State" class="col-md-4 control-label text-right">State:</label>
   			<div class="col-md-8">
    				<input type="text" class="form-control" id="state" name="state" placeholder="State" value="<?php echo set_value('state'); ?>">
            	<label class="col-md-8 error_class">
              		<?php echo form_error('state'); ?>
            	</label>
    			</div>
  			</div>
  			<div class="form-group">
   			<label for="Country" class="col-md-4 control-label text-right">Country:</label>
   			<div class="col-md-8">
    				<input type="text" class="form-control" id="country" name="country" placeholder="Country" value="<?php echo set_value('country'); ?>">
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