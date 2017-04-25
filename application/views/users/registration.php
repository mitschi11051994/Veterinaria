<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Registration</title>
  <link rel="stylesheet" href="<?php echo base_url("assets/css/bootstrap.css"); ?>">
    <link rel="stylesheet" href="<?php echo base_url("assets/css/style.css"); ?>">
</head>
<body>
<nav class="navbar navbar-default" role="navigation">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" href="<?php echo base_url(); ?>home">HOME </a>
      <a class="navbar-brand" href="<?php echo base_url(); ?>">My Pets Veterinary Center</a>

    </div>
    <div class="collapse navbar-collapse" id="navbar1">   
      <ul class="nav navbar-nav navbar-right">      
        <li><a href="<?php echo base_url(); ?>login">Login</a></li>
        <li><a href="<?php echo base_url(); ?>registration">Signup </a></li> 
      </ul>
    </div>
  </div>
</nav>

<div  class="container">
  <div  class="row">
  <div class="panel panel-success" style="width: 57em; height: 44em; margin-left: 13em; padding: 2em; margin-top: 3em; margin-top: -1em;" >

  <div  class="panel-heading">
  		<img class="profile-img" src="https://s-media-cache-ak0.pinimg.com/564x/04/a2/6a/04a26aec29172cc84951c6f27540f35b.jpg" style="width: 150px; height: 150px; margin-left: 18em; margin-top: 5px; padding-top: -1em; padding-bottom: -1em; border-radius: 20%; border-radius: 20%;">
  		
  </div>
		  <div class="panel-body" style="width: 80em; margin-left: -2em;">
		  <div class="col-lg-5 col-lg-offset-2">
	    
		  		<div style="text-align: center;">
		        <form style="padding:5px; cursor:pointer;   width:300px; margin: 10px 10px 10px 10px; text-align:left;" action= "registration" method="post">
		        
					<div class="form-group valid-form">
						<input type="text" class="form-control" name="name" placeholder="Name" required="" value="<?php echo !empty($user['name'])?$user['name']:''; ?>">
									<?php echo form_error('name','<span class="help-block">','</span>'); ?>
					</div>
								
					<div class="form-group has-feedback">
						 <input type="email" class="form-control inputEmail" name="email" placeholder="Email" data-error="That email address is invalid" required="" value="<?php echo !empty($user['email'])?$user['email']:''; ?>">
									<?php echo form_error('email','<span class="help-block">','</span>'); ?>
					</div>
								
					<div class="form-group valid-form">
						<input type="text" class="form-control" name="phone" placeholder="Phone" value="<?php echo !empty($user['phone'])?$user['phone']:''; ?>">
					</div>

					<div class="form-group">
						<input type="password" class="form-control inputPassword" name="password" placeholder="Password" required="">
								  <?php echo form_error('password','<span class="help-block">','</span>'); ?>
					</div>
								
					<div class="form-group">
						<input type="password" class="form-control" data-match=".inputPassword" data-match-error="Whoops, these don't match" name="conf_password" placeholder="Confirm password" required="">
						<?php echo form_error('conf_password','<span class="help-block">','</span>'); ?>
					</div>
								
					<div class="form-group">
						<?php
							if(!empty($user['gender']) && $user['gender'] == 'Female'){
										$fcheck = 'checked="checked"';
										$mcheck = '';
									}else{
										$mcheck = 'checked="checked"';
										$fcheck = '';
									}
						?>
						<div class="radio">
							<label>
								<input type="radio" name="gender" value="Male" <?php echo $mcheck; ?>>
										Male
							</label>
						</div>
						<div class="radio">
							<label>
								<input type="radio" name="gender" value="Female" <?php echo $fcheck; ?>>
										  Female
							</label>
						</div>
					</div>
								
					<div class="form-group">
						<button style="background-color: #20B2AA;" name="regisSubmit" type="submit" value="Sumit" class="btn btn-primary btn-lg btn-block">Register</button>
					</div>
				</form>
				</div>
		       </div>
			</div>
		</div>
	</div>
</div>

<script type="text/javascript" src="<?php echo base_url("assets/js/jquery-1.10.2.js"); ?>"></script>
<script type="text/javascript" src="<?php echo base_url("assets/js/bootstrap.js"); ?>"></script>
</body>
</html>