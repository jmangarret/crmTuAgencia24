<?php
	error_reporting(E_ALL);
	ini_set('display_errors', '1');
	//RURIEPE 03/10/2016 - CONSULTA E INSERCIONES PARA REALILZAR LA CARGA DE REGISTROS A LAS TABLAS vtiger_crmentity y vtiger_aeropuerto 

	include("config.inc.php");
	//RURIEPE 03/10/2016 - CONEXION A LA BASE DE DATOS
	$user=$dbconfig['db_username'];
	$pass=$dbconfig['db_password'];
	$bd=$dbconfig['db_name'];
	mysql_connect("localhost",$user,$pass);
	mysql_select_db($bd);

	//RURIEPE 03/10/2106 - CAPTURA DE LA FECHA Y HORA ACTUAL 
	$fecha_actual=date("Y-m-d h:i:s");


	$fp = fopen ( "Aeropuertos.csv" , "r" );
	while (( $data = fgetcsv ($fp,100,",")) !== FALSE )
	{
    	
    	$aeropuerto =  $data[0].' - '.ucwords(strtolower($data[1]));
    	$tipo = ucwords(strtolower($data[2]));

		//RURIEPE 03/10/2106 - LLAMADO DE PROCEDMIENTO PAR LA CAPTURA DEL ULTIMO ID DE LA TABLA vtiger_crmentity
		$IdCrm=mysql_query("CALL getCrmId();");
		$IdCrm=mysql_query("SELECT @idcrm;");
		$resultIdCrm=mysql_fetch_row($IdCrm);
		$crmId=$resultIdCrm[0];

        //Seteamos crmEntity / RURIEPE 03/10/2016 - CREACION DE AEROPUERTOS EN vtiger_crmentity
		$sqlSetCrm="CALL setCrmEntity('Aeropuerto','".$aeropuerto."','".$fecha_actual."',".$crmId.",'1')";
		$setCrm=mysql_query($sqlSetCrm);

		//RURIEPE 03/10/2106 - INSERCION EN LA TABLA vtiger_aeropuerto
		$registroAeropuerto=mysql_query("INSERT INTO vtiger_aeropuerto(
		aeropuertoid,
		aeropuerto,
		tipo,
		presence,
		picklist_valueid,
		sortorderid)
		VALUES(
		$crmId,
		'$aeropuerto',
		'$tipo',
		0,
		0,
		0);");

		//RURIEPE 03/10/2106 - INSERCION EN LA TABLA vtiger_aeropuerto
		$registroAeropuertoCf=mysql_query("INSERT INTO vtiger_aeropuertocf(
		aeropuertoid)VALUES($crmId);");
	}
	fclose ( $fp );

	echo "Creado los registros";


	
?>
		
