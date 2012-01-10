<?php
class Mageex_AbandonedRecover_IndexController extends Mage_Core_Controller_Front_Action
{
    public function indexAction()
    {
    	
    	/*
    	 * Load an object by id 
    	 * Request looking like:
    	 * http://site.com/abandonedrecover?id=15 
    	 *  or
    	 * http://site.com/abandonedrecover/id/15 	
    	 */
    	/* 
		$abandonedrecover_id = $this->getRequest()->getParam('id');

  		if($abandonedrecover_id != null && $abandonedrecover_id != '')	{
			$abandonedrecover = Mage::getModel('abandonedrecover/abandonedrecover')->load($abandonedrecover_id)->getData();
		} else {
			$abandonedrecover = null;
		}	
		*/
		
		 /*
    	 * If no param we load a the last created item
    	 */ 
    	/*
    	if($abandonedrecover == null) {
			$resource = Mage::getSingleton('core/resource');
			$read= $resource->getConnection('core_read');
			$abandonedrecoverTable = $resource->getTableName('abandonedrecover');
			
			$select = $read->select()
			   ->from($abandonedrecoverTable,array('abandonedrecover_id','title','content','status'))
			   ->where('status',1)
			   ->order('created_time DESC') ;
			   
			$abandonedrecover = $read->fetchRow($select);
		}
		Mage::register('abandonedrecover', $abandonedrecover);
		*/

			
		$this->loadLayout();     
		$this->renderLayout();
    }
}