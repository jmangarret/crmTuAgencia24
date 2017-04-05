<?php
	/*VIENE DE VTIGER/MODELS/RECORD.PHP*/
	/*INCLUDE PARA FUNCION getSearchResult*/

	//////jmangarret 06ago2017 - Filtramos data de Satelite //////
	$userid=$_SESSION["authenticated_user_id"];
	$sql="SELECT accountid FROM vtiger_users WHERE id=$userid";

	$qry=$db->pquery($sql,array());
	$res = $db->fetch_array($qry);
	$accountid = $res['accountid'];
	$role=	fetchUserRole($userid);
	$roleinfo=	getRoleInformation($role);
	$depth=		$roleinfo[$role][2]; //Nivel o Profundidad del Role 5=Satelites, 4=Sales Person
	
	if ($depth==5 && ($row['setype'] == 'Localizadores' || $row['setype'] == 'Boletos')) {				
		$sqlLoc	="SELECT referencia, contactoid FROM vtiger_localizadores WHERE localizadoresid=".$row['crmid'];
		$qryLoc = $db->pquery($sqlLoc, array());
		$resLoc = $db->fetch_array($qryLoc);
		$firma=$resLoc["referencia"];
		$contacto=$resLoc["contactoid"];					
		
		$sqlFirmas ="SELECT COUNT(*) FROM vtiger_terminales as t INNER JOIN vtiger_contactdetails as c ON t.usercontactoid=c.contactid ";
		$sqlFirmas.=" INNER JOIN vtiger_account as a ON c.accountid=a.accountid ";
		$sqlFirmas.=" WHERE a.accountid=$accountid AND firma='$firma' ";
		$qryFirmas =$db->pquery($sqlFirmas, array());
		$resFirmas =$db->fetch_row($qryFirmas);

		$sqlContactos ="SELECT COUNT(*) FROM vtiger_contactdetails as c ";
		$sqlContactos.=" INNER JOIN vtiger_account as a ON c.accountid=a.accountid ";
		$sqlContactos.=" WHERE a.accountid=$accountid AND contactid=$contacto";
		$qryContactos =$db->pquery($sqlContactos, array());
		$resContactos =$db->fetch_row($qryContactos);
		
		if ($resFirmas[0]==0 && $resContactos[0]==0) continue;
	}
	//////Fin jmangarret 06ago2017 //////	
?>