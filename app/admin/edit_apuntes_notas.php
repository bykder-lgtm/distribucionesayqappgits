<?php include('../session/funciones_apuntes_notas.php')?>
<?php include('../conexiones/conexione_apuntes_notas.php')?>
<?php $get_id = $_GET['edit']; ?>
<?php

 //********************Updation********************
    if(isset($_POST['update'])){

        $nombre_nota_observacion=mysqli_real_escape_string($conn,$_POST['nombre_nota_observacion']);
        $descripcion_nota_observacion=mysqli_real_escape_string($conn,$_POST['descripcion_nota_observacion']);

        // make sql query
        $query = "UPDATE tbl15_nota_observacion SET nombre_nota_observacion=\"$nombre_nota_observacion\",descripcion_nota_observacion=\"$descripcion_nota_observacion\" WHERE cod_nota_observacion = \"$get_id\" ";
        if(mysqli_query($conn, $query)) {
        	echo "<script>alert('Note Updated Successfully');</script>";
      		echo "<script type='text/javascript'> document.location = '../admin/lista_apuntes_notas.php'; </script>";
        }else{
            //failure
            echo 'query error: '. mysqli_error($conn);
        }
    }
    //********************Selection********************
     $query = "SELECT cod_nota_observacion,nombre_nota_observacion,descripcion_nota_observacion,fecha_ymd FROM tbl15_nota_observacion WHERE cod_nota_observacion = \"$get_id\" ";

    if(mysqli_query($conn, $query)){
        // get the query result
        $result = mysqli_query($conn, $query);
        // fetch result in array format
        $notesArray= mysqli_fetch_all($result , MYSQLI_ASSOC);
        // print_r($notesArray);
    } else {
        //failure
        echo 'query error: '. mysqli_error($conn);
    }
?>

<!DOCTYPE html>
<html lang="en" class="app">
<head>
  <meta charset="utf-8" />
  <title>Apuntes Notas | App</title>
  <meta name="description" content="app, web app, responsive, admin dashboard, admin, flat, flat ui, ui kit, off screen nav" />
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" /> 
  <link rel="stylesheet" href="../estilo_css/bootstrap_apuntes_notas.css" type="text/css" />
  <link rel="stylesheet" href="../estilo_css/animate_apuntes_notas.css" type="text/css" />
  <link rel="stylesheet" href="../estilo_css/font-awesome.min_apuntes_notas.css" type="text/css" />
  <link rel="stylesheet" href="../estilo_css/font_apuntes_notas.css" type="text/css" />
  
  <link rel="stylesheet" href="../estilo_css/app_apuntes_notas.css" type="text/css" />
  <!--[if lt IE 9]>
    <script src="../js/ie/html5shiv.js"></script>
    <script src="../js/ie/respond.min.js"></script>
    <script src="../js/ie/excanvas.js"></script>
  <![endif]-->
</head>
<body>
  <section class="vbox">
    <header class="bg-dark dk header navbar navbar-fixed-top-xs">
      <div class="navbar-header aside-md">
        <a class="btn btn-link visible-xs" data-toggle="class:nav-off-screen,open" data-target="#nav,html">
          <i class="fa fa-bars"></i>
        </a>
        <a href="#" class="navbar-brand" data-toggle="fullscreen"><img src="../imagenes/logo.png" class="m-r-sm">Apuntes</a>
        <a class="btn btn-link visible-xs" data-toggle="dropdown" data-target=".nav-user">
          <i class="fa fa-cog"></i>
        </a>
      </div>
      <ul class="nav navbar-nav navbar-right m-n hidden-xs nav-user">
        <li class="dropdown">
          <?php $query= mysqli_query($conn,"select * from register where user_ID = '$session_id'")or die(mysqli_error());
                $row = mysqli_fetch_array($query);
            ?>

          <a href="#" class="dropdown-toggle" data-toggle="dropdown">
            <span class="thumb-sm avatar pull-left">
              <img src="../imagenes/profile.jpg">
            </span>
            <?php echo $row['fullName']; ?> <b class="caret"></b>
          </a>
          <ul class="dropdown-menu animated fadeInRight">
            <span class="arrow top"></span>
            <li class="divider"></li>
            <li>
              <a href="../session/salir_apuntes_notas.php" data-toggle="ajaxModal" >Salir</a>
            </li>
          </ul>
        </li>
      </ul>      
    </header>
    <section>
      <section class="hbox stretch">
        <!-- .aside -->
        <aside class="bg-dark lter aside-md hidden-print" id="nav">          
          <section class="vbox">
            <section class="w-f scrollable">
              <div class="slim-scroll" data-height="auto" data-disable-fade-out="true" data-distance="0" data-size="5px" data-color="#333333">
                
                <!-- nav -->
                <nav class="nav-primary hidden-xs">
                  <ul class="nav">
                    <li  class="active">
                      <a href="../admin/lista_apuntes_notas.php" class="active">
                        <i class="fa fa-pencil icon">
                          <b class="bg-info"></b>
                        </i>
                        <span>Apuntes</span>
                      </a>
                    </li>
                  </ul>
                </nav>
                <!-- / nav -->
              </div>
            </section>
            
            <footer class="footer lt hidden-xs b-t b-dark">
              <div id="invite" class="dropup">                
                <section class="dropdown-menu on aside-md m-l-n">
                  <section class="panel bg-white">
                    <header class="panel-heading b-b b-light">
                      <?php //$query= mysqli_query($conn,"select * from register where user_ID = '$session_id'")or die(mysqli_error());
                        //$row = mysqli_fetch_array($query);
                      ?>
                      <?php echo" Usuario sesion"; ?> <i class="fa fa-circle text-success"></i>
                    </header>
                    <div class="panel-body animated fadeInRight">
                      <p><a href="#" target="_blank" class="btn btn-sm btn-facebook"><i class="fa fa-fw fa-youtube"></i> Invite from Youtube</a></p>
                    </div>
                  </section>
                </section>
              </div>
              <a href="#nav" data-toggle="class:nav-xs" class="pull-right btn btn-sm btn-dark btn-icon">
                <i class="fa fa-angle-left text"></i>
                <i class="fa fa-angle-right text-active"></i>
              </a>
              <div class="btn-group hidden-nav-xs">
                <button type="button" title="Contacts" class="btn btn-icon btn-sm btn-dark" data-toggle="dropdown" data-target="#invite"><i class="fa fa-youtube"></i></button>
              </div>
            </footer>
          </section>
        </aside>
        <!-- /.aside -->
        <section id="content">
          <section class="hbox stretch">
                  <aside class="aside-lg bg-light lter b-r">
                    <div class="wrapper">
                      <h4 class="m-t-none">Add Note</h4>
                      <form method="POST">
                      	<?php
						$query = mysqli_query($conn,"select * from tbl15_nota_observacion where cod_nota_observacion = '$get_id' ")or die(mysqli_error());
						$row = mysqli_fetch_array($query);
						?>
                        <div class="form-group">
                          <label>Titulo</label>
                          <input name="nombre_nota_observacion" type="text" placeholder="Titulo" class="input-sm form-control" value="<?php echo $row['nombre_nota_observacion']; ?>">
                        </div>
                        <div class="form-group">
                          <label>Descripcion</label>
                          <textarea name="descripcion_nota_observacion" class="form-control" rows="8" data-minwords="8" data-required="true" placeholder="Descripcion......"><?php echo $row['descripcion_nota_observacion']; ?></textarea>
                        </div>
                        <div class="m-t-lg"><button class="btn btn-sm btn-default" name="update" type="submit">Actualizar</button></div>
                      </form>
                    </div>
                </aside>
                <aside class="bg-white">
                  <section class="vbox">
                    <header class="header bg-light bg-gradient">
                      <ul class="nav nav-tabs nav-white">
                        <li class="active"><a href="#activity" data-toggle="tab"><h4 style = "text-transform:uppercase;"><b>Note Details</b></h4></a></li>
                      </ul>
                    </header>
                    <section class="scrollable">
                      <div class="tab-content">
                        <div class="tab-pane active" id="activity">
                          <ul class="list-group no-radius m-b-none m-t-n-xxs list-group-lg no-border">
                            <li></li>
                            <?php foreach($notesArray as $note){ ?>
                            <li class="list-group-item">
                                <h3 style = "text-transform:uppercase;"><b><?php echo $note['nombre_nota_observacion'] ?></b></h3>
                                <p style="font-size:18px;"><?php echo $note['descripcion_nota_observacion']; ?> </p>
                                
                                <?php } ?>
                            </li>
                          </ul>
                        </div>
                        <div class="tab-pane" id="events">
                          <div class="text-center wrapper">
                            <i class="fa fa-spinner fa fa-spin fa fa-large"></i>
                          </div>
                        </div>
                        <div class="tab-pane" id="interaction">
                          <div class="text-center wrapper">
                            <i class="fa fa-spinner fa fa-spin fa fa-large"></i>
                          </div>
                        </div>
                      </div>
                    </section>
                  </section>
                </aside>
                <aside class="col-lg-4 b-l">
                  <section class="vbox">
                    <section class="scrollable">
                      <div class="wrapper">
                        <section class="panel panel-default">
                          <?php
                             $get_note = mysqli_query($conn,"select * from tbl15_nota_observacion WHERE cod_nota_observacion = \"$get_id\"") or die(mysqli_error());
                             while ($row = mysqli_fetch_array($get_note)) {
                             $id = $row['cod_nota_observacion'];
                                 ?>
                          <h4 style = "text-transform:uppercase;" class="font-thin padder"><b><?php echo $row['nombre_nota_observacion']; ?></b></h4>
                          <ul class="list-group">
                            <li class="list-group-item">
                                <p><?php echo $note['descripcion_nota_observacion']; ?></p>
                                <small class="block text-muted text-info"><i class="fa fa-clock-o text-info"></i> <?php echo $note['fecha_ymd'] ?></small>
                            </li>
                          </ul>
                          <?php } ?> 
                        </section>
                        <section class="panel clearfix bg-info lter">
                          <div class="panel-body">
                            <a href="#" class="thumb pull-left m-r">
                              <img src="../imagenes/profile.jpg" class="img-circle">
                            </a>
                            <div class="clear">
                              <a href="https://www.youtube.com/channel/UCGnh6Xo-GhfNw4q7w9z1YxA/playlists" target="_blank" class="text-info">@CodeLytical <i class="fa fa-twitter"></i></a>
                              <small class="block text-muted">2,415 followers / 225 tweets</small>
                              <a href="#" class="btn btn-xs btn-success m-t-xs">Subscribe</a>
                            </div>
                          </div>
                        </section>
                      </div>
                    </section>
                  </section>              
                </aside>
          </section>
          <a href="#" class="hide nav-off-screen-block" data-toggle="class:nav-off-screen" data-target="#nav"></a>
        </section>
        <aside class="bg-light lter b-l aside-md hide" id="notes">
          <div class="wrapper">Notification</div>
        </aside>
      </section>
    </section>
  </section>
  <script src="../js/jquery.min_apuntes_notas.js"></script>
  <!-- Bootstrap -->
  <script src="../js/bootstrap_apuntes_notas.js"></script>
  <!-- App -->
  <script src="../js/app_apuntes_notas.js"></script>
  <script src="../js/app.plugin_apuntes_notas.js"></script>
  <script src="../js/slimscroll/jquery.slimscroll.min_apuntes_notas.js"></script>
  <script src="../js/libs/underscore-min_apuntes_notas.js"></script>
<script src="../js/libs/backbone-min_apuntes_notas.js"></script>
<script src="../js/libs/backbone.localStorage-min_apuntes_notas.js"></script>  
<script src="../js/libs/moment.min_apuntes_notas.js"></script>
<!-- Notes -->
<script src="../js/apps/notes_apuntes_notas.js"></script>

</body>
</html>