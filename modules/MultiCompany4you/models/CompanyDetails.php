<?php

/* * *******************************************************************************
 * The content of this file is subject to the MultiCompany4you license.
 * ("License"); You may not use this file except in compliance with the License
 * The Initial Developer of the Original Code is IT-Solutions4You s.r.o.
 * Portions created by IT-Solutions4You s.r.o. are Copyright(C) IT-Solutions4You s.r.o.
 * All Rights Reserved.
 * ****************************************************************************** */

class MultiCompany4you_CompanyDetails_Model extends Settings_Vtiger_Module_Model {

    STATIC $logoSupportedFormats = array('jpeg', 'jpg', 'png', 'gif', 'pjpeg', 'x-png');
    var $baseTable = 'its4you_multicompany4you';
    var $baseIndex = 'companyid';
    var $listFields = array('companyname');
    var $nameFields = array('companyname');
    var $logoPath = 'test/logo/';
    var $actualId;
    var $fields = array(
        'companyname' => 'text',
        'street' => 'textarea',
        'city' => 'text',
        'code' => 'text',
        'state' => 'text',
        'country' => 'text',
        'phone' => 'text',
        'fax' => 'text',
        'email' => 'text',
        'website' => 'text',
        'logoname' => 'text',
        'logo' => 'file',
        'bankname' => 'text',
        'bankaccountno' => 'text',
        'iban' => 'text',
        'swift' => 'text',
        'registrationno' => 'text',
        'vatno' => 'text',
        'taxid' => 'text',
        'stampname' => 'text',
        'stamp' => 'file',
        'additionalinformations' => 'textarea',
        'role' => 'select',
    );

    /**
     * Function to get Edit view Url
     * @return <String> Url
     */
    public function getEditViewUrl() {
        return 'index.php?parent=Settings&module=MultiCompany4you&view=Edit';
    }

    /**
     * Function to get Detail view Url
     * @return <String> Url
     */
    public function getDetailViewUrl(Vtiger_Request $request) {
        if (empty($this->actualId)) {
            $this->actualId = $request->get('companyid');
        }
        return 'index.php?parent=Settings&module=MultiCompany4you&view=Detail&companyid=' . $this->actualId . '&block=' . $request->get('block') . '&fieldid=' . $request->get('fieldid');
    }

    /**
     * Function to get CompanyDetails Menu item
     * @return menu item Model
     */
    public function getMenuItem() {
        $menuItem = Settings_Vtiger_MenuItem_Model::getInstance('LBL_COMPANY_DETAILS');
        return $menuItem;
    }

    /**
     * Function to get Index view Url
     * @return <String> URL
     */
    public function getIndexViewUrl() {
        $menuItem = $this->getMenuItem();
        return 'index.php?parent=Settings&module=MultiCompany4you&view=CompanyList&block=' . $menuItem->get('blockid') . '&fieldid=' . $menuItem->get('fieldid');
    }

    /**
     * Function to get fields
     * @return <Array>
     */
    public function getFields() {
        return $this->fields;
    }

    /**
     * Function to get Logo path to display
     * @return <String> path
     */
    public function getLogoPath() {
        $logoPath = $this->logoPath;
        $handler = @opendir($logoPath);
        $logoName = $this->get('logoname');
        if ($logoName && $handler) {
            while ($file = readdir($handler)) {
                if ($logoName === $file && in_array(str_replace('.', '', strtolower(substr($file, -4))), self::$logoSupportedFormats) && $file != "." && $file != "..") {
                    closedir($handler);
                    return $logoPath . $logoName;
                }
            }
        }
        return '';
    }

    /**
     * Function to save the logoinfo
     */
    public function saveLogo() {
        $uploadDir = vglobal('root_directory') . '/' . $this->logoPath;
        $logoName = $uploadDir . $_FILES["logo"]["name"];
        move_uploaded_file($_FILES["logo"]["tmp_name"], $logoName);
        copy($logoName, $uploadDir . 'application.ico');
    }

    /**
     * Function to get Logo path to display
     * @return <String> path
     */
    public function getStampPath() {
        $logoPath = $this->logoPath;
        $handler = @opendir($logoPath);
        $logoName = $this->get('stampname');
        if ($logoName && $handler) {
            while ($file = readdir($handler)) {
                if ($logoName === $file && in_array(str_replace('.', '', strtolower(substr($file, -4))), self::$logoSupportedFormats) && $file != "." && $file != "..") {
                    closedir($handler);
                    return $logoPath . $logoName;
                }
            }
        }
        return '';
    }

    /**
     * Function to save the logoinfo
     */
    public function saveStamp() {
        $uploadDir = vglobal('root_directory') . '/' . $this->logoPath;
        $logoName = $uploadDir . $_FILES["stamp"]["name"];
        move_uploaded_file($_FILES["stamp"]["tmp_name"], $logoName);
        copy($logoName, $uploadDir . 'application.ico');
    }

    /**
     * Function to save the Company details
     */
    public function save() {
        $db = PearDatabase::getInstance();
        $id = $this->get('id');
        $fieldsList = $this->getFields();
        $tableName = $this->baseTable;

        if ($id) {
            unset($fieldsList['logo'], $fieldsList['stamp']);
            $params = array();

            $query = "UPDATE $tableName SET ";
            foreach ($fieldsList as $fieldName => $fieldType) {
                $query .= " $fieldName = ?, ";
                array_push($params, $this->get($fieldName));
            }
            $query .= " logo = NULL WHERE " . $this->baseIndex . " = ?";

            array_push($params, $id);
        } else {
            unset($fieldsList['stamp']);
            $params = $this->getData();

            $query = "INSERT INTO $tableName (";
            foreach ($fieldsList as $fieldName => $fieldType) {
                $query .= " $fieldName,";
            }
            $query .= " " . $this->baseIndex . ") VALUES (" . generateQuestionMarks($params) . ", ?)";
            $this->actualId = $db->getUniqueID($this->baseTable);
            array_push($params, $this->actualId);
        }
        $db->pquery($query, $params);
    }

    /**
     * Function to get the instance of Company details module model
     * @return <Settings_Vtiger_CompanyDetais_Model> $moduleModel
     */
    public static function getInstance() {
        $moduleModel = new self();
        $db = PearDatabase::getInstance();
        $sql = "SELECT " . $moduleModel->baseTable . ".*, vtiger_role.rolename FROM its4you_multicompany4you LEFT JOIN vtiger_role ON vtiger_role.roleid=its4you_multicompany4you.role";
        $companyid = $moduleModel->get('id');
        if ($companyid) {
            $sql .= " WHERE " . $moduleModel->baseIndex . "=$companyid";
        }
        $result = $db->pquery($sql, array());
        if ($db->num_rows($result) > 0) {
            $moduleModel->setData($db->query_result_rowdata($result));
            $moduleModel->set('id', $moduleModel->get('companyid'));
        }

        $moduleModel->getFields();
        return $moduleModel;
    }

    /**
     * Function to get the instance of Company details module model
     * @return <Settings_Vtiger_CompanyDetais_Model> $moduleModel
     */
    public static function getDetailInstance(Vtiger_Request $request) {
        $moduleModel = new self();
        $db = PearDatabase::getInstance();
        $sql = "SELECT " . $moduleModel->baseTable . ".*, vtiger_role.rolename FROM its4you_multicompany4you LEFT JOIN vtiger_role ON vtiger_role.roleid=its4you_multicompany4you.role";
        $companyid = $request->get('companyid');
        if ($companyid) {
            $sql .= " WHERE " . $moduleModel->baseIndex . "=$companyid";
        }
        $result = $db->pquery($sql, array());
        if ($db->num_rows($result) > 0) {
            $moduleModel->setData($db->query_result_rowdata($result));
            $moduleModel->set('id', $moduleModel->get('companyid'));
        }

        $moduleModel->getFields();
        return $moduleModel;
    }

    /**
     * Function to get the instance of Company details module model
     * @return <Settings_Vtiger_CompanyDetais_Model> $moduleModel
     */
    public static function getEditInstance(Vtiger_Request $request) {
        $db = PearDatabase::getInstance();
        $moduleModel = new self();
        $companyid = $request->get('companyid');
        if (is_numeric($companyid)) {
            $sql = "SELECT " . $moduleModel->baseTable . ".*, vtiger_role.rolename FROM its4you_multicompany4you LEFT JOIN vtiger_role ON vtiger_role.roleid=its4you_multicompany4you.role";
            $sql .= " WHERE " . $moduleModel->baseIndex . "=$companyid";
            $result = $db->pquery($sql, array());
            if ($db->num_rows($result) > 0) {
                $moduleModel->setData($db->query_result_rowdata($result));
                $moduleModel->set('id', $companyid);
            }
        }
        $moduleModel->getFields();
        return $moduleModel;
    }

}
