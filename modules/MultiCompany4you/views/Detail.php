<?php

/* * *******************************************************************************
 * The content of this file is subject to the MultiCompany4you license.
 * ("License"); You may not use this file except in compliance with the License
 * The Initial Developer of the Original Code is IT-Solutions4You s.r.o.
 * Portions created by IT-Solutions4You s.r.o. are Copyright(C) IT-Solutions4You s.r.o.
 * All Rights Reserved.
 * ****************************************************************************** */

class MultiCompany4you_Detail_View extends Settings_Vtiger_Index_View {

    public function process(Vtiger_Request $request) {
        $qualifiedModuleName = $request->getModule();
        $moduleModel = MultiCompany4you_CompanyDetails_Model::getDetailInstance($request);

        $viewer = $this->getViewer($request);
        $viewer->assign('MODULE_MODEL', $moduleModel);
        $viewer->assign('ERROR_MESSAGE', $request->get('error'));
        $viewer->assign('QUALIFIED_MODULE', $qualifiedModuleName);
        $viewer->assign("AVAILABLEROLES", $this->getRoles());
        $viewer->view('Detail.tpl', $qualifiedModuleName);
    }

    function getPageTitle(Vtiger_Request $request) {
        $qualifiedModuleName = $request->getModule();
        return vtranslate('LBL_COMPANY_DETAILS', $qualifiedModuleName);
    }

    /**
     * Function to get the list of Script models to be included
     * @param Vtiger_Request $request
     * @return <Array> - List of Vtiger_JsScript_Model instances
     */
    function getHeaderScripts(Vtiger_Request $request) {
        $headerScriptInstances = parent::getHeaderScripts($request);
        $moduleName = $request->getModule();

        $jsFileNames = array(
            "modules.MultiCompany4you.resources.CompanyDetails"
        );

        $jsScriptInstances = $this->checkAndConvertJsScripts($jsFileNames);
        $headerScriptInstances = array_merge($headerScriptInstances, $jsScriptInstances);
        return $headerScriptInstances;
    }

    private function getRoles() {
        $adb = PearDatabase::getInstance();
        $AvailableRoles = Array();

        $sql = "SELECT * 
            FROM  vtiger_role 
            WHERE depth>0 
                AND roleid NOT IN (SELECT DISTINCT role FROM its4you_multicompany4you WHERE role IS NOT NULL AND companyid!=?)
            ORDER BY parentrole ASC ";
        $result = $adb->pquery($sql, array($_REQUEST['record']));
        while ($row = $adb->fetchByAssoc($result)) {
            $row['rolename'] = str_repeat("&nbsp;", 2 * ($row['depth'] - 1)) . $row['rolename'];
            $AvailableRoles[] = $row;
        }
        return $AvailableRoles;
    }

}
