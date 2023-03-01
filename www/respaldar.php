<?php
/*
// Create the mysql backup file
// edit this section
$dbhost = "yourhost"; // usually localhost
$dbuser = "yourusername";
$dbpass = "yourpassword";
$dbname = "yourdb";
$sendto = "Webmaster <webmaster@yourdomain.com>";
$sendfrom = "Automated Backup <backup@yourdomain.com>";
$sendsubject = "Daily Mysql Backup";
$bodyofemail = "Here is the daily backup.";
// don't need to edit below this section

$backupfile = $dbname . date("Y-m-d") . '.sql';
system("mysqldump -h $dbhost -u $dbuser -p$dbpass $dbname > $backupfile");

// Mail the file

    include('Mail.php');
    include('Mail/mime.php');

	$message = new Mail_mime();
	$text = "$bodyofemail";
	$message->setTXTBody($text);
	$message->AddAttachment($backupfile);
    	$body = $message->get();
        $extraheaders = array("From"=>"$sendfrom", "Subject"=>"$sendsubject");
        $headers = $message->headers($extraheaders);
    $mail = Mail::factory("mail");
    $mail->send("$sendto", $headers, $body);

// Delete the file from your server
unlink($backupfile);
*/
?>

<html>
  <head>
    <title>Respaldar Base de Datos</title>
    <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
    <link href="css/bootstrap.min.css" rel="stylesheet"/>
    <script src="js/bootstrap.min.js"></script>
    <script type="text/javascript">
        function cerrarVentana(){
        //la referencia de la ventana es el objeto window del popup. Lo utilizo para acceder al m�todo close
        //respaldo.close()
          window.child.close(respaldo);
        //function MM_openBrWindow(theURL,winName,features) { //v2.0
          //window.open(theURL,winName,features);
        } 
      </script>

  </head>

<body>
<?php require("includes/head.php"); ?>

<blockquote>
  <blockquote>
    <table width="100%" cellpadding="3" cellspacing="0">
      <tr>
        <td class="h2">Respaldo de la base de datos del sistema</td>
      </tr>
      <tr>
        <td >
          <br />
        <div class="container">
          <div class="row justify-content-md-center">
            <div class="col col-lg-6">
              <a href="sistema.php" class="btn btn-dark">Regresar al INICIO</a>
            </div>
            <div class="col col-lg-6">
            <a class="btn btn-dark" href="#" onClick="MM_openBrWindow('comandoResp.php','respaldo','scrollbars=yes,resizable=yes,width=250,height=100')">Exportar TODOS los datos de pacientes a un archivo XLS</a>
            </div>
          </div>  
        </div>

        </td>
      </tr>
      <tr>
        <td >&nbsp;</td>
      </tr>
      <tr>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td><p class="sidebarFooter">* Despues de descargar el archivo correctamente, por favor cierre la ventana</p></td>
      </tr>
    </table>
    </blockquote>
</blockquote>
<?php require("includes/pie.php"); ?>
</body>
</html>

