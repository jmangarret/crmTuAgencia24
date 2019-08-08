<?php
include("../../config.inc.php");
$user=$dbconfig['db_username'];
$pass=$dbconfig['db_password'];
$bd=$dbconfig['db_name'];
mysql_connect("localhost",$user,$pass);
mysql_select_db($bd);
$id 	= $_REQUEST["id"];
$userid = $_REQUEST["userid"];
$accion = $_REQUEST["accion"];
$sin_contactos=0;
$cont=0;
if ($accion=="procesarLocalizadores"){		
	if (isset($id))
	foreach ($id as $idLoc) {
		$resultado = mysql_query("SELECT registrodeventasid, gds FROM vtiger_localizadores WHERE localizadoresid = ".$idLoc);
		$registro = mysql_fetch_assoc($resultado);
		if (!isset($registro["registrodeventasid"]) OR is_null($registro["registrodeventasid"]) OR empty($registro["registrodeventasid"])){			
			///FIX Error al procesar venta - Se coloca no procesado por no tener venta asociada
			$qryUpdLoc=mysql_query("UPDATE vtiger_localizadores SET procesado=0 WHERE localizadoresid=".$idLoc);	
			/// CREACION DEL REGISTO DE VENTAS ///
			$sqlIdCrm=mysql_query("CALL getCrmId();");
			$sqlIdCrm=mysql_query("SELECT @idcrm;");
			$resIdCrm=mysql_fetch_row($sqlIdCrm);
			$crmId=$resIdCrm[0];
			$fhoy=date("Y-m-d h:i:s");

			//Obtenemos correlativo del registro de ventas
			$sqlRecordNumber="CALL getRecordNumber('RegistroDeVentas')";
			$qryRecordNumber=mysql_query($sqlRecordNumber);
			$qryRecordNumber=mysql_query("SELECT @id_entity, @cur_prefix");
			$rowRecordNumber=mysql_fetch_row($qryRecordNumber);
			$idRecord=$rowRecordNumber[0];
			$moduleRecord=$rowRecordNumber[1];

			//Seteamos crmEntity
			$sqlSetCrm="CALL setCrmEntity('RegistroDeVentas','$moduleRecord','".$fhoy."',$crmId,$userid)";
			$setCrm=mysql_query($sqlSetCrm);

			//Buscamos contacto para el registro de venta si el contacto del Localizaodr pertenece a un Satelite
			$sqlContacto ="SELECT c.contactid FROM vtiger_account AS a ";
			$sqlContacto.="INNER JOIN vtiger_contactdetails 	AS c ON a.accountid=c.accountid ";
			$sqlContacto.="INNER JOIN vtiger_localizadores 	AS l ON l.contactoid=c.contactid ";		
			$sqlContacto.="WHERE a.account_type='Satelite' AND localizadoresid=".$idLoc;	
			///SQL PARA CONTACTO EN GENERAL SIN TOMAR EN CUENTA QUE SEA SATELITE
			$sqlContacto ="SELECT c.contactid FROM vtiger_contactdetails AS c ";		
			$sqlContacto.="INNER JOIN vtiger_localizadores 	AS l ON l.contactoid=c.contactid ";		
			$sqlContacto.="WHERE localizadoresid=".$idLoc;	

			$qryContacto=mysql_query($sqlContacto);
			$resContacto=mysql_fetch_row($qryContacto);		
			$contactid = ($resContacto[0]>0 ? $resContacto[0] : 0);

			if ($contactid==0) {
				$sin_contactos++;
				continue;
			}

			//Creamos registro de venta
			$sqlVenta ="insert into vtiger_registrodeventas(registrodeventasid,registrodeventasname,registrodeventastype,fecha,contacto) ";
			if ($registro["gds"]=="Kiu" || $registro["gds"]=="Amadeus" || $registro["gds"]=="Web Aerolinea")
				$sqlVenta.="values($crmId,'$moduleRecord','Boleto',NULL,$contactid)";
			else
				$sqlVenta.="values($crmId,'$moduleRecord','Boleto SOTO',NULL,$contactid)";	
			
			$qryVenta=mysql_query($sqlVenta);
			$insert_venta=mysql_affected_rows();

			if ($insert_venta>0){
				$sqlReg2="insert into vtiger_registrodeventascf(registrodeventasid,cf_1621,cf_1627) values($crmId,'Pendiente de Pago','Venta generada desde Procesar Localizadores')";
				$qryReg2=mysql_query($sqlReg2);

				$idRecordSig=($idRecord+1);
				$sqlEnt="UPDATE vtiger_modentity_num SET cur_id=CONCAT('0',$idRecordSig) WHERE cur_id='$idRecord' AND active=1 AND semodule='RegistroDeVentas'";
				$qryEnt=mysql_query($sqlEnt);
				/// FIN CREACION DEL REGISTO DE VENTAS///

				//$sql="UPDATE vtiger_boletos SET status='Procesado' WHERE boletosid=".$i;		
				$qryUpdLoc=mysql_query("UPDATE vtiger_localizadores SET procesado=1 WHERE localizadoresid=".$idLoc);			
				$update_loc=mysql_affected_rows();
				if ($update_loc>0){
					//Actualizamos venta asociada en Localizador
					$qryVtaLoc=mysql_query("UPDATE vtiger_localizadores SET registrodeventasid=$crmId WHERE localizadoresid=".$idLoc);
					//Insertamos relacion entre modulos vtiger
					$qryInsertRel=mysql_query("INSERT INTO vtiger_crmentityrel values($crmId,'RegistroDeVentas',$idLoc,'Localizadores');");
					//Agregamos trackers de auditoria para ver modificaciones
					$ult="SELECT MAX(id) FROM vtiger_modtracker_basic";
					$qul=mysql_query($ult);
					$idm=mysql_result($qul, 0);
					$idm=$idm+1;
					$aud=" INSERT INTO vtiger_modtracker_basic(id, crmid, module, whodid, changedon, status) ";
					$aud.="VALUES($idm,'$idLoc','Localizadores','$userid','$fhoy','0')";
					mysql_query($aud);
					$aud="update vtiger_modtracker_basic_seq set id=LAST_INSERT_ID(id+1)";
					mysql_query($aud);
					$aud="INSERT INTO vtiger_modtracker_detail(id,fieldname,prevalue,postvalue) VALUES($idm,'procesado',0,1)";
					mysql_query($aud);
					$aud="INSERT INTO vtiger_modtracker_detail(id,fieldname,prevalue,postvalue) VALUES($idm,'registrodeventasid',0,$crmId)";
					mysql_query($aud);

					$cont++;						
				}

				//Agregamos trackers de auditoria para ver modificaciones
				$ult="SELECT MAX(id) FROM vtiger_modtracker_basic";
				$qul=mysql_query($ult);
				$idm=mysql_result($qul, 0);
				$idm=$idm+1;
				$aud=" INSERT INTO vtiger_modtracker_basic(id, crmid, module, whodid, changedon, status) ";
				$aud.="VALUES($idm,'$crmId','RegistroDeVentas','$userid','$fhoy','2')";
				mysql_query($aud);
				$aud="update vtiger_modtracker_basic_seq set id=LAST_INSERT_ID(id+1)";
				mysql_query($aud);
				//$aud="INSERT INTO vtiger_modtracker_detail(id,fieldname,prevalue,postvalue) VALUES($idm,$fieldname,$prevalue,$postvalue)";
				//mysql_query($aud);

			}
		}else{
			$response="Ya procesado";	
		}		
	}

	if (($cont>0) && ($sin_contactos==0)){//se procesaron todos
		$response="Completado";
		//$link= "<a href='index.php?module=Localizadores&view=List'>Actualizar Lista</a>";		
		//echo "Se han procesado TODOS LOS BOLETOS asociados de los LOCALIZADORES seleccionados. $link";
	}
	if ($cont>0 && $sin_contactos>0){	//Mensaje a medias, exitos y fallos
		$response="Incompleto";
		//$link= "<a href='index.php?module=Localizadores&view=List'>Actualizar Lista</a>";
		//echo "Hubo un total de ".$sin_contactos." boleto(s) que no se procesaron. No hay Contacto asociado.";
	}
	if ($cont==0 && $sin_contactos>0) { //Fallaron todos		
		$response="Fallido";
		//echo "No se procesó ningún localizador por falta de contactos.";
	}	
	echo $response;
}//Fin procesar localizadores

if ($accion=="excelLocalizadores"){
	$tabla ="<table border=1>";
	$tabla.="<tr>";
	$tabla.="<th>Boleto</th>";
	$tabla.="<th>Factura</th>";
	$tabla.="<th>Fecha</th>";
	$tabla.="<th>Monto Cobrado</th>";
	$tabla.="<th>Precio</th>";
	$tabla.="<th>BSP Humbermar</th>";
	$tabla.="<th>BSP Satelites Amadeus</th>";
	$tabla.="<th>BSP Satelites Kiu</th>";
	$tabla.="<th>BSP Freelance</th>";
	$tabla.="<th>Cargo TKT Satelites</th>";
	$tabla.="<th>Fee</th>";
	$tabla.="<th>Total Ingreso</th>";
	$tabla.="<th>Cobrado</th>";
	$tabla.="<th>Satelite o Freelance</th>";
	$tabla.="<th>Vendedor</th>";
	$tabla.="<th>Aerolinea</th>";
	$tabla.="<th>Mercado</th>";
	$tabla.="<th>Estado de Cancelacion</th>";
	$tabla.="<th>Forma de Pago</th>";
	$tabla.="<th>Referencia Bancaria</th>";
	$tabla.="<th>Dia Depositado</th>";
	$tabla.="</tr>";
	if (isset($id))
	foreach ($id as $idBoleto) {		
		$sqlBol ="SELECT *,b.status as status_boleto FROM vtiger_localizadores as l INNER JOIN vtiger_boletos as b ";
		$sqlBol.="ON l.localizadoresid=b.localizadorid ";
		$sqlBol.="WHERE b.boletosid=$idBoleto";
		$qryBol =mysql_query($sqlBol);
		$rowBol =mysql_fetch_array($qryBol);
		
		$loc 	=$rowBol["localizador"];
		$airline=$rowBol["airline"];
		$fdepago=$rowBol["paymentmethod"];
		$mercado=$rowBol["tipodevuelo"];
		$fecha 	=$rowBol["fecha_emision"];
		$bol 	=$rowBol["boleto1"];
		$fee 	=$rowBol["fee"];
		$mtobase=$rowBol["monto_base"];
		$tarifa =$rowBol["amount"];
		$total  =$rowBol["totalboletos"];
		$status =$rowBol["status_boleto"];
		$contact=$rowBol["contactoid"];

		$sqlsat ="SELECT accountname from vtiger_account as a INNER JOIN vtiger_contactdetails as c ";
		$sqlsat.=" ON a.accountid=c.accountid WHERE contactid=".$contact;
		$qrysat =mysql_query($sqlsat);
		$rowsat=mysql_fetch_array($qrysat);
		$satelite=$rowsat["accountname"];

		$tabla.="<tr>";		
		$tabla.="<td>$bol</td>";
		$tabla.="<td>$factura</td>";
		$tabla.="<td>$fecha</td>";
		$tabla.="<td>$total</td>";
		$tabla.="<td>$mtobase</td>";
		$tabla.="<td>$bsp1</td>";
		$tabla.="<td>$bsp2</td>";
		$tabla.="<td>$bsp3</td>";
		$tabla.="<td>$bsp4</td>";
		$tabla.="<td>$cargotkt</td>";
		$tabla.="<td>$fee</td>";
		$tabla.="<td>$totaling</td>";
		$tabla.="<td>$cobrado</td>";
		$tabla.="<td>$satelite</td>";
		$tabla.="<td>$vendedor</td>";
		$tabla.="<td>$airline</td>";
		$tabla.="<td>$mercado</td>";
		$tabla.="<td>$status</td>";
		$tabla.="<td>$fdepago</td>";
		$tabla.="<td>$refbancaria</td>";
		$tabla.="<td>$diadepositado</td>";
		$tabla.="</tr>";
	}
	$tabla.="</table>";

	echo $tabla;
}	
?>

