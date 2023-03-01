<link href="css/bootstrap.min.css" rel="stylesheet"/>
<script src="js/bootstrap.min.js"></script>
  <div class="dropdown-menu">
  <span class="dropdown-item-text"><?php echo date("Y-m-d / H:i:s"); ?></span>
  <div class="dropdown-divider"></div>
  <a class="dropdown-item" href="nuevoPaciente.php">Nuevo Paciente</a>
  <div class="dropdown-divider"></div>
  <a class="dropdown-item" href="sistema.php?action=buscar">Buscar Paciente</a>
  <div class="dropdown-divider"></div>
  <a class="dropdown-item" href="#">Something else here</a>
  <div class="dropdown-divider"></div>
  <p><strong>Usuario: <?php echo $_SESSION['MM_Username']; ?></strong></p>
</div>

