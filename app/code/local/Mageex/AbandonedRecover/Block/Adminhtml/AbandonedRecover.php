<?php
class Mageex_AbandonedRecover_Block_Adminhtml_AbandonedRecover extends Mage_Adminhtml_Block_Widget_Grid_Container
{
  public function __construct()
  {
    $this->_controller = 'adminhtml_abandonedrecover';
    $this->_blockGroup = 'abandonedrecover';
    $this->_headerText = Mage::helper('abandonedrecover')->__('Abandoned Recover Manager');
    parent::__construct();
  }
}