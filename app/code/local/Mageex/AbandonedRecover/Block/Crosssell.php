<?php
class Mageex_AbandonedRecover_Block_Crosssell extends Mage_Catalog_Block_Product_Abstract
{
	
	public function __construct()
	{
		$this->setTemplate('abandonedrecover/crosssell.phtml'); 
	}
	public function getProductIds()
	{
		$customerId = $this->getCustomer()->getCustomerId();
		$customer = Mage::getModel('customer/customer')->load($customerId);
		$storeIds = Mage::app()->getStore()->getId();
        $quote = Mage::getModel('sales/quote')
            ->setSharedStoreIds($customer)
            ->loadByCustomer($customer);

        if ($quote) {
            $collectionItems = $quote->getItemsCollection(false);
        }
		
		foreach($collectionItems as $item){
			$ninProductIds[] = $item->getProductId();
		}
		return $ninProductIds;
	}
	public function getItems()
	{
		
		$ninProductIds = $this->getProductIds();
		$crosssells = Mage::getModel('abandonedrecover/getcrosssell')->getCrosssell($ninProductIds);
		return $crosssells;
	}
	public function getItemCount()
	{
		return count($this->getItems());
	}
	public function getProducts()
	{
		$productIds = $this->getProductIds();
		$visibility = array(
					Mage_Catalog_Model_Product_Visibility::VISIBILITY_BOTH,
					Mage_Catalog_Model_Product_Visibility::VISIBILITY_IN_CATALOG
			);
			
		$products = Mage::getModel('catalog/product')->getCollection()
			  ->addAttributeToSelect('*')
			  ->addAttributeToFilter('visibility', $visibility)
			  ->addAttributeToFilter('entity_id', array('in' => $productIds));
		return $products;
	}
}