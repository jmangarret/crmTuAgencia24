<?php

/* * *******************************************************************************
 * The content of this file is subject to the MultiCompany4you license.
 * ("License"); You may not use this file except in compliance with the License
 * The Initial Developer of the Original Code is IT-Solutions4You s.r.o.
 * Portions created by IT-Solutions4You s.r.o. are Copyright(C) IT-Solutions4You s.r.o.
 * All Rights Reserved.
 * ****************************************************************************** */

class MultiCompany4you_Delete_Action extends Vtiger_Delete_Action {

    public function process(Vtiger_Request $request) {
        $adb = PearDatabase::getInstance();
        $adb->pquery("DELETE FROM its4you_multicompany4you WHERE companyid=?",array($request->get('companyid')));
        $response = new Vtiger_Response();
        $response->setResult('OK');
        $response->emit();
    }

}
