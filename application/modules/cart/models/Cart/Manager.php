<?php

/**
 * This is the DbTable class for the users table.
 *
 * @category Application
 * @package Model
 * @subpackage DbTable
 */
class Cart_Model_Cart_Manager extends Core_Model_Manager
{
    public function getRequestInfo($requestId)
    {
        $selectRequestInfo = $this->getDbTable()->select()->setIntegrityCheck(false)
            ->from(array('requests_to_purchase'), array('username', 'telephone'))
            ->join(array('product_to_providers'), 'product_to_providers.id = requests_to_purchase.product_id')
            ->join(array('products'), 'product_to_providers.product_id = products.id')
            ->where('requests_to_purchase.request_id = ?', $requestId);
        $arrProductInfo = $this->getDBTable()->fetchAll($selectRequestInfo)->toArray();

        return $arrProductInfo;
    }

    public function removeRequest($requestId)
    {
        $where = $this->getDbTable()->getAdapter()->quoteInto('request_id = ?', $requestId);
        $this->getDbTable()->delete($where);

    }


}