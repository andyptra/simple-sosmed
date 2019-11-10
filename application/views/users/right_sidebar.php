<div class="col-lg-3">
								<aside class="sidebar static">
									<div class="widget">
										<h4 class="widget-title">Genre Music</h4>
										<ul>
										<?php foreach($genre as $val){
                                           echo " <li>
                                            <a href='".base_url()."genre/".$val['id']."' title=''>".$val['name_genre']."</a>
                                        </li>";
							            }?>
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