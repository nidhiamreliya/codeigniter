<!-- Main body of the page -->
<div class="container-fluid">
	<!-- Header of page -->
	<div class="row">
		<div class="form_head text-center">
	      <div class="col-md-4">
				<h1>welcome <?php echo isset($user['first_name'])? $user['first_name'] : ''?></h1>
			</div>
			<div class="col-md-3 col-md-offset-3 text-right">
				<ul class="nav nav-pills">
  					<li role="presentation">
  						<a value="Log out" class="btn-success btn_head" name="logout" href=<?php echo site_url("log_out");?>>Log out</a>
  					</li>
  					<li role="presentation">
  						<a value="back" class="btn-success btn_head"  name="back" href=<?php if($this->session->userdata('privilege') == '2'){ echo site_url("manage_user");} else{ echo site_url("log_out");} ?>>Back</a>
  					</li>
				</ul>				
			</div>
		</div>  
	</div>
	<!--  Middle Body of the page -->
	<div class="row">
	 	<?php
   			$data = array(
        		'name'  => 'edit_profile_pic',
        		'id' => 'edit_profile_pic',
        		'onsubmit'   => 'check_pic()'
        	);
   		?>	
		<!-- Form for update user profile picture -->	
		<?php echo form_open_multipart('user_profile/update_profile_pic', $data);?>
			<div class="text-center form_group col-md-3">
		   		<img  class="img-rounded profile_pic"  src="<?php echo base_url("assets/profile_pics"). "/" . $user['profile_pic'] ?>" alt="Profile not set">
		      	<h6>Upload a different photo...</h6>
		      	<input type="file" name="profile_pic" class="form-control" id="profile_pic">
				<input type="submit" value="Upload Image" class="form-control btn btn-success" name="img_submit">
				<input type="hidden" name="edit_user_id" id="edit_user_id" value="<?php echo isset($user['user_id'])? $user['user_id'] : ''?>">
	 			<div class="col-md-12 text-danger">
	 				<?php 
						if($this->session->flashdata('error'))
						{ 
							$message = $this->session->flashdata('error');
							echo $message['error'];
						}
					?>
            	</div>
            	<div class="col-md-12 text-success">
	 				<?php 
						if($this->session->flashdata('success_msg'))
						{ 
							$message = $this->session->flashdata('success_msg');
							echo $message;
						}
					?>
            	</div>
		   </div>
		<?php echo form_close()?>
		<!-- Form for update user information -->
		<div class="col-md-6 "> 
			<?php
   				$data = array(
           			'name'  => 'edit_profile',
           			'id' => 'edit_profile',
           			'onsubmit'   => 'edit_user()'
         		);
   	 		?>
			<?php echo form_open('user_profile/update_profile', $data);?>
				<div class="col-md-12 col-md-offset-4">
				<!-- Print message on successful update of data -->
					<span class="text-success">
			        	<?php 
							if($this->session->flashdata('successful'))
							{ 
								$message = $this->session->flashdata('successful');
								echo $message;
							}
						?>
					</span>
        	  	</div>
				<div class="form-group">
   				<label for="first_name" class="col-md-4 control-label">First name:</label>
   				<div class="col-md-8">
   					<input type="hidden" name="edit_user_id" id="edit_user_id" value="<?php echo isset($user['user_id'])? $user['user_id'] : ''?>">
    					<input type="text" class="form-control" name="first_name" id="first_name" placeholder="First name" value="<?php echo isset($user['first_name'])? $user['first_name'] : ''?>">
    					<label class="col-md-8 error_class">
			            	<?php echo form_error('first_name'); ?>
     					</label>
     				</div>
				</div>
 				<div class="form-group">
					<label for="last_name" class="col-md-4 control-label">Last name:</label>
					<div class="col-md-8">
    					<input type="text" class="form-control" id="last_name" name="last_name" placeholder="Last name" value="<?php echo isset($user['last_name'])? $user['last_name'] : ''?>">
    					<label class="col-md-8 error_class">
				    	  	<?php echo form_error('last_name'); ?>
			    	    </label>
   					</div>
  				</div>
				<div class="form-group">
					<label for="email_id" class="col-md-4 control-label">E-mail:</label>
					<div class="col-md-8">
 						<input type="text" class="form-control" id="email_id" name="email_id" <?php if($this->session->userdata('privilege') == 1) { echo "disabled"; }else{ echo "enabled";} ?> value="<?php echo isset($user['email_id'])? $user['email_id'] : ''?>">
 						<label class="col-md-8 error_class">
	    					<?php echo form_error('email_id'); ?>
	    					<span>
			        			<?php 
									if($this->session->flashdata('exist_emailid'))
									{ 
										$message = $this->session->flashdata('exist_emailid');
										echo $message;
									}
								?>
							</span>
     					</label>
  					</div>
				</div>
  				<div class="form-group">
					<label for="user_name" class="col-md-4 control-label">User name:</label>
					<div class="col-md-8">
    					<input type="text" class="form-control" id="user_name" name="user_name" placeholder="User name"  <?php if($this->session->userdata('privilege') == 1) { echo "disabled"; }else{ echo "enabled";} ?> value="<?php echo isset($user['user_name'])? $user['user_name'] : ''?>">
    					<label class="col-md-8 error_class">
		           			<?php echo form_error('user_name'); ?>
		           			<span>
		        				<?php 
									if($this->session->flashdata('exist_username'))
									{ 
										$message = $this->session->flashdata('exist_username');
										echo $message;
									}
								?>
							</span>
			          	</label>
 					</div>
  				</div>
  				<div class="form-group">
   					<label for="password" class="col-md-4 control-label">Password:</label>
   					<div class="col-md-8">
    					<input type="password" class="form-control" id="password" name="password" placeholder="Password" >
    					<label class="col-md-8 error_class">
			           		<?php echo form_error('password'); ?>
   						</label>
    				</div>
  				</div>
  				<div class="form-group">
					<label for="confirm password" class="col-md-4 control-label">Confirm Password:</label>
					<div class="col-md-8">
 						<input type="password" class="form-control" id="confirm_password" name="confirm_password"placeholder="Confirm password">
  						<label class="col-md-8 error_class">
							<?php echo form_error('confirm_password'); ?>
   						</label>
  					</div>
  				</div>
  				<div class="form-group">
   					<label for="address_line1" class="col-md-4 control-label">Address:</label>
   					<div class="col-md-8">
    					<input type="text" class="form-control" id="address_line1" name="address_line1" placeholder="Address line1" value="<?php echo isset($user['address_line1'])? $user['address_line1'] : ''?>">
    					<label class="col-md-8 error_class">
			            	<?php echo form_error('address_line1'); ?>
			        	</label>
    				</div>
    			</div>
	    		<div class="form-group">
	    			<div class="col-md-8 col-md-offset-4">
	    				<input type="text" class="form-control" id="address_line2" name="address_line2" placeholder="Address line2" value="<?php echo isset($user['address_line2'])? $user['address_line2'] : ''?>">
	    				<label class="col-md-8 error_class">
			        		<?php echo form_error('address_line2'); ?>
			        	</label>
	    			</div>
	  			</div>
  				<div class="form-group">
   					<label for="city" class="col-md-4 control-label">City:</label>
   					<div class="col-md-8">
	    				<input type="text" class="form-control" id="city" name="city" placeholder="City" value="<?php echo isset($user['city'])? $user['city'] : ''?>">
			        	<label>
			           		<?php echo form_error('city'); ?>
			        	</label>
    				</div>
  				</div>
  				<div class="form-group">
   					<label for="Zip_code" class="col-md-4 control-label">Zip Code:</label>
   					<div class="col-md-8">
	    				<input type="text" class="form-control" id="zip_code" name="zip_code" placeholder="Zip-code" value="<?php echo isset($user['zip_code'])? $user['zip_code'] : ''?>">
	    				<label class="col-md-8 error_class">
			           	<?php echo form_error('zip_code'); ?>
			        	</label>
    				</div>
  				</div>
  				<div class="form-group">
   					<label for="state" class="col-md-4 control-label">State:</label>
   					<div class="col-md-8">
    					<input type="text" class="form-control" id="state" name="state" placeholder="State" value="<?php echo isset($user['state'])? $user['state'] : ''?>">
    					<label class="col-md-8 error_class">
			           	<?php echo form_error('state'); ?>
			        	</label>
    				</div>
  				</div>
  				<div class="form-group">
					<label for="country" class="col-md-4 control-label">Country:</label>
					<div class="col-md-8">
    					<input type="text" class="form-control" id="country" name="country" placeholder="Country" value="<?php echo isset($user['country'])? $user['country'] : ''?>">
    					<label class="col-md-8 error_class">
			           	<?php echo form_error('country'); ?>
			         	</label>
 					</div>
  				</div>
  				<center>  					
	  				<button type="submit" class="btn btn-success btn_submit" name="submit">Edit</button>
	  			</center>
			<?php echo form_close()?>
		</div>
	</div>
</div>