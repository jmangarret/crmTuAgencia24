<?php
/*VIENE DE LISTVIEW.PHP*/
/*INCLUDE PARA FUNCION getListViewEntries*/

/////Modified by jmangarret 13ene2016 popUP seleccionar localizadores desde Registro de Ventas
if ($moduleName=="Localizadores" && $sourceModule=="RegistroDeVentas"){
	$listQuery .= ' AND vtiger_localizadores.procesado=0';	
}

/////Modified by jmangarret 03feb2016 popUP seleccionar cuentas desde Comsiones Satelites
if ($moduleName=="Accounts" && $sourceModule=="ComisionSatelites"){
	$listQuery .= ' AND vtiger_account.account_type="Satelite"';	
}	

/////Modified by jmangarret 13ene2017 Filtro de Localizadores por Firma de satelite.
$userid=$_SESSION["authenticated_user_id"];
$qry=$db->pquery("SELECT accountid FROM vtiger_users WHERE id=?",array($userid));
$result = $db->fetch_array($qry);
$accountid = $result['accountid'];
$role=	fetchUserRole($userid);
$roleinfo=	getRoleInformation($role);
$depth=		$roleinfo[$role][2]; //Nivel o Profundidad del Role 5=Satelites, 4=Sales Person
if ($depth==5){ //role satelite
	//Buscamos todas las firmas de la cuenta asociada al usuario
	$sqlFirmas ="SELECT firma FROM vtiger_terminales as t INNER JOIN vtiger_contactdetails as c ON t.usercontactoid=c.contactid ";
	$sqlFirmas.=" INNER JOIN vtiger_account as a ON c.accountid=a.accountid ";
	$sqlFirmas.=" WHERE a.accountid=$accountid AND (account_type='Satelite' OR account_type='Freelance')";
	$qryFirmas=$db->pquery($sqlFirmas, array());
	$numFirmas=0;
	while ($firma=$db->fetch_row($qryFirmas)){
		//leemos cada firma para convertirla en una cadena tipo string
		$firmas.="'".$firma[0]."',";
		$numFirmas++;
	}	
	//Buscamos todos los contactos de la cuenta asociada al usuario
	$sqlContactos ="SELECT contactid FROM vtiger_contactdetails as c ";
	$sqlContactos.=" INNER JOIN vtiger_account as a ON c.accountid=a.accountid ";
	$sqlContactos.=" WHERE a.accountid=$accountid AND (account_type='Satelite' OR account_type='Freelance')";
	$qryContactos=$db->pquery($sqlContactos, array());
	$numContactos=0;
	while ($contacto=$db->fetch_row($qryContactos)){
		$contactos.="'".$contacto[0]."',";
		$numContactos++;
	}	
	
	if ($numFirmas>0){
		$firmas = substr($firmas, 0, -1); //eliminamos la ultima coma que traerá un valor vacio	
		if ($moduleName=="Localizadores")	//filtramos el listado de localizadores $listQuery
		$listQuery .= ' AND vtiger_localizadores.referencia IN ('.$firmas.')';				
		if ($moduleName=="Boletos") //filtramos el listado de Boletos $listQuery
		$listQuery .= ' AND vtiger_boletos.localizadorid IN (SELECT localizadoresid FROM vtiger_localizadores WHERE vtiger_crmentity.deleted=0 AND vtiger_localizadores.localizadoresid > 0 AND vtiger_localizadores.referencia IN ('.$firmas.'))';	
	
	}else{
		if ($numContactos>0){
			$contactos = substr($contactos, 0, -1); //eliminamos la ultima coma que traerá un valor vacio		
			if ($moduleName=="Localizadores") 	//filtramos el listado de localizadores $listQuery
			$listQuery .= ' AND vtiger_localizadores.contactoid IN ('.$contactos.')';	
			if ($moduleName=="Boletos") //filtramos el listado de Boletos $listQuery
			$listQuery .= ' AND vtiger_boletos.localizadorid IN (SELECT localizadoresid FROM vtiger_localizadores WHERE vtiger_crmentity.deleted=0 AND vtiger_localizadores.localizadoresid > 0 AND vtiger_localizadores.contactoid IN ('.$contactos.'))';	
		}				
	}	
}
?>