<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Consult Disease </title>
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
    <div class="panel panel-success" style="width: 90em; height: 50em; margin-left: -3em; padding: 2em; margin-top: -1em;" >
      <div  class="panel-heading" style="width: 86em; height: 8em;">

        <img class="profile-img" src="https://s-media-cache-ak0.pinimg.com/564x/04/a2/6a/04a26aec29172cc84951c6f27540f35b.jpg" style="width: 95px; height: 6em; margin-left: 2em; margin-top: 5px; padding-top: -1em; padding-bottom: -1em; border-radius: 20%; border-radius: 20%;">

        <div class="panel-body" style="width: 50em; margin-left: 0em; margin-top: 4em;  padding: 5px 10px;"> 
          <h1> CONSULT DISEASE </h1>
                   
                  
                  <form style="padding:5px; cursor:pointer;   width:300px; margin: 10px 10px 10px 10px; text-align:left;" action="<?php echo base_url() ?>/<?php ?>" method="post">
                  <p> <a  style="background-color: #20B2AA;" class="btn btn-success" href="<?php echo base_url() ?>pet"> BACK</a>
                  <div class="form-group valid-form">
                          <input type="TEXT" class="form-control" name="nombre" placeholder="NAME PET"  value="" >
                          <?php echo form_error('nombre','<span class="help-block">','</span>'); ?>
                  </div>              

                  <div class="form-group">
                        <input  style="background-color: #20B2AA;" type="submit" class="btn btn-success" name="SumitConsult" value="Consult" />
                  </div> 
                  </form>

                  

                    <?php if (count($consulta)): ?>
                        <table style="width: 72em;" class="table tableborder">
                            <thead>
                                <tr>
                                    <th scope="col">Código Mascota</th>
                                    <th scope="col">Codigo Enfermedad</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php
                                if($Consult){
                                foreach ($consulta as $item){
                                ?>
                                  <tr>
                                    <td style="width: 35%"> <?php echo $item->cod_mascota ?></td>
                                    <td style="width: 35%"> <?php echo $item->cod_enfermedad?> </td>

                                    
                                  </tr>
                                <?php
                                }
                               }
                                ?>                                
                            </tbody>
                        </table>
                    <?php else: ?>
                        <p> No hay owner </p>
                    <?php endif; ?>



        </div>
     </div>
  </div>
</div>
</div>
</body>
</html>
