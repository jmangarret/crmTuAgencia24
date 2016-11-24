<?php

	//RURIEPE 19/09/2106 - SE INCLUYE ARCHIVO DE CONFIGURACION PARA OBTENER LOS ACCESOS PARA REALILZAR CONEXION CON L BASE DE DATOS.
	include_once("config.inc.php");

	//RURIEPE 19/09/2106 - SE CAPTURAN VARIABLES PARA LOS ACCESOS DE CONEXION.
	$user=$dbconfig['db_username'];
	$pass=$dbconfig['db_password'];
	$bd=$dbconfig['db_name'];

	//RURIEPE 19/09/2106 - SE REALIZA CONEXION A LA BASE DE DATOS
	mysql_connect("localhost",$user,$pass);
	mysql_select_db($bd);

	//RURIEPE 19/09/2106 - FUNCION PARA INSERTAR VALORES A LA BASE DE DATOS
	function crearActividad($user,$module,$subject,$activity,$RelId=0)
	{
		//RURIEPE 20/09/2106 - LLAMADO DE PROCEDMIENTO PAR LA CAPTURA DEL ULTIMO ID DE LA TABLA vtiger_crmentity
		$IdCrm=mysql_query("CALL getCrmId();");
		$IdCrm=mysql_query("SELECT @idcrm;");
		$resultIdCrm=mysql_fetch_row($IdCrm);
		$crmId=$resultIdCrm[0];


		//RURIEPE 20/09/2106 - CAPTURA DE LA FECHA Y HORA PARA INGRESAR EN LAS TABLAS QUE LO REQUIERAN
		$fecha_actual=date("Y-m-d h:i:s");
		$fecha_actividad = date("Y-m-d");

		//Seteamos crmEntity / RURIEPE 22/09/2016 - CREACION DE ACTIVIDADE EN CRM ENTITY
		$sqlSetCrm="CALL setCrmEntity('".$module."','".$subject."','".$fecha_actual."',".$crmId.",".$user.")";
		$setCrm=mysql_query($sqlSetCrm);

		//RURIEPE 21/09/2106 - INSERCION EN LA TABLA vtiger_activity
		$registroActivity=mysql_query("INSERT INTO vtiger_activity(
		activityid,
		subject,
		semodule,
		activitytype, 
		date_start,
		due_date,
		time_start,
		time_end,
		sendnotification,
		duration_hours,
		duration_minutes,
		status, 
		eventstatus,
		priority,
		location,
		notime,
		visibility,
		recurringtype)VALUES(
		$crmId,
		'$subject',
		' ',
		'$activity',
		'$fecha_actividad',
		'$fecha_actividad',
		'08:00:00',
		'12:00:00',
		'0',
		' ',
		' ',
		' ',
		' ',
		' ',
		' ',
		'0',
		'Private',
		' ');");

		//RURIEPE 26/09/2106 - INSERCION EN LA TABLA vtiger_activity_reminder
		$registroActivityReminder=mysql_query("INSERT INTO vtiger_activity_reminder(
		activity_id, 
		reminder_time,
		reminder_sent,
		recurringid
		)
		VALUES(
		$crmId,
		0,
		0,
		0);");

		//RURIEPE 21/09/2106 - INSERCION EN LA TABLA vtiger_salesmanactivityrel
		$registroSalesManActivityRel=mysql_query("INSERT INTO vtiger_salesmanactivityrel(
		smid,
		activityid
		)
		VALUES(
		$user,
		$crmId);");

		//RURIEPE 21/09/2106 - INSERCION EN LA TABLA vtiger_activity_reminder_popup
		$registroActivityReminderPopup=mysql_query("INSERT INTO vtiger_activity_reminder_popup(
		semodule, 
		recordid, 
		date_start,
		time_start,
		status
		)
		VALUES(
		'$module',
		$crmId,
		'$fecha_actividad',
		'08:00:00',
		0);");


		//RURIEPE 22/09/2106 - CONDICION PARA EVALUAR SI SE ASIGNO ALGUN VALOR AL PARAMETRO $RelId, SI TIENE UN VALOR ASIGNADO SE EJECUTA EL PROCESO PARA INSERTAR REGISTROS EN LA TABLA vtiger_seactivityrel. SE REALILZA ESTA CONDICION PORQUE NO ES OBLIGATORIO RELACIONAR LOS REGISTROS
		if($RelId != 0)
		{
			//RURIEPE 22/09/2106 - INSERCION EN LA TABLA vtiger_activity_seactivitirel
			$registroSeActivityRel=mysql_query("INSERT INTO vtiger_seactivityrel(
			crmid, 
			activityid)
			VALUES(
			$RelId,
			$crmId);");
		}
	}
?>