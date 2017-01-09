<?php

/* * *******************************************************************************
 * The content of this file is subject to the MultiCompany4you license.
 * ("License"); You may not use this file except in compliance with the License
 * The Initial Developer of the Original Code is IT-Solutions4You s.r.o.
 * Portions created by IT-Solutions4You s.r.o. are Copyright(C) IT-Solutions4You s.r.o.
 * All Rights Reserved.
 * ****************************************************************************** */

class MultiCompany4you_MultiCompany4you_Model extends Settings_Vtiger_Module_Model {

    private $version_type;
    private $license_key;
    private $version_no;
    private $profilesPermissions;

    function __construct() {
        $this->log = LoggerManager::getLogger('account');
        $this->db = PearDatabase::getInstance();
        $this->profilesPermissions = array();
        $this->setLicenseInfo();
        $this->name = "MultiCompany4you";
        $this->id = getTabId("MultiCompany4you");
    }

    public function GetVersionType() {
        return $this->version_type;
    }

    public function GetLicenseKey() {
        return $this->license_key;
    }

    public function CheckPermissions($actionKey = '') {
        $current_user = Users_Record_Model::getCurrentUserModel();
        if (Vtiger_Functions::userIsAdministrator($current_user)) {
            return true;
        }
        return false;
    }

    private function setLicenseInfo() {

        $this->version_no = MultiCompany4you_Version_Helper::$version;

        $sql = "SELECT version_type, license_key FROM its4you_multicompany4you_license";
        $result = $this->db->query($sql);
        if ($this->db->num_rows($result) > 0) {
            $this->version_type = $this->db->query_result($result, 0, "version_type");
            $this->license_key = $this->db->query_result($result, 0, "license_key");
        } else {
            $this->version_type = "";
            $this->license_key = "";
        }
    }

}
