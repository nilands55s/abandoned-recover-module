<?php

class Mageex_AbandonedRecover_Model_AbandonedRecover extends Mage_Core_Model_Abstract
{
    public function _construct()
    {
        parent::_construct();
        $this->_init('abandonedrecover/abandonedrecover');
    }
}