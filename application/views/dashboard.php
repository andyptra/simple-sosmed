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
						<div class="col-lg-6">
							<div class="central-meta">
								<div class="new-postbox">
									<figure>
										<?php
										$is_url = substr($photos, 0, 4);
										if ($is_url == 'http') {
											?>
											<img src="<?php echo $photos; ?>" alt="">
										<?php
										} else {
											?>
											<img src="<?php echo base_url() . 'public/uploads/' . $photos; ?>" alt="">
										<?php
										}

										?>
									</figure>
									<div class="newpst-input">
										<form method="post" action="<?php echo base_url() . 'dashboard/insertPost'; ?>">
											<textarea rows="2" name="post" placeholder="write something"></textarea>
											<div class="attachments">
												<ul>
													<li>
														<button type="submit">Post</button>
													</li>
												</ul>
											</div>
										</form>
									</div>
								</div>
							</div><!-- add post new box -->
							<div class="loadMore">
								<?php foreach ($timeline as $val) {
									?>
									<div class="central-meta item">
										<div class="user-post">
											<div class="friend-info">
												<figure>
													<?php
														$is_url = substr($val->photo, 0, 4);
														if ($is_url == 'http') {
															?>
														<img src="<?php echo $val->photo; ?>" alt="">
													<?php
														} else {
															?>
														<img src="<?php echo base_url() . 'public/uploads/' . $val->photo; ?>" alt="">
													<?php
														}
														?>
												</figure>
												<div class="friend-name">
													<ins><a href="#" title=""><?php echo $val->full_name; ?></a></ins>
													<span>published: <?php echo date('d F Y', strtotime($val->date));
																			echo "&nbsp;" . date('h:i A', strtotime($val->date)); ?> <br/>Genre Music : <?php echo "$val->name_genre"?></span>
												</div>
												<div class="post-meta">
												
													<div class="description">

														<?php
															$dt = getPost($val->post);
															if (is_array($dt)) {
																echo $dt['post'];
																if (!empty($dt['img'])) {
																	foreach ($dt['img'] as $val) {
																		echo "<img src=" . $val . " alt=''>";
																	}
																}
															}

															?>
													</div>
												</div>
											</div>
										</div>
									</div>
								<?php
								}
								?>

							</div>
						</div><!-- centerl meta -->
						<div class="col-lg-3">
							<aside class="sidebar static">
								<div class="widget">
									<h4 class="widget-title">Recomend to Follow</h4>
									<ul class="followers">
										<?php foreach ($getRecommended as $val) {
											?>
											<li>
												<figure><img src="<?php echo base_url() . 'public/uploads/' . $val['photo'] ?>" alt=""></figure>
												<div class="friend-meta">
													<h4><a href="<?php echo base_url($val['username']) ?>" title=""><?php echo $val['full_name'] ?></a></h4>
													<a href="<?php echo base_url() . 'follow/' . $val['username'] ?>" title="" class="underline">Follow</a>
												</div>
											</li>
										<?php
										} ?>
									</ul>
								</div><!-- page like widget -->
								<div class="widget">
									<h4 class="widget-title">Genre Music</h4>
									<ul class="naves">
										<?php foreach ($genre as $val) {
											echo " <li>
                                            <a href='" . base_url() . "genre/" . $val['id'] . "' title=''>" . $val['name_genre'] . "</a>
                                        </li>";
										} ?>
									</ul>
								</div><!-- Shortcuts -->
							</aside>
						</div><!-- sidebar -->
					</div>
				</div>
			</div>
		</div>
	</div>
</section>