<?php

/**
 * User entity Model
 *
 * @todo http://www.zimuel.it/blog/?p=86
 * @category Application
 * @package Model
 */
class Cart_Model_Cart extends Core_Db_Table_Row_Abstract
{
    public function getProductsFromCart()
    {
        if (!isset($_SESSION['id']) || count($_SESSION['id']) == 0) {
            $arrProductInfo = 'No products';
        } else {
            $selectProductInfo = $this->getTable()->select()->setIntegrityCheck(false)
                ->from(array('products'), array('name', 'category_id', 'image_path', 'width_tire', 'profile_tire', 'diameter_tire', 'seasonality_tire', 'diameter_disc', 'type_disc', 'width_disc', 'pcd_disc', 'et_disc', 'brand_id', 'model', 'created', 'updated', 'alias'))
                ->join(array('product_to_providers'), 'product_to_providers.product_id = products.id')
                ->where('product_to_providers.id IN(?)', $_SESSION['id']);
            $arrProductInfo = $this->getTable()->fetchAll($selectProductInfo)->toArray();
        }
        return $arrProductInfo;
    }

    public function saveRequestToPurchase($arrProductsId, $data)
    {
        $randomRequestId = md5(microtime());
        foreach ($arrProductsId as $productId) {
            $dataResult = array(
                'username' => $data['username'],
                'telephone' => $data['telephone'],
                'product_id' => $productId,
                'request_id' => $randomRequestId,
            );
            $request = $this->getTable()->createRow($dataResult);
            $request->save();
        }
    }

}