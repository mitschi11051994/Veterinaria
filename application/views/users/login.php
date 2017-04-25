<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Pets Veterinary Center</title>
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
        <li><a href="<?php echo base_url(); ?>signup">Signup</a></li> 
      </ul>
    </div>
  </div>
</nav>

<div  class="container">
  <div  class="row">
  <div class="panel panel-success" style="width: 51em; height: 33em; margin-left: 13em; margin-right: 10em; padding: 3em; margin-top: 3em; ">

  <div  class="panel-heading" style="width: 45em; ">
      <img class="profile-img" src="https://s-media-cache-ak0.pinimg.com/564x/04/a2/6a/04a26aec29172cc84951c6f27540f35b.jpg" style="width: 150px; height: 150px; margin-left: 17em; margin-top: 5px; padding-top: -1em; padding-bottom: -1em;">
      </div>
      <div class="panel-body" style="width: 80em; margin-left: -7em;">
          <div class="col-lg-5 col-lg-offset-2">
              <div class="input-info">
              <?php 
                if(!empty($success_msg)){
                  echo '<p class="statusMsg">'.$success_msg.'</p>';
                }elseif(!empty($error_msg)){
                  echo '<p class="statusMsg">'.$error_msg.'</p>';
                }
              ?>
            </div>
              <form action="" method="post">
                <div class="form-group has-feedback">
                  <input type="email" class="form-control inputEmail" name="email" placeholder="Email" data-error="That email address is invalid" required="" value="">
                  <?php echo form_error('email','<span class="help-block">','</span>'); ?>
                </div>
                <div class="form-group">
                  <input type="password" class="form-control inputPassword" name="password" placeholder="Password" required="">
                  <?php echo form_error('password','<span class="help-block">','</span>'); ?>
                </div>
                <div class="form-group">
                  <button style="background-color: #20B2AA;" name="loginSubmit" type="submit" value="Sumit" class="btn btn-primary btn-lg btn-block">Login</button>
               </div>
              </form>
              </div>              
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

