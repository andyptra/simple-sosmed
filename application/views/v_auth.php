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
        <div class="container-fluid pdng0">
            <div class="row merged">
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                    <div class="land-featurearea">
                        <div class="land-meta">
                            <h1>Social Media</h1>
                            <p>
                                Love music
                            </p>

                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                    <div class="login-reg-bg">
                        <div class="log-reg-area sign">
                            <h2 class="log-title">Login</h2>
                            <p>
                                <?php echo $this->session->flashdata('notif_login'); ?>
                            </p>
                            <form method="POST" action="<?php echo base_url() . 'login' ?>">
                                <div class="form-group">
                                    <input type="text" name="email" required="required" />
                                    <label class="control-label" for="input">Email</label><i class="mtrl-select"></i>
                                </div>
                                <div class="form-group">
                                    <input type="password" name="password" required="required" />
                                    <label class="control-label" for="input">Password</label><i class="mtrl-select"></i>
                                </div>
                                <!-- <div class="checkbox"> -->
                                <!-- <label>
								<input type="checkbox" checked="checked"/><i class="check-box"></i>Always Remember Me.
							  </label> -->
                                <!-- </div> -->
                                <!-- <a href="#" title="" class="forgot-pwd">Forgot Password?</a> -->
                                <div class="submit-btns">
                                    <button class="mtr-btn signin" type="submit"><span>Login</span></button>
                                    <button class="mtr-btn signup" type="button"><span>Register</span></button>
                                </div>
                            </form>
                        </div>
                        <div class="log-reg-area reg">

                            <h2 class="log-title">Register</h2>
                            <p>
                                <?php echo $this->session->flashdata('notif_register'); ?>
                            </p>
                            <form method="POST" action="<?php echo base_url() . 'do_register' ?>" enctype="multipart/form-data">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <input type="text" name="first" required="required" />
                                            <label class="control-label" for="input">First Name</label><i class="mtrl-select"></i>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <input type="text" name="last" required="required" />
                                            <label class="control-label" for="input">Last Name</label><i class="mtrl-select"></i>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <input type="text" name="username" required="required" />
                                            <label class="control-label" for="input">User Name</label><i class="mtrl-select"></i>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <input type="text" name="email" required="required" />
                                            <label class="control-label" for="input">Email</label><i class="mtrl-select"></i>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <input type="password" name="password" required="required" />
                                            <label class="control-label" for="input">Password</label><i class="mtrl-select"></i>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <input type="text" name="photo_url" />
                                            <label class="control-label" for="input">Link Avatar</label><i class="mtrl-select"></i>
                                        </div>
                                    </div>
                                </div>



                                <div class="form-group">
                                    <label for="photo">photo</label>
                                    <input type="file" name="photo" id="photo" placeholder="Your Email" />
                                </div>
                                <div class="form-radio">
                                    <div class="radio">
                                        <label>
                                            <input type="radio" name="gender" value="M" checked="checked" /><i class="check-box"></i>Male
                                        </label>
                                    </div>
                                    <div class="radio">
                                        <label>
                                            <input type="radio" name="gender" value="F" /><i class="check-box"></i>Female
                                        </label>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for=""></label>
                                    <select class="form-control" name="genres" required="required">
                                        <option value="">Genres</option>
                                        <?php foreach ($genre as $val) {
                                            echo   "<option value=" . $val['id'] . ">" . $val['name_genre'] . "</option>";
                                        } ?>
                                    </select>
                                </div>

                                <!-- <div class="checkbox">
							  <label>
								<input type="checkbox" checked="checked"/><i class="check-box"></i>Accept Terms & Conditions ?
							  </label>
							</div> -->
                                <a href="#" title="" class="already-have">Already have an account</a>
                                <div class="submit-btns">
                                    <button class="mtr-btn" type="submit"><span>Register</span></button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="<?php echo base_url() . 'theme/' ?>js/main.min.js"></script>
    <script src="<?php echo base_url() . 'theme/' ?>js/script.js"></script>
</body>
</html>