<?php //PHP ADODB document - made with PHAkt 2.7.2?>
<html>
  <head>
    <title>Ayuda</title>
    <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
    <link href="css/bootstrap.min.css" rel="stylesheet"/>
      <script src="js/bootstrap.min.js"></script>
  </head>

<body>
<table width="355" border="0" cellspacing="0" cellpadding="3">
  <tr>
    <td><a href="#" class="btn btn-secondary" onclick="window.close();">X Cerrar</a></td>
    <td>&nbsp;</td>
  </tr>
</table>
<?php if ($_GET['action']==1){ ?>
<table width="353" border="0" cellspacing="0" cellpadding="3">
  <tr>
    <td width="37">&nbsp;</td>
    <td width="298" class="h2">Contacto</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td><p class="subtitle">Xavier Freire Ortiz</p>
    <p>02 2299 753<br>
      09 9597 697 <br>
      <hr />
      <a class="btn btn-dark" href="mailto:xavier@qsoftware.biz">xavier@qsoftware.biz</a><br>
    </p>    </td>
  </tr>
</table>
<?php } ?>
<?php if ($_GET['action']==2){ ?>
<table width="353" border="0" cellspacing="0" cellpadding="3">
  <tr>
    <td width="37">&nbsp;</td>
    <td width="298" class="h2">Diagn&oacute;sticos</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td><p class="subtitle">CIE 10</p>
        <p>Actualizado 2010/abr<br>
      </p></td>
  </tr>
</table>
<?php } ?>
</body>
</html>