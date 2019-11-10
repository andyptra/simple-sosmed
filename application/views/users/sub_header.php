<section>
		<div class="feature-photo">
			<figure>
				
			
			<img style="height:400px!important;" src="<?php echo base_url().'public/uploads/'.$otherUser->cover; ?>" alt=""></figure>
            <?php if($username!=$session_username){
                                        ?>
            <div class="add-btn">
				<a href="#" title="" data-ripple=""><?php echo $friend ?></a>
            </div>
            <?php } 
                                    ?>
			
			<div class="container-fluid">
				<div class="row merged">
					<div class="col-lg-2 col-sm-3">
						<div class="user-avatar">
							<figure>
                            <?php 
                                                $is_url = substr($otherUser->photo,0,4);
                                                if($is_url=='http'){
                                                    ?>
                                                    	<img src="<?php  echo $otherUser->photo; ?>" alt="">
                                                    <?php
                                                } else {
                                                    ?>
                                                    <img src="<?php  echo base_url().'public/uploads/'.$otherUser->photo; ?>" alt="">
                                                    <?php
                                                }
                        
                                                ?>
							</figure>
						</div>
					</div>
					<div class="col-lg-10 col-sm-9">
						<div class="timeline-info">
							<ul>
								<li class="admin-name">
                                  <h5><?php echo $otherUser->full_name ?>
                                  </h5>
                                  <span>Genre Music : <?php echo $otherUser->name_genre;?></span>
								</li>
								<li>
									
									<a class="" href="<?php echo base_url($username)?>" title="" data-ripple="">Timeline</a>
									<a class="" href="<?php echo base_url($username).'/following'?>" title="" data-ripple=""><?php echo $following ?> Following</a>
                                    <a class="" href="<?php echo base_url($username).'/followers'?>" title="" data-ripple=""><?php echo $followers ?> Followers</a>
                                    <?php if($username==$session_username){
                                        ?>
                                    <a class="" href="<?php echo base_url($username).'/edit'?>" title="" data-ripple="">Edit Profile</a>
                                    <?php } 
                                    ?>
								</li>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section><!-- top area -->