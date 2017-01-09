<?php

/* * *******************************************************************************
 * The content of this file is subject to the MultiCompany4you license.
 * ("License"); You may not use this file except in compliance with the License
 * The Initial Developer of the Original Code is IT-Solutions4You s.r.o.
 * Portions created by IT-Solutions4You s.r.o. are Copyright(C) IT-Solutions4You s.r.o.
 * All Rights Reserved.
 * ****************************************************************************** */

class MultiCompany4you {

    private $LBL_MULTICOMPANY = 'Multi Company';

    function vtlib_handler($moduleName, $eventType) {
        //require_once('include/utils/utils.php');
        $adb = PearDatabase::getInstance();


        if ($eventType == 'module.postinstall') {
            $this->updateSettings();
            $adb->query('INSERT INTO its4you_multicompany4you (companyid, companyname, street, city, code, state, country, phone, fax, website, logoname, logo) SELECT organization_id, organizationname, address, city, code, state, country, phone, fax, website, logoname, logo FROM vtiger_organizationdetails');
            $adb->query('INSERT INTO its4you_multicompany4you_seq (id) SELECT MAX(companyid) FROM its4you_multicompany4you');
        } else if ($eventType == 'module.disabled') {
            $adb->pquery('UPDATE vtiger_settings_field SET active= 1  WHERE  name= ?', array($this->LBL_MULTICOMPANY));
            $em = new VTEventsManager($adb);
            $em->setHandlerInActive('MultiCompany4youHandler');
        } else if ($eventType == 'module.enabled') {
            $adb->pquery('UPDATE vtiger_settings_field SET active= 0  WHERE  name= ?', array($this->LBL_MULTICOMPANY));
            $em = new VTEventsManager($adb);
            $em->setHandlerActive('MultiCompany4youHandler');
        } else if ($eventType == 'module.preuninstall') {
            $adb->pquery('DELETE FROM vtiger_settings_field WHERE  name= ?', array($this->LBL_MULTICOMPANY));
            $em = new VTEventsManager($adb);
            $em->unregisterHandler('MultiCompany4youHandler');
        } else if ($eventType == 'module.preupdate') {
            // TODO Handle actions before this module is updated.
        } else if ($eventType == 'module.postupdate') {
            $this->updateSettings();
        }
    }

    private function updateSettings() {
        $adb = PEARDatabase::getInstance();

        $fieldid = $adb->getUniqueID('vtiger_settings_field');
        $blockid = getSettingsBlockId('LBL_OTHER_SETTINGS');
        $seq_res = $adb->pquery("SELECT max(sequence) AS max_seq FROM vtiger_settings_field WHERE blockid = ?", array($blockid));
        if ($adb->num_rows($seq_res) > 0) {
            $cur_seq = $adb->query_result($seq_res, 0, 'max_seq');
            if ($cur_seq != null)
                $seq = $cur_seq + 1;
        }

        $result = $adb->pquery('SELECT 1 FROM vtiger_settings_field WHERE name=?', array($this->LBL_MULTICOMPANY));
        if (!$adb->num_rows($result)) {
            $adb->pquery('INSERT INTO vtiger_settings_field(fieldid, blockid, name, iconpath, description, linkto, sequence)
		VALUES (?,?,?,?,?,?,?)', array($fieldid, $blockid, $this->LBL_MULTICOMPANY, 'modules/MultiCompany4you/img/multicompany4you.gif', 'Specify businness address for multiple companies', 'index.php?parent=Settings&module=MultiCompany4you&view=CompanyList', $seq));
        }
    }

    static function checkAdminAccess($user) {
        return;
        if (is_admin($user))
            return;

        echo "<table border='0' cellpadding='5' cellspacing='0' width='100%' height='450px'><tr><td align='center'>";
        echo "<div style='border: 3px solid rgb(153, 153, 153); background-color: rgb(255, 255, 255); width: 55%; position: relative; z-index: 10000000;'>

		<table border='0' cellpadding='5' cellspacing='0' width='98%'>
		<tbody><tr>
		<td rowspan='2' width='11%'><img src= " . vtiger_imageurl('denied.gif', $theme) . " ></td>
		<td style='border-bottom: 1px solid rgb(204, 204, 204);' nowrap='nowrap' width='70%'>
			<span class='genHeaderSmall'>" . vtranslate('LBL_PERMISSION') . "</span></td>
		</tr>
		<tr>
		<td class='small' align='right' nowrap='nowrap'>
		<a href='javascript:window.history.back();'>" . vtranslate('LBL_GO_BACK') . "</a><br>
		</td>
		</tr>
		</tbody></table>
		</div>";
        echo "</td></tr></table>";
        exit;
    }

}
