<?php
class Mageex_AbandonedRecover_IndexController extends Mage_Core_Controller_Front_Action
{
    public function indexAction()
    {
    	$collection = Mage::getResourceModel('reports/quote_collection');
		$storeIds = Mage::app()->getStore()->getId();
		$collection->prepareForAbandonedReport($storeIds);
		
		foreach($collection as $item){
			echo '<pre>';
			print_r($item->getSubtotal());
			echo '</pre>';
		}
    	exit;
    }
}