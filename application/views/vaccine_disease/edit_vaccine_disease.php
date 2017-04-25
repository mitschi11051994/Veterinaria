<DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Edit Vaccine Disease</title>
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
  <div class="panel panel-success" style="width: 57em; height: 44em; margin-left: 13em; padding: 2em; margin-top: 3em; margin-top: -1em;" >

  <div  class="panel-heading">
      <img class="profile-img" src="https://s-media-cache-ak0.pinimg.com/564x/04/a2/6a/04a26aec29172cc84951c6f27540f35b.jpg" style="width: 150px; height: 150px; margin-left: 18em; margin-top: 5px; padding-top: -1em; padding-bottom: -1em; border-radius: 20%; border-radius: 20%;">
      
  </div>
      <div class="panel-body" style="width: 80em; margin-left: -2em;">
      <div class="col-lg-5 col-lg-offset-2">      
          <div style="text-align: center;">
            <form style="padding:5px; cursor:pointer;   width:300px; margin: 10px 10px 10px 10px; text-align:left;" action="" method="post">

                  <?php foreach ($vaccine_disease as $item) {?>

                      <div class="form-group valid-form">                      
                      <select  id="combobox_disease" name="combobox_disease" class="form-control">
                          <?php foreach($disease as $each){ ?>
                              <option  value="<?php echo $each->cod_enfermedad; ?>"><?php echo $each->cod_enfermedad; ?></option>';
                          <?php } ?>
                      </select>
                    </div> 

                      <div class="form-group valid-form">                      
                      <select  id="combobox_vaccine" name="combobox_vaccine" class="form-control">
                          <?php foreach($vaccine as $each){ ?>
                              <option  value="<?php echo $each->cod_vacuna; ?>"><?php echo $each->cod_vacuna; ?></option>';
                          <?php } ?>
                      </select>
                    </div>

                    <div class="form-group valid-form">
                      <input type="text" class="form-control" name="porcentaje_efectividad" placeholder="PPORCENTAJE" required="" value="<?php echo $item->porcentaje_efectividad; ?>">
                      <?php echo form_error('porcentaje_efectividad','<span class="help-block">','</span>'); ?>
                    </div>

                    <div class="form-group valid-form">
                      <input type="text" class="form-control" name="notas" placeholder="NOTES" required="" value="<?php echo $item->notas; ?>">
                      <?php echo form_error('notas','<span class="help-block">','</span>'); ?>
                    </div>

                    <div class="form-group">
                      <input  style="background-color: #20B2AA;" type="submit" class="btn btn-success" name="SumitVaccine_diseaseEdit" value="Guardar" />
                        <a class="btn btn-danger" href="<?php echo base_url() ?>vaccine_disease"> Cancelar </a>
                    </div>
                    <?php } ?>
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


<DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Edit Vaccine Disease</title>
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
  <div class="panel panel-success" style="width: 57em; height: 44em; margin-left: 13em; padding: 2em; margin-top: 3em; margin-top: -1em;" >

  <div  class="panel-heading">
      <img class="profile-img" src="https://s-media-cache-ak0.pinimg.com/564x/04/a2/6a/04a26aec29172cc84951c6f27540f35b.jpg" style="width: 150px; height: 150px; margin-left: 18em; margin-top: 5px; padding-top: -1em; padding-bottom: -1em; border-radius: 20%; border-radius: 20%;">
      
  </div>
      <div class="panel-body" style="width: 80em; margin-left: -2em;">
      <div class="col-lg-5 col-lg-offset-2">      
          <div style="text-align: center;">
            <form style="padding:5px; cursor:pointer;   width:300px; margin: 10px 10px 10px 10px; text-align:left;" action="" method="post">

                  <?php foreach ($vaccine_disease as $item) {?>

                  <div class="form-group valid-form">                      
                      <select  id="combobox_disease" name="combobox_disease" class="form-control">
                          <?php foreach($disease as $each){ ?>
                              <option  value="<?php echo $each->cod_enfermedad; ?>"><?php echo $each->cod_enfermedad; ?></option>';
                          <?php } ?>
                      </select>
                    </div> 

                      <div class="form-group valid-form">                      
                      <select  id="combobox_vaccine" name="combobox_vaccine" class="form-control">
                          <?php foreach($vaccine as $each){ ?>
                              <option  value="<?php echo $each->cod_vacuna; ?>"><?php echo $each->cod_vacuna; ?></option>';
                          <?php } ?>
                      </select>
                    </div>                 


                    <div class="form-group valid-form">
                      <input type="text" class="form-control" name="porcentaje_efectividad" placeholder="PERCENTAGE EFFECTIVENESS" required="" value=""<?php echo $item->porcentaje_efectividad; ?>"">
                      <?php echo form_error('porcentaje_efectividad','<span class="help-block">','</span>'); ?>
                    </div>

                    <div class="form-group valid-form">
                      <input type="text" class="form-control" name="notas" placeholder="NOTES" required="" value=""<?php echo $item->notas; ?>"">
                      <?php echo form_error('notas','<span class="help-block">','</span>'); ?>
                    </div>                      

                    <div class="form-group">
                      <input  style="background-color: #20B2AA;" type="submit" class="btn btn-success" name="SumitVaccine_diseaseEdit" value="Guardar" />
                        <a class="btn btn-danger" href="<?php echo base_url() ?>vaccine_disease"> Cancelar </a>
                    </div>
                    <?php } ?>
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