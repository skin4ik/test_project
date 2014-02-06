<?php

/**
 * User entity Model
 *
 * @todo http://www.zimuel.it/blog/?p=86
 * @category Application
 * @package Model
 */
class Products_Model_Product extends Core_Db_Table_Row_Abstract
{
    const CATEGORY_TIRES_ID = 1;
    const CATEGORY_DISCS_ID = 2;

    public function getProductInfo($productAlias)
    {
        $selectProductInfo = $this->getTable()->select()->setIntegrityCheck(false)
            ->from(array('products'), array('name', 'category_id', 'image_path', 'width_tire', 'profile_tire', 'diameter_tire', 'seasonality_tire', 'diameter_disc', 'type_disc', 'width_disc', 'pcd_disc', 'et_disc', 'brand_id', 'model', 'created', 'updated', 'alias', 'MIN(`product_to_providers`.`price_out`)'))
            ->join(array('product_to_providers'), 'product_to_providers.product_id = products.id')
            ->where('alias=?', $productAlias)
            ->where('count!=?', '0')
            ->where('price_out=?', $this->getMinPriceForProduct($productAlias))
            ->group(array('products.alias'));
        $arrProductInfo = $this->getTable()->fetchAll($selectProductInfo)->toArray();

        $nameThisProduct = $arrProductInfo[0]['name'];
        $brandThisProduct = $arrProductInfo[0]['brand_id'];
        $modelThisProduct = $arrProductInfo[0]['model'];
        $selectProductInfo = $this->getTable()->select()->setIntegrityCheck(false)
            ->from(array('products'), array('name', 'category_id', 'image_path', 'width_tire', 'profile_tire', 'diameter_tire', 'seasonality_tire', 'diameter_disc', 'type_disc', 'width_disc', 'pcd_disc', 'et_disc', 'brand_id', 'model', 'created', 'updated', 'alias', 'MIN(`product_to_providers`.`price_out`)'))
            ->join(array('product_to_providers'), 'product_to_providers.product_id = products.id')
            ->where('brand_id=?', $brandThisProduct)
            ->where('model=?', $modelThisProduct)
            ->where('name!=?', $nameThisProduct)
            ->where('count!=?', '0')
            ->group(array('products.name'))
            ->order('width_tire', 'width_disk');
        $arrSimilarProductsInfo = $this->getTable()->fetchAll($selectProductInfo)->toArray();

        $arrProductInfoResult = array();
        foreach ($arrProductInfo as $productInfo) {
            if ($productInfo['category_id'] == self::CATEGORY_TIRES_ID) {
                $arrProductInfoResult['name'] = $productInfo['name'];
                $arrProductInfoResult['category_id'] = $productInfo['category_id'];
                $arrProductInfoResult['image_path'] = $productInfo['image_path'];
                $arrProductInfoResult['width_tire'] = $productInfo['width_tire'];
                $arrProductInfoResult['profile_tire'] = $productInfo['profile_tire'];
                $arrProductInfoResult['diameter_tire'] = $productInfo['diameter_tire'];
                $arrProductInfoResult['seasonality_tire'] = $productInfo['seasonality_tire'];
                $arrProductInfoResult['brand_id'] = $productInfo['brand_id'];
                $arrProductInfoResult['model'] = $productInfo['model'];
                $arrProductInfoResult['price_out'] = $productInfo['MIN(`product_to_providers`.`price_out`)'];
                $arrProductInfoResult['id'] = $productInfo['id'];

            } elseif ($productInfo['category_id'] == self::CATEGORY_DISCS_ID) {
                $arrProductInfoResult['name'] = $productInfo['name'];
                $arrProductInfoResult['category_id'] = $productInfo['category_id'];
                $arrProductInfoResult['image_path'] = $productInfo['image_path'];
                $arrProductInfoResult['width_disc'] = $productInfo['width_disc'];
                $arrProductInfoResult['diameter_disc'] = $productInfo['diameter_disc'];
                $arrProductInfoResult['type_disc'] = $productInfo['type_disc'];
                $arrProductInfoResult['pcd_disc'] = $productInfo['pcd_disc'];
                $arrProductInfoResult['et_disc'] = $productInfo['et_disc'];
                $arrProductInfoResult['brand_id'] = $productInfo['brand_id'];
                $arrProductInfoResult['model'] = $productInfo['model'];
                $arrProductInfoResult['price_out'] = $productInfo['MIN(`product_to_providers`.`price_out`)'];
                $arrProductInfoResult['id'] = $productInfo['id'];
            }
        }
        $arrSimilarProductsInfoResult = array();
        $arrSimilarProductInfoResult = array();
        foreach ($arrSimilarProductsInfo as $similarProductInfo) {
            if ($similarProductInfo['category_id'] == self::CATEGORY_TIRES_ID) {
                $arrSimilarProductInfoResult['name'] = $similarProductInfo['name'];
                $arrSimilarProductInfoResult['category_id'] = $similarProductInfo['category_id'];
                $arrSimilarProductInfoResult['image_path'] = $similarProductInfo['image_path'];
                $arrSimilarProductInfoResult['width_tire'] = $similarProductInfo['width_tire'];
                $arrSimilarProductInfoResult['profile_tire'] = $similarProductInfo['profile_tire'];
                $arrSimilarProductInfoResult['diameter_tire'] = $similarProductInfo['diameter_tire'];
                $arrSimilarProductInfoResult['seasonality_tire'] = $similarProductInfo['seasonality_tire'];
                $arrSimilarProductInfoResult['brand_id'] = $similarProductInfo['brand_id'];
                $arrSimilarProductInfoResult['model'] = $similarProductInfo['model'];
                $arrSimilarProductInfoResult['alias'] = $similarProductInfo['alias'];
                $arrSimilarProductInfoResult['price_out'] = $similarProductInfo['MIN(`product_to_providers`.`price_out`)'];

            } elseif ($similarProductInfo['category_id'] == self::CATEGORY_DISCS_ID) {
                $arrSimilarProductInfoResult['name'] = $similarProductInfo['name'];
                $arrSimilarProductInfoResult['category_id'] = $similarProductInfo['category_id'];
                $arrSimilarProductInfoResult['image_path'] = $similarProductInfo['image_path'];
                $arrSimilarProductInfoResult['width_disc'] = $similarProductInfo['width_disc'];
                $arrSimilarProductInfoResult['diameter_disc'] = $similarProductInfo['diameter_disc'];
                $arrSimilarProductInfoResult['type_disc'] = $similarProductInfo['type_disc'];
                $arrSimilarProductInfoResult['pcd_disc'] = $similarProductInfo['pcd_disc'];
                $arrSimilarProductInfoResult['et_disc'] = $similarProductInfo['et_disc'];
                $arrSimilarProductInfoResult['brand_id'] = $similarProductInfo['brand_id'];
                $arrSimilarProductInfoResult['model'] = $similarProductInfo['model'];
                $arrSimilarProductInfoResult['alias'] = $similarProductInfo['alias'];
                $arrSimilarProductInfoResult['price_out'] = $similarProductInfo['MIN(`product_to_providers`.`price_out`)'];
            }
            $arrSimilarProductsInfoResult[] = $arrSimilarProductInfoResult;
        }
        $arrProductInfoArrays = array();
        $arrProductInfoArrays['arrProductInfoResult'] = $arrProductInfoResult;
        $arrProductInfoArrays['arrSimilarProductInfoResult'] = $arrSimilarProductsInfoResult;

        return $arrProductInfoArrays;
    }

    public function getSelect($category)
    {
        $select = $this->select()->setIntegrityCheck(false);
        $select->from(array('products'), array('name', 'category_id', 'image_path', 'width_tire', 'profile_tire', 'diameter_tire', 'seasonality_tire', 'diameter_disc', 'type_disc', 'width_disc', 'pcd_disc', 'et_disc', 'brand_id', 'model', 'created', 'updated', 'alias', 'MIN(`product_to_providers`.`price_out`)'))
            ->join(array('product_to_providers'), 'product_to_providers.product_id = products.id')
            ->where('category_id=?', $category)
            ->where('count!=?', '0')
            ->group(array('products.name'));

        return $select;
    }

    public function getMinPriceForProduct($productAlias)
    {
        $selectProductForMinPrice = $this->getTable()->select()->setIntegrityCheck(false)
            ->from(array('products'), array('MIN(`product_to_providers`.`price_out`)'))
            ->join(array('product_to_providers'), 'product_to_providers.product_id = products.id')
            ->where('alias=?', $productAlias);
        $arrSelectProductForMinPrice = $this->getTable()->fetchAll($selectProductForMinPrice)->toArray();
        foreach ($arrSelectProductForMinPrice as $minProductPrice) ;
        return $minProductPrice['MIN(`product_to_providers`.`price_out`)'];
    }

    public function getSearchResults($data)
    {
        if ($data['category_id'] != 'all') {
            if ($data['category_id'] == self::CATEGORY_TIRES_ID) {
                $selectFilteredProducts = $this->getTable()->select()->setIntegrityCheck(false)
                    ->from(array('products'), array('name', 'category_id', 'image_path', 'width_tire', 'profile_tire', 'diameter_tire', 'seasonality_tire', 'brand_id', 'model', 'created', 'updated', 'alias', 'MIN(`product_to_providers`.`price_out`)'))
                    ->join(array('product_to_providers'), 'product_to_providers.product_id = products.id')
                    ->where('category_id=?', $data['category_id'])
                    ->where('count!=?', '0')
                    ->where('width_tire LIKE ?', $data['width_tire'])
                    ->where('profile_tire LIKE ?', $data['profile_tire'])
                    ->where('diameter_tire LIKE ?', $data['diameter_tire'])
                    ->where('seasonality_tire LIKE ?', $data['seasonality_tire'])
                    ->group(array('product_id'));
                return $selectFilteredProducts;
            } elseif ($data['category_id'] == self::CATEGORY_DISCS_ID) {
                $selectFilteredProducts = $this->getTable()->select()->setIntegrityCheck(false)
                    ->from(array('products'), array('name', 'category_id', 'image_path', 'diameter_disc', 'type_disc', 'width_disc', 'pcd_disc', 'et_disc', 'brand_id', 'model', 'created', 'updated', 'alias', 'MIN(`product_to_providers`.`price_out`)'))
                    ->join(array('product_to_providers'), 'product_to_providers.product_id = products.id')
                    ->where('category_id=?', $data['category_id'])
                    ->where('count!=?', '0')
                    ->where('diameter_disc LIKE ?', $data['diameter_disc'])
                    ->where('type_disc LIKE ?', $data['type_disc'])
                    ->where('width_disc LIKE ?', $data['width_disc'])
                    ->where('et_disc LIKE ?', $data['et_disc'])
                    ->where('pcd_disc LIKE ?', $data['pcd_disc'])
                    ->group(array('product_id'));
                return $selectFilteredProducts;
            }

        } else {
            $selectFilteredProducts = $this->getTable()->select()->setIntegrityCheck(false)
                ->from(array('products'), array('name', 'category_id', 'image_path', 'width_tire', 'profile_tire', 'diameter_tire', 'seasonality_tire', 'diameter_disc', 'type_disc', 'width_disc', 'pcd_disc', 'et_disc', 'brand_id', 'model', 'created', 'updated', 'alias', 'MIN(`product_to_providers`.`price_out`)'))
                ->join(array('product_to_providers'), 'product_to_providers.product_id = products.id')
                ->where('count!=?', '0')
                ->where('name LIKE ?', "%" . $data['target_search'] . "%")
                ->group(array('product_id'));
            return $selectFilteredProducts;
        }
        return false;
    }

}