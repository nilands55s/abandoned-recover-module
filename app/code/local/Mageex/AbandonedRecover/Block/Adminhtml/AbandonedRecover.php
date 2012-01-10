<?php
class Mageex_AbandonedRecover_Block_Adminhtml_AbandonedRecover extends Mage_Adminhtml_Block_Widget_Grid_Container
{
  public function __construct()
  {
    $this->_controller = 'adminhtml_abandonedrecover';
    $this->_blockGroup = 'abandonedrecover';
    $this->_headerText = Mage::helper('abandonedrecover')->__('Item Manager');
    $this->_addButtonLabel = Mage::helper('abandonedrecover')->__('Add Item');
    parent::__construct();
  }
}