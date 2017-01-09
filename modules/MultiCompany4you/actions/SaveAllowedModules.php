<?php

/* * *******************************************************************************
 * The content of this file is subject to the MultiCompany4you license.
 * ("License"); You may not use this file except in compliance with the License
 * The Initial Developer of the Original Code is IT-Solutions4You s.r.o.
 * Portions created by IT-Solutions4You s.r.o. are Copyright(C) IT-Solutions4You s.r.o.
 * All Rights Reserved.
 * ****************************************************************************** */

class MultiCompany4you_SaveAllowedModules_Action extends Settings_Vtiger_Basic_Action {

    public function process(Vtiger_Request $request) {
        $adb = PearDatabase::getInstance();
        $adb->setDebug(TRUE);
        $qualifiedModuleName = $request->getModule();
        $moduleModel = MultiCompany4you_CompanyDetails_Model::getEditInstance($request);

        $adb->query("DELETE FROM its4you_multicompany4you_cn_modules");
        $req = $request->getAll();
        foreach ($req as $key => $value) {
            if (substr($key, 0, 8) == 'allowed_') {
                $adb->pquery("INSERT INTO its4you_multicompany4you_cn_modules VALUES (?)", array(substr($key, 8)));
            }
        }

        $reloadUrl = 'index.php?parent=Settings&module=MultiCompany4you&view=Numbering&companyid=' . $req['companyid'] . '&block=' . $req['block'] . '&fieldid=' . $req['fieldid'];
        header('Location: ' . $reloadUrl);
    }

}
