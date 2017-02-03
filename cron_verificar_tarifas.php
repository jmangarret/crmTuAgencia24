<?php

	//RURIEPE 22/09/2106 - SE INCLUYE ARCHIVO DE CONFIGURACION PARA OBTENER LOS ACCESOS PARA REALILZAR CONEXION CON LA BASE DE DATOS.
	include("config.inc.php");

	//RURIEPE 22/09/2106 - SE CAPTURAN VARIABLES PARA LOS ACCESOS DE CONEXION.
	$user=$dbconfig['db_username'];
	$pass=$dbconfig['db_password'];
	$bd=$dbconfig['db_name'];

	//RURIEPE 22/09/2106 - SE REALIZA CONEXION A LA BASE DE DATOS
	mysql_connect("localhost",$user,$pass);
	mysql_select_db($bd);

	//RURIEPE 23/09/2106 - CAPTURA DE FECHA ACTUAL
	$FechaActual = date("Y-m-d");

	//RURIEPE 23/09/2106 - CONSULTA SQL PARA SABER QUE TARIFA NO HA SIDO ACTUALIZADA
	$SqlIdTarifaAerea=mysql_query("SELECT act.activityid FROM vtiger_activity AS act
	INNER JOIN vtiger_seactivityrel AS arel ON arel.activityid = act.activityid
	INNER JOIN vtiger_crmentity AS crmen ON crmen.crmid = arel.crmid
	INNER JOIN vtiger_tarifasaereas AS tarea ON tarea.tarifasaereasid = crmen.crmid
	WHERE crmen.modifiedtime < '$FechaActual' AND tarea.activo = 1;");

	//RURIEPE 23/09/2106 - RECORRIDO Y CAPTURA DE LOS RESULTADOS DE LA CONSULTA SQL
	if (mysql_num_rows($SqlIdTarifaAerea) > 0)
	{
		while ($fila = mysql_fetch_array($SqlIdTarifaAerea)) 
		{
			////RURIEPE 23/09/2106 - ARRAY QUE CONTIENE LOS VALORES CAPTURADOS DE LA COSNULTA (SE LE SUMA 1 DADO A QUE EL ID PARA ACTIVAR EL POP UP ES EL DE LA ACTIVIDAD Y NO EL DE LA TARIFA)
   			$IdTarifaAerea= $fila[0];
   			//echo $IdTarifaAerea.'<br>';

   			//RURIEPE 23/09/2106 - ACTUALIZACION DEL STATUS DE LA TABLA vtiger_activity_reminder_popup
   			$UpdatePopUp=mysql_query("UPDATE vtiger_activity_reminder_popup 
   			SET status = 0,
   			date_start = '$FechaActual'
   			WHERE recordid = $IdTarifaAerea");

   			//RURIEPE 23/09/2106 - ACTUALIZACION DE LA FECHA DE COMIENZO Y DE CULMINACION DE LA TAREA EN LA TABLA vtiger_activity
   			$UpdateDateActivity=mysql_query("UPDATE vtiger_activity
   			SET date_start = '$FechaActual',
   			due_date = '$FechaActual '
   			WHERE activityid = $IdTarifaAerea");
		}
	}
?>