<?php
class Mageex_AbandonedRecover_Block_AbandonedRecover extends Mage_Core_Block_Template
{
	public function _prepareLayout()
    {
		return parent::_prepareLayout();
    }
    
     public function getAbandonedRecover()     
     { 
        if (!$this->hasData('abandonedrecover')) {
            $this->setData('abandonedrecover', Mage::registry('abandonedrecover'));
        }
        return $this->getData('abandonedrecover');
        
    }
}