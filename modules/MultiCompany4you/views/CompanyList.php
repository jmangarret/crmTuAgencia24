<?php

/* * *******************************************************************************
 * The content of this file is subject to the MultiCompany4you license.
 * ("License"); You may not use this file except in compliance with the License
 * The Initial Developer of the Original Code is IT-Solutions4You s.r.o.
 * Portions created by IT-Solutions4You s.r.o. are Copyright(C) IT-Solutions4You s.r.o.
 * All Rights Reserved.
 * ****************************************************************************** */

class MultiCompany4you_CompanyList_View extends Settings_Vtiger_Index_View {

    public function process(Vtiger_Request $request) {
        $qualifiedModuleName = $request->getModule();
        $moduleModel = MultiCompany4you_CompanyDetails_Model::getInstance();
        $viewer = $this->getViewer($request);
        $adb = PearDatabase::getInstance();
        /*$adb->setDebug(true);
        ini_set('display_errors','On');error_reporting(63);*/
        $vcv = vglobal('vtiger_current_version');
        $result = $adb->pquery("SELECT version FROM its4you_multicompany4you_version WHERE version=?", array($vcv));
        if ($result && $adb->num_rows($result)) {
            $viewer->assign('MODULE_MODEL', $moduleModel);
            $viewer->assign('ERROR_MESSAGE', $request->get('error'));
            $viewer->assign('QUALIFIED_MODULE', $qualifiedModuleName);
            $viewer->assign('COMPANIES', $this->getCompaniesList());
            $viewer->view('List.tpl', $qualifiedModuleName);
        } else {
            $step = 1;
            $current_step = 1;
            $total_steps = 2;
            $viewer->assign("STEP", $step);
            $viewer->assign("CURRENT_STEP", $current_step);
            $viewer->assign("TOTAL_STEPS", $total_steps);
            $viewer->view('Install.tpl', $qualifiedModuleName);
        }
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
            "modules.MultiCompany4you.resources.List",
            "layouts.vlayout.modules.MultiCompany4you.resources.License",
        );

        $jsScriptInstances = $this->checkAndConvertJsScripts($jsFileNames);
        $headerScriptInstances = array_merge($headerScriptInstances, $jsScriptInstances);
        return $headerScriptInstances;
    }

    private function getCompaniesList() {
        $adb = PearDatabase::getInstance();
        $Companies = Array();
        $res = $adb->pquery("SELECT its4you_multicompany4you.*, vtiger_role.rolename FROM its4you_multicompany4you LEFT JOIN vtiger_role ON vtiger_role.roleid=its4you_multicompany4you.role");
        while ($row = $adb->fetchByAssoc($res)) {
            $Companies[$row['companyid']] = $row;
        }
        return $Companies;
    }

}
