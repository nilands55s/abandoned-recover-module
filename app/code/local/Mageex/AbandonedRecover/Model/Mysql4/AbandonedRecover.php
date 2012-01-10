<?php

class Mageex_AbandonedRecover_Model_Mysql4_AbandonedRecover extends Mage_Core_Model_Mysql4_Abstract
{
    public function _construct()
    {    
        // Note that the abandonedrecover_id refers to the key field in your database table.
        $this->_init('abandonedrecover/abandonedrecover', 'abandonedrecover_id');
    }
}