<style>
	.post-filter-sec>form {

		width: 50% !important;
	}

	.purify {
		margin-top: 0px !important;
		float: none !important;
		width: 100% !important;
		text-align: right;
	}

	.purify .chosen-container {

		width: 100% !important;
	}

	.pepl-info {
		width: 78% !important;
	}

	.mtr-btn {
		margin-top: 0px !important;
		padding: 10px 30px !important;
	}

	@media screen and (max-width: 768px) {
		.purify {
			margin-top: 15px !important;

		}
	}
</style>
<section>
	<div class="gap gray-bg">
		<div class="container">
			<div class="row" id="page-contents">
				<div class=" col-lg-12">
					<div class="blog-sec">
						<div class="post-filter-sec">
							<form method="get" action="<?php echo base_url()?>genre" class="filter-form">
								<div class="row">
									<div class="col-md-5">
										<input type="text" name="search" placeholder="Search User">
									</div>
									<div class="col-md-5">
										<div class="purify">
											<select name="genre">
												<option value="">Genre Music</option>
												<?php foreach ($getenre as $val){
												echo "<option value=".$val['id'].">".$val['name_genre']."</option>";
												}		
												?>
											</select>
										</div>
									</div>
									<div class="col-md-2">
										<button type="submit" class="mtr-btn"><span>Search</span></button>
									</div>
								</div>


							</form>

						</div>
						<div class="row">
							<?php 
							foreach($getBySearch as $val){
							?>
							<div class="col-lg-4 col-sm-6">
								<div class="g-post-classic">
									<figure>
									</figure>
									<div class="g-post-meta">
										<div class="nearly-pepls">
											<figure>
												<a href="<?php echo base_url($val['username'])?>" title="">
												<?php
												$is_url = substr($val['photo'], 0, 4);
												if ($is_url == 'http') {
													?>
													<img src="<?php echo $val['photo']; ?>" width="45" alt="">
												<?php
												} else {
													?>
													<img src="<?php echo base_url() . 'public/uploads/' . $val['photo']; ?>" width="45" alt="">
												<?php
												}
												?>
											</figure>
											<div class="pepl-info">
												<h4><a href="<?php echo base_url($val['username'])?>" title=""><?php echo $val['full_name']?></a></h4>
												<span>Genre : <a href="<?php echo base_url('genre/'.$val['idgenre'])?>"><?php echo $val['name_genre']?></a></span>
												<a href="#" title="" class="add-butn" data-ripple=""><?php echo $val['status']?></a>
											</div>
										</div>
									</div>
								</div>
							</div>
							<?php 
							}
							?>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>