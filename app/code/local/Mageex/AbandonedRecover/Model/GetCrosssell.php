<?php
class Mageex_AbandonedRecover_Model_GetCrosssell extends Mage_Catalog_Block_Product_Abstract
{
	/**
     * Items quantity will be capped to this value
     *
     * @var int
     */
	protected $_maxItemCount = 4;
	
	public function getCrosssell($ninProductIds)
	{
		$items = array();
		
		$collection = $this->_getCollection()
			->addProductFilter($ninProductIds)
			->addExcludeProductFilter($ninProductIds)
			->setPageSize($this->_maxItemCount)
			->setGroupBy()
			->setPositionOrder()
			->load();
		//echo $collection->getSelect();
		foreach ($collection as $item) {
			$items[] = $item;
		}
		
		return $items;
	}
	/**
     * Get crosssell products collection
     *
     * @return Mage_Catalog_Model_Resource_Eav_Mysql4_Product_Link_Product_Collection
     */
	protected function _getCollection()
    {
        $collection = Mage::getModel('catalog/product_link')->useCrossSellLinks()
            ->getProductCollection()
            ->setStoreId(Mage::app()->getStore()->getId())
            ->addStoreFilter()
            ->setPageSize($this->_maxItemCount);
		$this->_addProductAttributesAndPrices($collection);
	
		Mage::getSingleton('catalog/product_status')->addSaleableFilterToCollection($collection);
        Mage::getSingleton('catalog/product_visibility')->addVisibleInCatalogFilterToCollection($collection);
        Mage::getSingleton('cataloginventory/stock')->addInStockFilterToCollection($collection);

        return $collection;
    }
}