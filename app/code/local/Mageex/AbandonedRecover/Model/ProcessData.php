<?php
class Mageex_AbandonedRecover_Model_ProcessData extends Mage_Core_Model_Abstract
{
	
	public function sendMail()
	{
		
		// Set sender information
		$senderName 	= Mage::helper('abandonedrecover/config')->getSenderName();
		$senderEmail 	= Mage::helper('abandonedrecover/config')->getSenderEmail();
		
		// Get Store ID
		$storeId = Mage::app()->getStore()->getId();       
		
		$template = Mage::getModel('core/email_template');
		$emailTemplateId = Mage::helper('abandonedrecover/config')->getEmailTemplateId();
		$modelEmailTemplate = Mage::getModel('adminhtml/email_template')->load($emailTemplateId);
		
		$template->setTemplateStyles($modelEmailTemplate->getTemplateStyles());
		$template->setTemplateText($modelEmailTemplate->getTemplateText());
		
		$host = Mage::helper('abandonedrecover/config')->getHost();
		$subject = $modelEmailTemplate->getTemplateSubject();
		
		$collection = Mage::getResourceModel('reports/quote_collection');
		$storeIds = Mage::app()->getStore()->getId();
		$collection->prepareForAbandonedReport($storeIds);
		
		foreach ( $collection as $item ) {
			
			$vars = array();
			$reception = array();
			$reception['fromemail']  = $senderEmail;
			$reception['fromname']   = $senderName;
			$reception['toemail']  	 = $item->getCustomerEmail();
			$reception['toname'] 	 = $item->getCustomerName();
			$vars['order'] = $item;
			$vars['abandoned_customer'] = $item;
			$template->setDesignConfig(array('area'=>'frontend', 'store'=>$storeId));
			Varien_Profiler::start("email_template_proccessing");
			
			$templateProcessed = $template->getProcessedTemplate($vars, true);

			Varien_Profiler::stop("email_template_proccessing");
			
			Mage::helper('abandonedrecover')->sendMail($host,$subject, $templateProcessed, $reception);
		}
		
		return true;
	}
	
}