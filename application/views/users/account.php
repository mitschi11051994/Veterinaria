<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Account</title>
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
        <li><a href="<?php echo base_url(); ?>users/logout" class="logoutBtn">Logout</a></li>
        <li><a>Welcome <?php echo $user['name']; ?>!<a></li>
      </ul>
    </div>
  </div>
</nav>

<div  class="container">

  <div  class="row">
  <div class="panel panel-success" style="width: 57em; height: 28em; margin-left: 13em; padding: 2em; margin-top: 2em;" >

  <div  class="panel-heading" style="width: 52em; height: 12em;">

      <img class="profile-img" src="https://s-media-cache-ak0.pinimg.com/564x/04/a2/6a/04a26aec29172cc84951c6f27540f35b.jpg" style="width: 150px; height: 10em; margin-left: 21em; margin-top: 5px; padding-top: -1em; padding-bottom: -1em; border-radius: 20%; border-radius: 20%;">

      <div class="panel-body" style="width: 50em; margin-left: 0em; margin-top: 4em;  padding: 5px 10px;">  
      <div>      
        <div class="form-group">
            <a href="<?php echo base_url(); ?>users/information_animals"> <input style="background-color: #20B2AA;" type="button" name="Crud_user_animal" type="submit" value="Information Animals" class="btn btn-primary btn-lg btn-block"></input></a>
        </div>
        <div class="form-group">
              <a href="<?php echo base_url(); ?>users/new_case_file"> <input style="background-color: #20B2AA;" type="button" name="Crud_user_animal" type="submit" value="New Case File" class="btn btn-primary btn-lg btn-block"></input></a>
        </div
        
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
