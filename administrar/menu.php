 <?php
if (!isset($_SESSION)) {
    session_start();
}
if (!isset($_SESSION['usuario'])) {
    echo 'Acceso denegado';
    exit();
}
$data=$_SESSION['usuario'];
$url = '';
$polizas =$_SESSION['notificacion'];
$cantidad= count($polizas);
 ?>
<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
            <img src="<?php echo $url;?>/recursos/app/img/avatar5.png" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
            <p><?php echo $data['nombres']; ?></p>
          <a href="#"><i class="fa fa-circle text-success"></i> Activo</a>
        </div>
      </div>

      <!-- /.search form -->
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu">
        <li class="header">MENU DE NAVEGACION</li>

        <li class="treeview">
            <a href="<?php echo $url;?>/administrar/importar.php">
            <i class="fa fa-files-o"></i>
            <span>Importar</span>
            <span class="pull-right-container">
            </span>
          </a>
        </li>
        <li class="treeview">
          <a href="<?php echo $url; ?>/administrar/contratos.php"">
            <i class="glyphicon glyphicon-list-alt"></i> <span>Contratos</span>
          </a>
        </li>
          <li class="treeview">
              <a href="<?php echo $url; ?>/administrar/personas.php"">
              <i class="glyphicon glyphicon-user"></i> <span>Personas</span>
              </a>
          </li>
        <li>
          <a href="<?php echo $url; ?>/administrar/notificaciones.php">
            <i class="fa fa-calendar"></i> <span>Notificaciones</span>
            <span class="pull-right-container">
                <small class="label pull-right bg-red"><?php echo $cantidad; ?></small>
            </span>
          </a>
        </li>
          <li class="treeview">
              <a href="<?php echo $url;?>/administrar/manual.php">
                  <i class="glyphicon glyphicon-tasks"></i>
                  <span>Manual</span>
                  <span class="pull-right-container">
            </span>
              </a>
          </li>
   
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>