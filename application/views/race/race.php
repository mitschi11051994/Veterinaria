<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Race</title>
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
      
        <div>
        <h1> LIST RACES </h1>
                <p> <a style="background-color: #20B2AA;"  class="btn btn-success" href="<?php echo base_url() ?>information_animals"> BACK</a> 
                <a style="background-color: #20B2AA;" class="btn btn-success" href="<?php echo base_url() ?> race_register"> Create New Races </a> </p>

                    <?php if (count($race)): ?>
                        <table style="width: 72em;" class="table tableborder">
                            <thead>
                                <tr>
                                    <th scope="col">Código Especie</th>
                                    <th scope="col">Descripción</th>
                                    <th scope="col">Especie </th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php
                                foreach ($race as $item){
                                ?>
                                  <tr>
                                    <td style="width: 35%"> <?php echo $item->cod_raza ?></td>
                                    <td style="width: 35%"> <?php echo $item->descripcion?> </td>
                                    <td style="width: 35%"> <?php echo $item->cod_especie?> </td>

                                    <td ><a class="btn btn-info" href="<?php echo base_url() ?>users/editRace/<?php echo $item->cod_raza ?>">Edit</a></td>

                                    <td><a class="btn btn-danger eliminar_race" href="<?php echo base_url() ?>Users/eliminarRace/<?php echo $item->cod_raza ?>"> Eliminar </a> </td>
                                  </tr>
                                <?php
                                }
                                ?>                                
                            </tbody>
                        </table>
                    <?php else: ?>
                        <p> No hay owner </p>
                    <?php endif; ?>
                    <script type="text/javascript">
                        $(".eliminar_race").each(function() {
                            var href = $(this).attr('href');
                            $(this).attr('href', 'javascript:void(0)');
                            $(this).click(function() {
                                if (confirm("¿Seguro desea eliminar este dueo?")) {
                                    location.href = href;
                                }
                            });
                        });
                    </script>
         </div>
       </div>
     </div>
  </div>
</div>



            


<script type="text/javascript" src="<?php echo base_url("assets/js/jquery-1.10.2.js"); ?>"></script>
<script type="text/javascript" src="<?php echo base_url("assets/js/bootstrap.js"); ?>"></script>
</body>
</html>