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
        		'onsubmit'   => 'return check_pic()'
        	);
   		?>	
		<!-- Form for update user profile picture -->	
		<?php echo form_open_multipart('user_profile/update_profile_pic', $data);?>
			<div class="text-center form_group col-md-3">
		   	<img  class="img-rounded profile_pic"  src="<?php echo base_url("assets/profile_pics"). "/" . $user['profile_pic'] ?>" alt="Profile not set">
		    <h6>Upload a different photo...</h6>
  			<?php
  				echo form_upload(control_array('profile_pic', 'profile_pic', 'form-control'));
  				echo form_hidden('edit_user_id', $user['user_id']);
  				$data =control_array('img_submit', 'img_submit', 'form-control btn btn-success');
  				$data['value'] = "Upload Image";
  				echo form_submit($data);
  			?>
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
         			'onsubmit'   => 'return edit_user()'
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
   				<div class="col-md-4 text-right">
   					<?php echo form_label('First name', 'first_name', 'class => "control-label"');?>
   				</div>
   				<div class="col-md-8">
   					<?php 
   						echo form_hidden('edit_user_id', $user['user_id']);
   						$data = input_array('first_name', 'first_name', 'col-md-8 form-control', 'First name');
   						if(isset($user['first_name']))
   						{
   							$data['value'] = $user['first_name'];
   						}
						echo form_input($data);
					?>
    					<label class="col-md-8 error_class">
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
   						if(isset($user['last_name']))
   						{
   							$data['value'] = $user['last_name'];
   						}
   						
						echo form_input($data);
					?>
    					<label class="col-md-8 error_class">
				    	  	<?php echo form_error('last_name'); ?>
			    	    </label>
   					</div>
  				</div>
				<div class="form-group">
					<div class="col-md-4 text-right">
   					<?php echo form_label('Email-id', 'email_id', 'class => "control-label"');?>
   				</div>
					<div class="col-md-8">
   					<?php
                $data = input_array('email_id', 'email_id', 'col-md-8 form-control', 'Example@Email.com');
                if(isset($user['email_id']))
                {
                  $data['value'] = $user['email_id'];
                }
                if($this->session->userdata['privilege'] == 1)
                {
                  $data['readonly']    =   'true';
                }
  						echo form_input($data);
  					?>
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
					<div class="col-md-4 text-right">
   					<?php echo form_label('User name', 'user_name', 'class => "control-label"');?>
   				</div>
					<div class="col-md-8">
    				<?php
    					$data = input_array('user_name', 'user_name', 'col-md-8 form-control', 'User name');
   						if(isset($user['user_name']))
   						{
   							$data['value'] = $user['user_name'];
   						}
              if($this->session->userdata['privilege'] == 1)
              {
                $data['readonly']    =   'true';
              }
   						echo form_input($data);
					  ?>
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
   						if(isset($user['address_line1']))
   						{
   							$data['value'] = $user['address_line1'];
   						}
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
   						if(isset($user['address_line2']))
   						{
   							$data['value'] = $user['address_line2'];
   						}
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
   						if(isset($user['city']))
   						{
   							$data['value'] = $user['city'];
   						}	
						  echo form_input($data);
            ?>
			      <label class="col-md-8 error_class">
			       	<?php echo form_error('city'); ?>
			      </label>
    			</div>
  			</div>
  			<div class="form-group">
  				<div class="col-md-4  text-right">
   					<?php echo form_label('Zip code', 'zip-code', 'class => "control-label"');?>
   				</div>
   				<div class="col-md-8 ">
	    			<?php
    					$data = input_array('zip_code', 'zip_code', 'col-md-8 form-control', 'Zip code');
   						if(isset($user['zip_code']))
   						{
   							$data['value'] = $user['zip_code'];
   						}
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
   						if(isset($user['state']))
   						{
   							$data['value'] = $user['state'];
   						}
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
   						if(isset($user['country']))
   						{
   							$data['value'] = $user['country'];
   						}
   						echo form_input($data);
            ?>
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