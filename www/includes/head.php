<?php
// *** Start the session
@session_start();

require_once('Connections/qualitat_ado.php');

require_once("includes/logout.php");

$currentPage = $_SERVER["PHP_SELF"];
?>
<script language="JavaScript" type="text/JavaScript">
<!--
function MM_callJS(jsStr) { //v2.0
  return eval(jsStr)
}
//-->
</script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

<div class="container">
  <div class="row">
    <div class="col-sm-2">
      <img height="80" src="images/qualitat-curvas-sombra-exp.png" class="rounded float-left" alt="QSoftware.biz">
    </div>
  </div>
  <div class="row">
    <div class="col-12">
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
  <a class="navbar-brand" href="#">QMedic</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link" href="sistema.php"><i class="fa fa-fw fa-home"></i> Principal <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="sistema.php">Pacientes</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="listarDiagnostico.php">Diagnósticos</a>
      </li>

      <li class="nav-item">
        <a class="nav-link" href="<?php echo $logoutAction ?>"> <i class="fa fa-fw fa-user"></i> Cerrar Sesión</a>
      </li>
      <li class="nav-item">
        <div class="dropdown-divider"> - </div>
      </li>
      <li class="nav-item">
        <a href="#" onClick="MM_callJS('history.back(-1);')"><i style="color:black" class="fa fa-fw fa-angle-double-left"></i></a>
      </li>
      <li class="nav-item">
        <a href="#" onClick="MM_callJS('history.forward(1);')"><i style="color:black" class="fa dark fa-angle-double-right""></i></a>
      </li>
    </ul>
    <form class="form-inline my-2 my-lg-0" method="post" action="sistema.php">
      <input class="form-control mr-sm-2" type="search" name="nombre" id="nombre" placeholder="Buscar" aria-label="Buscar">
      <button class="btn btn-outline-dark my-2 my-sm-0" type="submit">Buscar</button>
    </form>
  </div>
</nav>
    </div>
  </div>
</div>




