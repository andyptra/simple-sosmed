<!DOCTYPE html>
<html lang="en">

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="description" content="" />
	<meta name="keywords" content="" />
	<title>Social Media</title>

	<link rel="stylesheet" href="<?php echo base_url() . 'theme/' ?>css/main.min.css">
	<link rel="stylesheet" href="<?php echo base_url() . 'theme/' ?>css/style.css">
	<link rel="stylesheet" href="<?php echo base_url() . 'theme/' ?>css/color.css">
	<link rel="stylesheet" href="<?php echo base_url() . 'theme/' ?>css/responsive.css">

</head>

<body>
	<!--<div class="se-pre-con"></div>-->
	<div class="theme-layout">
		<div class="responsive-header">
			<div class="mh-head first Sticky">

				<span class="mh-text">
					<a href="<?php echo base_url('dashboard') ?>" title=""><img src="<?php echo base_url() . 'theme/' ?>images/logo.png" alt=""></a>
				</span>

			</div>
			

		</div><!-- responsive header -->
		<div class="topbar stick">
			<div class="logo">
				<a title="" href="<?php echo base_url('dashboard') ?>"><img src="<?php echo base_url() . 'theme/' ?>images/logo.png" alt=""></a>
			</div>
			<div class="top-area">
				<ul class="setting-area">
					<li><a href="<?php echo base_url() . 'dashboard' ?>" title="Home" data-ripple=""><i class="ti-home"></i></a></li>
				</ul>
				<div class="user-img">
					<?php
					$is_url = substr($photos, 0, 4);
					if ($is_url == 'http') {
						?>
						<img src="<?php echo $photos; ?>" width="45" alt="">
					<?php
					} else {
						?>
						<img src="<?php echo base_url() . 'public/uploads/' . $photos; ?>" width="45" alt="">
					<?php
					}

					?>
					<span class="status f-online"></span>
				</div>
			</div>
		</div><!-- topbar -->