<!-- Main body of the page -->
<div class="container-fluid">
	<div class="row">	
			<!-- page header -->
			<div class="form_head text-center">
		      	<div class="col-md-4 col-md-offset-1">
					<h1>Welcome Admin</h1>
				</div>
				<div class="col-md-3 col-md-offset-3 text-right">
					<ul class="nav nav-pills">
  						<li role="presentation"><a value="Log out" class="btn-success btn_head" name="logout" href=<?php echo site_url("log_out");?>>Log out</a></li>
  						<li class="presentation"><a value="My Profile" class="btn-success btn_head"  name="myprofile" href="user_profile.php">My Profile</a></li>
					</ul>				
				</div>
		    </div> 
		</div>
		<!-- page body -->
		<div class="row">
			<div class="col-md-10 col-md-offset-1">
				<!-- Table header -->
				<table class="table-striped col-md-12 table-bordered table-responsive">
						<tr>
						<th>First name</th>
						<th>Last name</th>
						<th>User name</th>
						<th>Email id</th>
						<th colspan=2>Address</th>
						<th>City</th>
						<th>Zip code</th>
						<th>State</th>
						<th>Country</th>
						<th>Edit</th>
						<th>Delete</th>
						</tr>
					<!-- Table data -->
					<?php foreach ($user_data as $row):?>	
						<tr>
							<td> <?php echo $row->first_name ?> </td>
							<td> <?php echo $row->last_name ?> </td>
							<td> <?php echo $row->user_name ?> </td>
							<td> <?php echo $row->email_id ?> </td>
							<td> <?php echo $row->address_line1 ?> </td>
							<td> <?php echo $row->address_line2 ?> </td>
							<td> <?php echo $row->city ?> </td>
							<td> <?php echo $row->zip_code ?> </td>
							<td> <?php echo $row->state ?> </td>
							<td> <?php echo $row->country ?> </td>
							<td> <a href="<?php echo base_url() ?>index.php/user_profile/edit_user/<?php echo $row->user_id ?>">Edit</a></td>
							<td> <a onclick="return confirm('Are you sure you want to delete \'<?php echo $row->first_name ?> \'?');" href="<?php echo base_url() ?>index.php/manage_user/delete_user/<?php echo $row->user_id ?>" >Delete</a></td>
						</tr>
					<?php endforeach ?>
				</table>
			</div>
		</div>
		<!-- Print messge on successful delete data. -->  
		<div class="row">
			<span class="col-md-4 col-md-offset-4 text-center text-success" >
				<?php 
					if($this->session->flashdata('success_msg') != '')
					{ 
						$message = $this->session->flashdata('success_msg');
						echo $message;
					}
				?>
			</span>
		</div>
	</div>