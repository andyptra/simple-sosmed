<div class="col-lg-6">
	
	<div class="central-meta">
		<div class="editing-info">
			<h5 class="f-title"><i class="ti-info-alt"></i> Edit Basic Information</h5>

			<form method="POST" action="<?php echo base_url($edituser->username.'/action')?>" enctype="multipart/form-data">
			<input type="hidden" name="id" value="<?php echo $edituser->id;?>">	
			<div class="form-group half">
					<input type="text" name="first" id="input" value="<?php $first=explode(" ",$edituser->full_name); echo $first[0]; ?>" required="required">
					<label class="control-label" for="input">First Name</label><i class="mtrl-select"></i>
				</div>
				<div class="form-group half">
					<input type="text" name="last" value="<?php $last=explode(" ",$edituser->full_name); echo $last[1]; ?>" required="required">
					<label class="control-label" for="input">Last Name</label><i class="mtrl-select"></i>
				</div>
				<div class="form-group half">
					<input type="email" name="email" value="<?php echo $edituser->email ?>" required="required">
					<label class="control-label" for="input">Email</a></label><i class="mtrl-select"></i>
				</div>
				<div class="form-group half">
					<input type="text" name="mobile" value="<?php echo $edituser->mobile ?>"  required="required">
					<label class="control-label" for="input">Phone No.</label><i class="mtrl-select"></i>
				</div>

				
				<div class="form-group">
					<input type="text" name="address" value="<?php echo $edituser->address ?>"  required="required">
					<label class="control-label" for="input">Address</label><i class="mtrl-select"></i>
				</div>
				<div class="form-group half">
					<input type="text" name="age" value="<?php echo $edituser->age ?>"  required="required">
					<label class="control-label" for="input">Age</label><i class="mtrl-select"></i>
				</div>
				<div class="form-group half">
					
				<select class="form-control" name="genres" required="required">
						<?php foreach ($genre as $val){
							if($val['id']==$edituser->idgenres){
								echo "<option value=".$val['id']." selected>".$val['name_genre']."</option>";
							} else {
								echo "<option value=''>Genres</option>";
								echo "<option value=".$val['id'].">".$val['name_genre']."</option>";
							}
											
												}		
												?>
					</select>
					<label class="control-label" for="input">Genre Music</label><i class="mtrl-select"></i>
				</div>
				
				<div class="form-group">
					<textarea rows="4" name="bio"  id="textarea" required="required"><?php echo $edituser->bio ?></textarea>
					<label class="control-label" for="textarea">About Me</label><i class="mtrl-select"></i>
				</div>
				<div class="form-radio">
					<?php
					$sex=$edituser->gender;
					?>
					<div class="radio">
						<label>
							<input type="radio" value="M" <?php echo ($sex=='M')?'checked':'' ?>  name="gender"><i class="check-box"></i>Male
						</label>
					</div>
					<div class="radio">
						<label>
							<input type="radio" value="M" <?php echo ($sex=='F')?'checked':'' ?>  name="gender"><i class="check-box"></i>Female
						</label>
					</div>
					
				</div>
				<div class="submit-btns">
					<button type="submit" name="submit" value="submit_profil" class="mtr-btn"><span>Update</span></button>
				</div>
			</form>
		</div>
	</div>
	<div class="central-meta">
		<div class="editing-info">
			<h5 class="f-title"><i class="ti-image"></i>Photo</h5>
			<form method="POST" action="<?php echo base_url($edituser->username.'/action')?>" enctype="multipart/form-data">
			<input type="hidden" name="id" value="<?php echo $edituser->id;?>">		
			<div class="form-group">
			<label for="photo">photo Profile</label>
					<input type="file" name="photo" id="input" required="required">
					
				</div>
				<div class="form-group">
				<label for="photo">photo Cover</label>
					<input type="file" name="cover" id="input" required="required">
					
				</div>
				<div class="submit-btns">
				<button type="submit" name="submit" value="submit_photo" class="mtr-btn"><span>Update</span></button>
				</div>
			</form>
		</div>
	</div>
	<div class="central-meta">
		<div class="editing-info">
			<h5 class="f-title"><i class="ti-lock"></i>Change Password</h5>
			<form method="POST" action="<?php echo base_url($edituser->username.'/action')?>" enctype="multipart/form-data">
			<input type="hidden" name="id" value="<?php echo $edituser->id;?>">		
			<div class="form-group">
					<input type="password" name="new_password" id="input" required="required">
					<label class="control-label" for="input">New password</label><i class="mtrl-select"></i>
				</div>
				<div class="form-group">
					<input type="password" name="confirm_password" required="required">
					<label class="control-label" for="input">Confirm password</label><i class="mtrl-select"></i>
				</div>
				<div class="form-group">
					<input type="password" name="old_password" required="required">
					<label class="control-label" for="input">Current password</label><i class="mtrl-select"></i>
				</div>
				<div class="submit-btns">
				<button type="submit" name="submit" value="submit_password" class="mtr-btn"><span>Update</span></button>
				</div>
			</form>
		</div>
	</div>

	
</div>