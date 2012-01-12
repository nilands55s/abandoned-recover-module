<?php
class Mageex_AbandonedRecover_IndexController extends Mage_Core_Controller_Front_Action
{
    public function indexAction()
    {
		/*
    	$collection = Mage::getResourceModel('reports/quote_collection');
		$storeIds = Mage::app()->getStore()->getId();
		$collection->prepareForAbandonedReport($storeIds);
		
		foreach($collection as $item){
			$customerId = $item->getCustomerId();
			echo $this->getLayout()->createBlock('abandonedrecover/crosssell')->setData('customer',$customerId)->toHtml();
		}
		
    	exit;
		*/
		$status = Mage::getModel('abandonedrecover/processdata')->sendMail();
    }
}