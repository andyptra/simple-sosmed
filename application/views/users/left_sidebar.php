<section>
	<div class="gap gray-bg">
		<div class="container-fluid">
			<div class="row">
				<div class="col-lg-12">
					<div class="row" id="page-contents">
						<div class="col-lg-3">
							<aside class="sidebar static">
							<div class="post-filter-sec" style="margin-bottom:0px!important;">
											<form method="get" action="<?php echo base_url()?>genre" class="filter-form">
														<input type="text" name="search" placeholder="Search User">
														<input type="submit" style="position: absolute; left: -9999px"/>
											</form>
							</div>
								<div class="widget">
									
									<h4 class="widget-title">Shortcuts</h4>
									<ul class="naves">
								
										<li>
											<i class="ti-clipboard"></i>
											<a href="<?php echo base_url() ?>" title="">News feed</a>
										</li>
										<li>
											<i class="ti-files"></i>
											<a href="<?php echo base_url($username) ?>" title="">Profile</a>
										</li>
										<li>
											<i class="ti-user"></i>
											<a href="<?php echo base_url($username) . '/following' ?>" title="">Friends</a>
										</li>
										<li>
											<i class="ti-power-off"></i>
											<a href="<?php echo base_url() . 'logout' ?>" title="">Logout</a>
										</li>
									</ul>
								</div><!-- Shortcuts -->

							</aside>
						</div><!-- sidebar -->