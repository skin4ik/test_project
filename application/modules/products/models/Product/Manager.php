<?php

/**
 * This is the DbTable class for the users table.
 *
 * @category Application
 * @package Model
 * @subpackage DbTable
 */
class Products_Model_Product_Manager extends Core_Model_Manager
{

    public function createTires($data)
    {
        $randomName = md5(microtime());
        move_uploaded_file($_FILES['upload_image']['tmp_name'], UPLOAD_PATH . '/imagestires/' . $randomName);

        $brandInfo = explode('/', $data['brand_id'], 2);
        $fixedName = $brandInfo['1'] . " " . $data['model'] . " " . $data['width_tire'] . "/" . $data['profile_tire'] . $data['diameter_tire'] . " " . $data['seasonality_tire'];
        $arrReplace = array('/', ' ');
        $data = array(
            'name' => $fixedName,
            'category_id' => $data['category_id'],
            'image_path' => '/uploads/imagestires/' . $randomName,
            'width_tire' => $data['width_tire'],
            'profile_tire' => $data['profile_tire'],
            'diameter_tire' => $data['diameter_tire'],
            'seasonality_tire' => $data['seasonality_tire'],
            'brand_id' => $brandInfo['0'],
            'model' => $data['model'],
            'alias' => mb_strtolower(str_replace($arrReplace, '-', $fixedName), 'UTF-8')
        );

        $createTires = $this->getDbTable()->createRow($data);
        if ($createTires->save()) {
            return $createTires;
        }
        return false;
    }

    public function createDiscs($data)
    {
        $randomName = md5(microtime());
        move_uploaded_file($_FILES['upload_image']['tmp_name'], UPLOAD_PATH . '/imagesdiscs/' . $randomName);

        $brandInfo = explode('/', $data['brand_id'], 2);
        $fixedName = $brandInfo['1'] . " " . $data['model'] . " " . $data['type_disc'] . " " . $data['diameter_disc'] . " W" . $data['width_disc'] . " PCD" . $data['pcd_disc'] . " ET" . $data['et_disc'];
        $arrReplace = array('/', ' ');
        $data = array(
            'name' => $fixedName,
            'category_id' => $data['category_id'],
            'image_path' => '/uploads/imagesdiscs/' . $randomName,
            'width_disc' => $data['width_disc'],
            'diameter_disc' => $data['diameter_disc'],
            'type_disc' => $data['type_disc'],
            'pcd_disc' => $data['pcd_disc'],
            'et_disc' => $data['et_disc'],
            'brand_id' => $brandInfo['0'],
            'model' => $data['model'],
            'alias' => mb_strtolower(str_replace($arrReplace, '-', $fixedName), 'UTF-8')
        );
        $createTires = $this->getDbTable()->createRow($data);
        if ($createTires->save()) {
            return $createTires;
        }
        return false;
    }

}