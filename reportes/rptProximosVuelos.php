<?
//ini_set('display_errors', true);
//ini_set('error_reporting', E_ALL & ~E_NOTICE & ~E_STRICT & ~E_DEPRECATED);
include("conexion.php");

$f1=date("Y")."-09-01 00:00";
$f2=date("Y-m-d")." 23:59";

$hoy=date("Y-m-d");
//$hoy=date("2016-04-01");
if ($_REQUEST['desde']) 	$f1=fecha_mysql($_REQUEST['desde'])." 00:00";
if ($_REQUEST['hasta']) 	$f2=fecha_mysql($_REQUEST['hasta'])." 23:59";

$sql="SELECT * FROM registro_boletos.boletos WHERE status_emission='Emitido' AND departureDate>'".$hoy."' ORDER BY departureDate ASC";

//echo $sql;
?>
<div id="resultado">
<h3>Mostrando Resultados Desde <?php echo $hoy; ?></h3>
<table width="60%" align=center class="table table-bordered table-hover">
	<thead>
		<tr class="listViewHeaders"> 
			<th><b>Item</b></th>
			<th><b>Localizador</b></th>
			<th><b>Pasajero</b></th>
			<th><b>Telefonos</b></th>
			<th><b>Boleto</b></th>
			<th><b>Aerolinea</b></th>
			<th><b>Ruta</b></th>
			<th><b>Salida</b></th>
		</tr>
	</thead>
	<tbody>
		<?php
		$i=0;
		$listado = mysql_query($sql);
		while($reg= mysql_fetch_array($listado))
		{
			$i++;
			$departureDate=explode(" ", $reg["departureDate"]);
			$sqlLoc="SELECT * FROM vtigercrm600.vtiger_localizadores WHERE localizador LIKE '%".$reg["localizador"]."%'";
			$qryLoc=mysql_query($sqlLoc);
			$locid=mysql_result($qryLoc, 0,"localizadoresid");
			/*Buscamos telefonos de contacto*/
			$contactid=mysql_result($qryLoc, 0,"contactoid");
			$sqlContacto = "SELECT CONCAT(phone,' ', mobile,' ',fax) as telefonos FROM vtiger_contactdetails WHERE contactid = ".$contactid;
			$qryContact=mysql_query($sqlContacto);
			$telefonos=mysql_result($qryContact, 0,"telefonos");

			echo "<tr style='background-color:".$color."'>";
			echo "<td>".$i."</td>";
			echo "<td>";
				echo "<a href='index.php?module=Localizadores&view=Detail&record=".$locid."'>";
				echo $reg["localizador"];
				echo "</a>";
			echo "</td>";
			echo "<td>".$reg["passenger"]."</td>";
			echo "<td>".$telefonos."</td>";
			echo "<td>".$reg["ticketNumber"]."</td>";
			echo "<td>".$reg["airlineID"]."</td>";
			echo "<td>".$reg["itinerary"]."</td>";
			echo "<td>".$departureDate[0]."</td>";
			echo "</tr>";
		}
		//boletos en dolares cargados manualmente en el crm
		$sql_v2="SELECT * FROM vtigercrm600.vtiger_boletos WHERE status='Emitido' AND currency='USD' AND fecha_vuelo>'".$hoy."' ORDER BY fecha_vuelo ASC";
		$listado_v2 = mysql_query($sql_v2);
		while($reg= mysql_fetch_array($listado_v2))
		{
			$i++;
			$sqlLoc="SELECT * FROM vtigercrm600.vtiger_localizadores WHERE localizadoresid = ".$reg["localizadorid"];
			$qryLoc=mysql_query($sqlLoc);
			$loc=mysql_fetch_array($qryLoc);
			$locid=$loc["localizadoresid"];
			$localizador=$loc["localizador"];
			$aerolinea=$loc["airline"];
			/*Buscamos telefonos de contacto*/
			$contactid=$loc["contactoid"];
			$sqlContacto = "SELECT CONCAT(phone,' ', mobile,' ',fax) as telefonos FROM vtiger_contactdetails WHERE contactid = ".$contactid;
			$qryContact=mysql_query($sqlContacto);
			$telefonos=mysql_result($qryContact, 0,"telefonos");

			echo "<tr style='background-color:".$color."'>";
			echo "<td>".$i."</td>";
			echo "<td>";
				echo "<a href='index.php?module=Localizadores&view=Detail&record=".$locid."'>";
				echo $localizador;
				echo "</a>";
			echo "</td>";
			echo "<td>".$reg["passenger"]."</td>";
			echo "<td>".$telefonos."</td>";
			echo "<td>".$reg["boleto1"]."</td>";
			echo "<td>".$aerolinea."</td>";
			echo "<td>".$reg["itinerario"]."</td>";
			echo "<td>".$reg["fecha_vuelo"]."</td>";
			echo "</tr>";
		}

		?>
	<tbody>
</table>
</div>

