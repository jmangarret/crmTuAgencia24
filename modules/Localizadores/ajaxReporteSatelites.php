<?php
	//jmangarret 19sept2016 se agrego en.deleted=0 a todos los where para no incluir los eliminados en los querys

	//RURIEPE 05/10/2016 - MODIFICACION DE CONSULTAS PARA QUE SE MUESTREN LOS ANULADOS EN LISTA MAS NO SEAN CONTADOS EN EL TOTAL

	// 24/11/2016 RURIEPE - SE REALILZA SIMPLIFICACION DE CONSULTAS SQL DE 8 CONSULTAS QUE SE REALIZABAN SE REDUJO A 4, DE IGUAL FORMA SE REALIZAN UNIONES EN LAS OPCIONES 1,2 Y 3 PARA OBTENER LOS SOTOS QUE SOLO TENGAN EL REGISTRO DE VENTAS COMPLETO, ASI COMO QUE SE VALIDA QUE EL LOCALIZADOR SE ENCUENTRE RELACIONADO A UN REGISTRO DE VENTAS, EN LA OPCION 4 SOLO SE MOSTRARAN SE TOTALIZARA AQUELLOS BOLETOS QUE TENGAN EL REGISTRO DE VENTAS COMPLETO. SE REALILZA DENTRO DE LAS CONDICIONES DONDE SE TOTALIZAN LOS CONTADORES QUE SI EL REGISTRO DE SERVI Y ES  DIFERENTE DE ANULADO Y LA MONE DEL PROUCTO ES IGUAL A VEF ESTE DESCUENTE ESTE BOLETO DEL TOTAL.

	include("../../config.inc.php");

	$user=$dbconfig['db_username'];
	$pass=$dbconfig['db_password'];
	$bd=$dbconfig['db_name'];
	mysql_connect("localhost",$user,$pass);
	mysql_select_db($bd);

	//SELECT SATELITE
	if ($_REQUEST["accion"]=="select_satelite")
	{
		$query = "SELECT accountid, accountname FROM `vtiger_account` 
		WHERE `account_type` LIKE 'Satelite' ORDER BY accountname ASC ";

		if($filtro = mysql_query($query))
		{
		    if (mysql_num_rows($filtro) > 0)
		    {
		        while ($row = mysql_fetch_array($filtro)) 
		        {	
		        	if ($row["accountname"]!=NULL) {
		        		echo"<option value=".$row["accountid"].">".$row["accountname"]."</option>";
		        	}
		        }
		    }
		}
	}

	//SELECT GDS
	if ($_REQUEST["accion"]=="select_gds")
	{
		$query = "SELECT gds FROM vtiger_gds ORDER BY gds ASC";

		if($filtro = mysql_query($query))
		{
		    if (mysql_num_rows($filtro) > 0)
		    {
		        while ($row = mysql_fetch_array($filtro)) 
		        {	
		        	if ($row["gds"]!=NULL) 
		        	{
		        		echo"<option>".$row["gds"]."</option>";
		        	}
		        }
		    }
		}
	}

	//SELECT ESTATUS
	if ($_REQUEST["accion"]=="select_status")
	{
		$query = "SELECT DISTINCT status FROM vtiger_boletos ORDER BY status ASC";

		if($filtro = mysql_query($query))
		{
		    if (mysql_num_rows($filtro) > 0)
		    {
		        while ($row = mysql_fetch_array($filtro)) 
		        {	
		        	if ($row["status"]!=NULL) 
		        	{
		        		echo"<option>".$row["status"]."</option>";
		        	}
		        }
		    }
		}
	}

	//RURIEPE 26/07/2016 SELECT ASESORAS
	if ($_REQUEST["accion"]=="select_asesoras")
	{
		$query = "SELECT usu.id,usu.first_name,usu.last_name FROM vtiger_users AS usu
		INNER JOIN vtiger_user2role AS u2r ON u2r.userid = usu.id
		WHERE (u2r.roleid = 'H3'  OR u2r.roleid = 'H4' OR u2r.roleid = 'H5' OR u2r.roleid = 'H7') AND status = 'Active' ORDER BY first_name ASC";

		if($filtro = mysql_query($query))
		{
		    if (mysql_num_rows($filtro) > 0)
		    {
		        while ($row = mysql_fetch_array($filtro)) 
		        {	
		        	if ($row["first_name"]!=NULL AND $row["last_name"]!=NULL) {
		        		echo"<option value=".$row["id"].">".$row["first_name"]." ".$row["last_name"]."</option>";
		        	}
		        }
		    }
		}
	}

	$campos="loc.localizadoresid,
	loc.localizador,
	loc.contactoid,
	loc.paymentmethod,
	loc.registrodeventasid,
	loc.procesado,
	loc.gds,bol.amount,
	bol.fecha_emision,
	bol.boleto1,
	bol.boletosid,
	bol.tipodevuelo,
	bol.status,
	bol.currency,
	usu.first_name,
	usu.last_name,
	rdv.registrodeventasname ";

	//RESPONSE LISTAR RESULTADOS DE LA BUSQUEDA
	if ($_REQUEST["accion"]=="listarBusqueda")
	{
		if ($_REQUEST["tventa"] == 1 )
		{
			$else = 1;

			$query="SELECT ".$campos."
			FROM vtiger_localizadores AS loc 
			INNER JOIN vtiger_boletos AS bol ON bol.localizadorid=loc.localizadoresid 
			INNER JOIN vtiger_crmentity AS en ON en.crmid = loc.localizadoresid 
			INNER JOIN vtiger_registrodeventas AS rdv ON rdv.registrodeventasid=loc.registrodeventasid ";

			if ($_REQUEST["satelite"])
				$query.="
				INNER JOIN vtiger_contactdetails AS con ON con.contactid = loc.contactoid
		   		INNER JOIN vtiger_account AS acc ON acc.accountid = con.accountid ";

			$query.="
			INNER JOIN vtiger_users AS usu ON usu.id = en.smownerid
			WHERE en.deleted=0
			AND bol.currency = 'VEF' 
			AND (loc.gds = 'Amadeus' OR  loc.gds = 'Kiu' OR loc.gds = 'Web Aerolinea')";

			if ($_REQUEST["asesoras"])
				$query.=" AND usu.id='".$_REQUEST["asesoras"]."'";
				
			if ($_REQUEST["gds"])
				$query.=" AND loc.gds= '".$_REQUEST["gds"]."' ";

			if ($_REQUEST["procesado"] == '1' OR $_REQUEST["procesado"] == '0' )
				$query.=" AND loc.procesado= '".$_REQUEST["procesado"]."' ";

			if ($_REQUEST["satelite"])
				$query.=" AND acc.accountid= '".$_REQUEST["satelite"]."' ";

			if ($_REQUEST["fecha_desde"] && $_REQUEST["fecha_hasta"])
				$query.=" AND bol.fecha_emision BETWEEN '".$_REQUEST["fecha_desde"]."' AND '".$_REQUEST["fecha_hasta"]."' ";

			if ($_REQUEST["localizador"])
				$query.=" AND loc.localizador LIKE '%".$_REQUEST["localizador"]."%' ";

			if ($_REQUEST["boleto"])
				$query.=" AND bol.boleto1 = '".$_REQUEST["boleto"]."' ";

			if ($_REQUEST["estatus"])
				$query.=" AND bol.status = '".$_REQUEST["estatus"]."' ";
			
			$query.="

			UNION ALL 
			(SELECT ".$campos."
			FROM vtiger_localizadores AS loc 
			INNER JOIN vtiger_boletos AS bol ON bol.localizadorid=loc.localizadoresid 
			INNER JOIN vtiger_registrodeventas AS rdv ON rdv.registrodeventasid=loc.registrodeventasid 
			INNER JOIN vtiger_crmentity AS en ON en.crmid = loc.localizadoresid
			INNER JOIN vtiger_contactdetails AS con ON con.contactid = loc.contactoid ";

			if ($_REQUEST["satelite"])
			$query.="INNER JOIN vtiger_account AS acc ON acc.accountid = con.accountid ";

			$query.="INNER JOIN vtiger_users AS usu ON usu.id = en.smownerid
			WHERE en.deleted=0 
			AND (loc.gds='Servi' OR  loc.gds='Web Aerolinea') 
			AND loc.registrodeventasid
			IN (SELECT registrodeventasid FROM vtiger_registrodeventascf WHERE cf_881 != '' AND cf_861 != '') ";

			if ($_REQUEST["asesoras"])
				$query.=" AND usu.id='".$_REQUEST["asesoras"]."' ";

			if ($_REQUEST["gds"])
				$query.=" AND loc.gds= '".$_REQUEST["gds"]."' ";

			if ($_REQUEST["procesado"] == '1' OR $_REQUEST["procesado"] == '0' )
				$query.=" AND loc.procesado= '".$_REQUEST["procesado"]."' ";

			if ($_REQUEST["satelite"])
				$query.=" AND acc.accountid= '".$_REQUEST["satelite"]."' ";

			if ($_REQUEST["fecha_desde"] && $_REQUEST["fecha_hasta"])
				$query.=" AND bol.fecha_emision BETWEEN '".$_REQUEST["fecha_desde"]."' AND '".$_REQUEST["fecha_hasta"]."'";

			if ($_REQUEST["localizador"])
				$query.=" AND loc.localizador LIKE '%".$_REQUEST["localizador"]."%' ";

			if ($_REQUEST["boleto"])
				$query.=" AND bol.boleto1 = '".$_REQUEST["boleto"]."' ";

			if ($_REQUEST["estatus"])
				$query.=" AND bol.status = '".$_REQUEST["estatus"]."'";
				$query.=") ORDER BY fecha_emision DESC ";
		}
		else if ($_REQUEST["tventa"] == 2 )
		{

			$else=1;

			$query="SELECT ".$campos."
			FROM vtiger_localizadores AS loc 
			INNER JOIN vtiger_boletos AS bol ON bol.localizadorid=loc.localizadoresid 
			INNER JOIN vtiger_crmentity AS en ON en.crmid = loc.localizadoresid
			INNER JOIN vtiger_users AS usu ON usu.id = en.smownerid
			INNER JOIN vtiger_registrodeventas AS rdv ON rdv.registrodeventasid=loc.registrodeventasid 
			WHERE en.deleted=0 
			AND (contactoid IS NULL 
			OR contactoid='' 
			OR contactoid IN (SELECT contactid FROM vtiger_contactdetails 
			WHERE isSatelite IS NULL OR isSatelite='0' OR isSatelite='')) 
			AND bol.currency = 'VEF' 
			AND (loc.gds = 'Amadeus' OR loc.gds = 'Kiu' OR loc.gds = 'Web Aerolinea') ";

			if ($_REQUEST["asesoras"])
				$query.=" AND usu.id='".$_REQUEST["asesoras"]."' ";

			if ($_REQUEST["gds"])
				$query.=" AND loc.gds= '".$_REQUEST["gds"]."' ";

			if ($_REQUEST["procesado"] == '1' OR $_REQUEST["procesado"] == '0' )
				$query.=" AND loc.procesado= '".$_REQUEST["procesado"]."' ";

			if ($_REQUEST["fecha_desde"] && $_REQUEST["fecha_hasta"])
				$query.=" AND bol.fecha_emision BETWEEN '".$_REQUEST["fecha_desde"]."' AND '".$_REQUEST["fecha_hasta"]."' ";

			if ($_REQUEST["localizador"])
				$query.=" AND loc.localizador LIKE '%".$_REQUEST["localizador"]."%' ";

			if ($_REQUEST["boleto"])
				$query.=" AND bol.boleto1 = '".$_REQUEST["boleto"]."' ";

			if ($_REQUEST["estatus"])
				$query.=" AND bol.status = '".$_REQUEST["estatus"]."'";

			$query.="

			UNION ALL 
			(SELECT ".$campos."
			FROM vtiger_localizadores AS loc 
			INNER JOIN vtiger_boletos AS bol ON bol.localizadorid=loc.localizadoresid 
			INNER JOIN vtiger_registrodeventas AS rdv ON rdv.registrodeventasid=loc.registrodeventasid 
			INNER JOIN vtiger_crmentity AS en ON en.crmid = loc.localizadoresid
			INNER JOIN vtiger_contactdetails AS con ON con.contactid = loc.contactoid ";

			if ($_REQUEST["satelite"])
			$query.="INNER JOIN vtiger_account AS acc ON acc.accountid = con.accountid ";

			$query.="INNER JOIN vtiger_users AS usu ON usu.id = en.smownerid
			WHERE en.deleted=0 
			AND (contactoid IS NULL 
			OR contactoid='' 
			OR contactoid IN (SELECT contactid FROM vtiger_contactdetails 
			WHERE isSatelite IS NULL OR isSatelite='0' OR isSatelite=''))
			AND (loc.gds='Servi' OR  loc.gds='Web Aerolinea') 
			AND loc.registrodeventasid
			IN (SELECT registrodeventasid FROM vtiger_registrodeventascf WHERE cf_881 != '' AND cf_861 != '') ";

			if ($_REQUEST["asesoras"])
				$query.=" AND usu.id='".$_REQUEST["asesoras"]."' ";

			if ($_REQUEST["gds"])
				$query.=" AND loc.gds= '".$_REQUEST["gds"]."' ";

			if ($_REQUEST["procesado"] == '1' OR $_REQUEST["procesado"] == '0' )
				$query.=" AND loc.procesado= '".$_REQUEST["procesado"]."' ";

			if ($_REQUEST["satelite"])
				$query.=" AND acc.accountid= '".$_REQUEST["satelite"]."' ";

			if ($_REQUEST["fecha_desde"] && $_REQUEST["fecha_hasta"])
				$query.=" AND bol.fecha_emision BETWEEN '".$_REQUEST["fecha_desde"]."' AND '".$_REQUEST["fecha_hasta"]."'";

			if ($_REQUEST["localizador"])
				$query.=" AND loc.localizador LIKE '%".$_REQUEST["localizador"]."%' ";

			if ($_REQUEST["boleto"])
				$query.=" AND bol.boleto1 = '".$_REQUEST["boleto"]."' ";

			if ($_REQUEST["estatus"])
				$query.=" AND bol.status = '".$_REQUEST["estatus"]."'";
				$query.=") ORDER BY fecha_emision DESC ";
		}
		else if ($_REQUEST["tventa"] == 3)
		{
			$else=1;

			$query="SELECT ".$campos."
			FROM vtiger_localizadores AS loc 
			INNER JOIN vtiger_boletos AS bol ON bol.localizadorid=loc.localizadoresid 
			INNER JOIN vtiger_crmentity AS en ON en.crmid = loc.localizadoresid
			INNER JOIN vtiger_contactdetails AS con ON con.contactid = loc.contactoid
			INNER JOIN vtiger_registrodeventas AS rdv ON rdv.registrodeventasid = loc.registrodeventasid ";
			
			if ($_REQUEST["satelite"])
			$query.="INNER JOIN vtiger_account AS acc ON acc.accountid = con.accountid ";

			$query.="INNER JOIN vtiger_users AS usu ON usu.id = en.smownerid
			WHERE en.deleted=0 
			AND con.isSatelite='1' 
			AND bol.currency = 'VEF' 
			AND (loc.gds = 'Amadeus' OR  loc.gds = 'Kiu' OR loc.gds = 'Web Aerolinea')";

			if ($_REQUEST["asesoras"])
				$query.=" AND usu.id='".$_REQUEST["asesoras"]."' ";

			if ($_REQUEST["gds"])
				$query.=" AND loc.gds= '".$_REQUEST["gds"]."' ";

			if ($_REQUEST["procesado"] == '1' OR $_REQUEST["procesado"] == '0' )
				$query.=" AND loc.procesado= '".$_REQUEST["procesado"]."' ";

			if ($_REQUEST["satelite"])
				$query.=" AND acc.accountid= '".$_REQUEST["satelite"]."' ";

			if ($_REQUEST["fecha_desde"] && $_REQUEST["fecha_hasta"])
				$query.=" AND bol.fecha_emision BETWEEN '".$_REQUEST["fecha_desde"]."' AND '".$_REQUEST["fecha_hasta"]."' ";

			if ($_REQUEST["localizador"])
				$query.=" AND loc.localizador LIKE '%".$_REQUEST["localizador"]."%' ";

			if ($_REQUEST["boleto"])
				$query.=" AND bol.boleto1 = '".$_REQUEST["boleto"]."' ";

			if ($_REQUEST["estatus"])
				$query.=" AND bol.status = '".$_REQUEST["estatus"]."' ";
				
			$query.="

			UNION ALL 
			(SELECT ".$campos."
			FROM vtiger_localizadores AS loc 
			INNER JOIN vtiger_boletos AS bol ON bol.localizadorid=loc.localizadoresid 
			INNER JOIN vtiger_registrodeventas AS rdv ON rdv.registrodeventasid=loc.registrodeventasid 
			INNER JOIN vtiger_crmentity AS en ON en.crmid = loc.localizadoresid
			INNER JOIN vtiger_contactdetails AS con ON con.contactid = loc.contactoid ";

			if ($_REQUEST["satelite"])
			$query.="INNER JOIN vtiger_account AS acc ON acc.accountid = con.accountid ";

			$query.="INNER JOIN vtiger_users AS usu ON usu.id = en.smownerid
			WHERE en.deleted=0 
			AND con.isSatelite='1'
			AND (loc.gds='Servi' OR  loc.gds='Web Aerolinea') 
			AND loc.registrodeventasid
			IN (SELECT registrodeventasid FROM vtiger_registrodeventascf WHERE cf_881 != '' AND cf_861 != '') ";

			if ($_REQUEST["asesoras"])
				$query.=" AND usu.id='".$_REQUEST["asesoras"]."' ";

			if ($_REQUEST["gds"])
				$query.=" AND loc.gds= '".$_REQUEST["gds"]."' ";

			if ($_REQUEST["procesado"] == '1' OR $_REQUEST["procesado"] == '0' )
				$query.=" AND loc.procesado= '".$_REQUEST["procesado"]."' ";

			if ($_REQUEST["satelite"])
				$query.=" AND acc.accountid= '".$_REQUEST["satelite"]."' ";

			if ($_REQUEST["fecha_desde"] && $_REQUEST["fecha_hasta"])
				$query.=" AND bol.fecha_emision BETWEEN '".$_REQUEST["fecha_desde"]."' AND '".$_REQUEST["fecha_hasta"]."'";

			if ($_REQUEST["localizador"])
				$query.=" AND loc.localizador LIKE '%".$_REQUEST["localizador"]."%' ";

			if ($_REQUEST["boleto"])
				$query.=" AND bol.boleto1 = '".$_REQUEST["boleto"]."' ";

			if ($_REQUEST["estatus"])
				$query.=" AND bol.status = '".$_REQUEST["estatus"]."'";
				$query.=") ORDER BY fecha_emision DESC ";
		}
		else if ($_REQUEST["tventa"] == 4)
		{
			$else=1;

			$query="SELECT ".$campos."
			FROM vtiger_localizadores AS loc 
			INNER JOIN vtiger_boletos AS bol ON bol.localizadorid=loc.localizadoresid 
			INNER JOIN vtiger_registrodeventas AS rdv ON rdv.registrodeventasid=loc.registrodeventasid 
			INNER JOIN vtiger_crmentity AS en ON en.crmid = loc.localizadoresid
			INNER JOIN vtiger_contactdetails AS con ON con.contactid = loc.contactoid ";

			if ($_REQUEST["satelite"])
			$query.="INNER JOIN vtiger_account AS acc ON acc.accountid = con.accountid ";

			$query.="
			INNER JOIN vtiger_users AS usu ON usu.id = en.smownerid
			WHERE en.deleted=0 
			AND (loc.gds='Servi' OR  loc.gds='Web Aerolinea')
			AND bol.currency = 'USD' 
			AND loc.registrodeventasid 
			IN (SELECT registrodeventasid FROM vtiger_registrodeventascf WHERE cf_881 != '' AND cf_861 != '')";

			if ($_REQUEST["asesoras"])
				$query.=" AND usu.id='".$_REQUEST["asesoras"]."' ";

			if ($_REQUEST["gds"])
				$query.=" AND loc.gds= '".$_REQUEST["gds"]."' ";

			if ($_REQUEST["procesado"] == '1' OR $_REQUEST["procesado"] == '0' )
				$query.=" AND loc.procesado= '".$_REQUEST["procesado"]."' ";

			if ($_REQUEST["satelite"])
				$query.=" AND acc.accountid= '".$_REQUEST["satelite"]."' ";

			if ($_REQUEST["fecha_desde"] && $_REQUEST["fecha_hasta"])
				$query.=" AND bol.fecha_emision BETWEEN '".$_REQUEST["fecha_desde"]."' AND '".$_REQUEST["fecha_hasta"]."' ";

			if ($_REQUEST["localizador"])
				$query.=" AND loc.localizador LIKE '%".$_REQUEST["localizador"]."%' ";

			if ($_REQUEST["boleto"])
				$query.=" AND bol.boleto1 = '".$_REQUEST["boleto"]."' ";

			if ($_REQUEST["estatus"])
				$query.=" AND bol.status = '".$_REQUEST["estatus"]."' ";
				$query.=" ORDER BY bol.fecha_emision DESC ";
		}	
?>

<div class="bottomscroll-div">
	<input type="hidden" value="" id="orderBy">
	<input type="hidden" value="" id="sortOrder">
	<span class="listViewLoadingImageBlock hide modal noprint" id="loadingListViewModal">
		<img class="listViewLoadingImage" src="layouts/vlayout/skins/softed/images/loading.gif" alt="no-image" title="Cargando..."/>
		<p class="listViewLoadingMsg">Cargando, por favor espera.........</p>
	</span>

<?php

	//RURIEPE  2/08/2016 - CONTADORES PARA TOMAR EL TOTAL DE BOLETOS EMITIDOS(NACIONALES E INTERNACIONALES)
	$bemitidos = 0;
	$bnemitidos = 0;
	$biemitidos = 0;
	$bsemitidos = 0;

	//RURIEPE 2/08/2016 - SE REALIZA RECORRIDO E LA CONSULTA EJECUTA PARA 
	if($filtro = mysql_query($query))
	{
		if (mysql_num_rows($filtro) > 0)
		{

		     while ($row = mysql_fetch_array($filtro)) 
		    {
		        //RURIEPE 2/08/2016 - CAPTURA DE TOTAL DE BOLTOS EMITIDOS DEPENDIENDO DE LA OPCION QUE SE EJECUTE
		        if($row['status'] != 'Anulado')
		        {
		        	$bemitidos = $bemitidos + count($row["boletosid"]);

		        	if($row['gds'] == "Servi" AND $row['status'] != "Anulado" AND  $row['currency'] == 'VEF')
					{
						$bemitidos = $bemitidos - 1;
					}
		        }
		        //2/08/2016 RURIEPE - CONDICIONAL PARA SABER LOS TIPOS DE VUELOS E IR ALMACENANDO EL TOTAL EN LOS CONTAODRES YA INICIALIZADOS
		        if($row['tipodevuelo'] == "Nacional" AND $row['status'] !== "Anulado" )
		        {	
		        	$bnemitidos = $bnemitidos + count($row["boletosid"]);

		        	if($row['gds'] == "Servi" AND $row['status'] != "Anulado" AND  $row['currency'] == 'VEF')
					{
						$bnemitidos = $bnemitidos - 1;
					}
		        }
		       	if ($row['tipodevuelo'] == "Internacional" AND $row['status'] != "Anulado")
		        {
		        	$biemitidos = $biemitidos + count($row["boletosid"]);

		        	if($row['gds'] == "Servi" AND $row['status'] != "Anulado" AND  $row['currency'] == 'VEF')
					{
						$biemitidos = $biemitidos - 1;
					}
		        }
		        if (($row['gds'] == "Servi" OR $row['gds'] == "Web Aerolinea") AND $row['status'] != "Anulado" AND  $row['currency'] == 'USD')
		        {
		        	$bsemitidos = $bsemitidos+ count($row["boletosid"]);
		        }
		   	}
		}
	}

	//RURIEPE 05/10/2016 - CONDICION DONDE SI EL ESTATUS ES DIFERENTE DE CERO SE MOSTRARA LAS ESTADISTICAS EN CASO CONTRARIO SI ES IGULA a Anulado NO SE MOSTRARA ESTADISTICA
	if($_REQUEST["estatus"] != 'Anulado')
	{
	// RURIEPE 2/08/2016 - CONDICION PARA VALIDAR CUAL OPCION FUE SELECCIONADA. 
	if($_REQUEST['tventa'] == 1 OR $_REQUEST['tventa'] == 2 OR $_REQUEST['tventa'] == 3 
	 OR $_REQUEST['satelite'] != ""  AND $_REQUEST["asesoras"]!="")
	{
?>
<h3>
	<!--RURIEPE 3/08/2016 - TABLA PARA MOSTRAR RESUMEN DE TOTALES-->
	<table>
		<?php
		//RURIEPE 3/08/2016 - CONDICIONAL PARA INDICAR QUE EL RESUMEN ES DE PROCESADOS O NO PROCESADOS
		if($_REQUEST['procesado'] == '1'){?>
		<tr>
			
			<td width=150></td>
			<td width=410>Total Emitidos (Procesados): <?php echo $bemitidos?> </td>
			<td width=300>Nacionales: <?php echo $bnemitidos?> </td>
			<td width=300>Internacionales: <?php echo $biemitidos ?></td>
			<td width=300>SOTOS: <?php echo $bsemitidos ?></td>
		</tr>
		<?php }else if($_REQUEST['procesado'] == '0'){ ?>
		<tr>
			<td width=150></td>
			<td width=420>Total Emitidos (No Procesados): <?php echo $bemitidos ?> </td>
			<td width=300>Nacionales: <?php echo $bnemitidos?> </td>
			<td width=300>Internacionales: <?php echo $biemitidos ?></td>
			<td width=300>SOTOS: <?php echo $bsemitidos ?></td>
		</tr>
		<?php }else if($_REQUEST['procesado'] == ''){ ?>
		<tr>
			<td width=150></td>
			<td width=420>Total Emitidos: <?php echo $bemitidos ?> </td>
			<td width=300>Nacionales: <?php echo $bnemitidos?> </td>
			<td width=300>Internacionales: <?php echo $biemitidos ?></td>
			<td width=300>SOTOS: <?php echo $bsemitidos ?></td>
		</tr>
		<?php } ?>
	</table>
</h3>
<?php } //RURIEPE 3/08/2016 - ELSE PARA MOSTRAR RESUMEN DE TOTALES SOTOS
else if ($_REQUEST['tventa'] == 4 ) {
?>
<h3>
	<!--RURIEPE 3/08/2016 - TABLA PARA MOSTRAR RESUMEN DE TOTALES-->
	<table>
	<?php
		//RURIEPE 3/08/2016 - CONDICIONAL PARA INDICAR QUE EL RESUMEN ES DE PROCESADOS O NO PROCESADOS PARA TOTALES SOTOS
		if($_REQUEST['procesado'] == '1') { ?>
		<tr>
			<td width=50></td>
			<td width=500>Total SOTOS (Procesados): <?php echo $bsemitidos ?></td>
		</tr>
		<?php } else if($_REQUEST['procesado'] == '0') { ?>
		<tr>
			<td width=50></td>
			<td width=500>Total SOTOS (No Procesados): <?php echo $bsemitidos ?></td>
		</tr>
		<?php } else if($_REQUEST['procesado'] == '') { ?>
		<tr>
			<td width=50></td>
			<td width=500>Total SOTOS: <?php echo $bsemitidos ?></td>
		</tr>
		<?php } ?>
	</table>
</h3>

<?php

}
}
 ?>

<table class="table table-bordered listViewEntriesTable">
	<thead>
		<tr class="listViewHeaders">

			<!--Label para check-->
			<th width="5%" class="wide">
			<input type="checkbox" id="listViewEntriesMainCheckBox"/></th>

			<th nowrap  class="wide"><a href="javascript:void(0);" class="listViewHeaderValues" data-nextsortorderval="ASC" data-columnname="registrodeventas">Registro de Ventas&nbsp;&nbsp;</a></th>

			<!--Label para el filtro localizador-->
			<th nowrap  class="wide"><a href="javascript:void(0);" class="listViewHeaderValues" data-nextsortorderval="ASC" data-columnname="localizador">Localizador&nbsp;&nbsp;</a></th>

			<!--Label para el filtro contacto-->
			<th nowrap  class="wide"><a href="javascript:void(0);" class="listViewHeaderValues" data-nextsortorderval="ASC" data-columnname="contactoid">Contacto&nbsp;&nbsp;</a></th>

			<!--Label para el filtro procesado-->
			<th nowrap  class="wide"><a href="javascript:void(0);" class="listViewHeaderValues" data-nextsortorderval="ASC" data-columnname="procesado">Procesado&nbsp;&nbsp;</a></th>

			<!--Label para el filtro gds-->
			<th nowrap  class="wide"><a href="javascript:void(0);" class="listViewHeaderValues" data-nextsortorderval="ASC" data-columnname="gds">Sistema GDS&nbsp;&nbsp;</a></th>


			<!--Label para el filtro asignado a-->
			<th nowrap  class="wide"><a href="javascript:void(0);" class="listViewHeaderValues" data-nextsortorderval="ASC" data-columnname="status">Asignado a&nbsp;&nbsp;</a></th>
		
			<!--Label para el filtro boleto-->
			<th nowrap  class="wide"><a href="javascript:void(0);" class="listViewHeaderValues" data-nextsortorderval="ASC" data-columnname="boleto1">Nº de Boletos&nbsp;&nbsp;</a></th>

			<!--Label para el filtro fecha emision-->
			<th nowrap  class="wide"><a href="javascript:void(0);" class="listViewHeaderValues" data-nextsortorderval="ASC" data-columnname="fecha_emision">Fecha de Emisión&nbsp;&nbsp;</a></th>

			<!--Label para el filtro de tarifas-->
			<th nowrap colspan="2" class="wide"><a href="javascript:void(0);" class="listViewHeaderValues" data-nextsortorderval="ASC" data-columnname="amount">Tarifa&nbsp;&nbsp;</a></th>
		</tr>
	</thead>
<?php



if($filtro = mysql_query($query))
		{
		    if (mysql_num_rows($filtro) > 0)
		    {
		        while ($row = mysql_fetch_array($filtro)) 
		        {	
		        	$orig_fecha_emision=strtotime($row["fecha_emision"]);
		        	$format_fecha_emision=date("d-m-Y",$orig_fecha_emision);
		        	$query2="SELECT registrodeventasname FROM vtiger_registrodeventas
		        	WHERE registrodeventasid = '".$row["registrodeventasid"]."'";
		        	$resultado = mysql_query($query2);
		        	$registro_de_venta = mysql_fetch_assoc($resultado);
		        	if (isset($else)) {
		        		$query3="SELECT firstname, lastname FROM vtiger_contactdetails 
		        		WHERE contactid = '".$row["contactoid"]."'";
			        	$resultado = mysql_query($query3);
			        	$nombre = mysql_fetch_assoc($resultado);
		        	}
	  
?>

<tr class="listViewEntries" data-id='<?=$row["localizadoresid"]?>' data-recordUrl='index.php?module=Localizadores&view=Detail&record=<?=$row["localizadoresid"]?>' id="Localizadores_listView_row_1">

	<!--Check para cada fila-->
	<td  width="5%" class="wide">
		<input type="checkbox" value="<?=$row["localizadoresid"]?>" class="listViewEntriesCheckBox"/>
	</td>

		<!--Array para mostrar campo localizador-->
	<td class="listViewEntryValue wide" data-field-type="string" data-field-name="registrodeventas" nowrap><?=$row["registrodeventasname"]?></td>

	<!--Array para mostrar campo localizador-->
	<td class="listViewEntryValue wide" data-field-type="string" data-field-name="localizador" nowrap><?=$row["localizador"]?></td>

	<td class="listViewEntryValue wide" data-field-type="reference" data-field-name="contactoid" nowrap>
<!--Condicion, en caso de no haber seleccionado Satelite-->
<?php
	if ($else==1) 
	{
		$query3="SELECT firstname, lastname 
		FROM vtiger_contactdetails 
		WHERE contactid = '".$row["contactoid"]."'";

		$resultado = mysql_query($query3);
		$nombre = mysql_fetch_assoc($resultado);		    
?>
<!--Array para mostrar campo Contacto-->
<a href='?module=Contacts&view=Detail&record=<?=$row["contactoid"]?>' title='Contactos'><?=$nombre["firstname"]." ".$nombre["lastname"]?>
</a>
</td>

<?php
	}else{			
?>

<a href='?module=Contacts&view=Detail&record=<?=$row["contactid"]?>' title='Contactos'><?=$row["firstname"]." ".$row["lastname"]?></a>
</td>

<?php
	}
?>

<!--Array para mostrar campo Procesado-->
<td class="listViewEntryValue wide" data-field-type="boolean" data-field-name="procesado" nowrap><?=($row["procesado"] == "0") ?  "No" : "Si"?></td>

<!--Array para mostrar campo Gds-->
<td class="listViewEntryValue wide" data-field-type="picklist" data-field-name="gds" nowrap><?=$row["gds"]?></td>


<!--Array para mostrar campo Asignado a-->
<td class="listViewEntryValue wide" data-field-type="picklist" data-field-name="asinado" nowrap><?=$row["first_name"]." ".$row["last_name"]?></td>

<!--Array para mostrar campo Boleto-->
<td class="listViewEntryValue wide" data-field-type="string" data-field-name="boleto1" nowrap><?=$row["boleto1"]?></td>

<!--Array para mostrar campo Fecha Emision-->
<td class="listViewEntryValue wide" data-field-type="string" data-field-name="fecha_emision" nowrap><?=$format_fecha_emision?></td>

<!--Array para mostrar campo Tarifa-->
<td class="listViewEntryValue wide" data-field-type="currency" data-field-name="amount" nowrap><?=number_format($row["amount"], 2, '.', ',');?></td>

<td nowrap class="wide">
	<div class="actions pull-right">
		<span class="actionImages">
			<a href="index.php?module=Localizadores&view=Detail&record=<?=$row["localizadoresid"]?>&mode=showDetailViewByMode&requestMode=full">
				<i title="Complete Details" class="icon-th-list alignMiddle"></i>
			</a>&nbsp;

			<a href='index.php?module=Localizadores&view=Edit&record=<?=$row["localizadoresid"]?>'>
				<i title="Editar" class="icon-pencil alignMiddle"></i>
			</a>
		</span>
	</div>
</td>
</tr>
<?php
	}
		}
			}
			else
			{
				echo "Error en la consulta SQL: ".mysql_error();
			}
?>

</table>	
</div>

<?php 	
	}
	///FIN RESPONSE LISTAR RESULTADOS DE LA BUSQUEDA
?>
		
