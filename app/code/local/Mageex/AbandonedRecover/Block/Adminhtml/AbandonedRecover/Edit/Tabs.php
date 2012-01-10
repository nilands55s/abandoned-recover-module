<?php

class Mageex_AbandonedRecover_Block_Adminhtml_AbandonedRecover_Edit_Tabs extends Mage_Adminhtml_Block_Widget_Tabs
{

  public function __construct()
  {
      parent::__construct();
      $this->setId('abandonedrecover_tabs');
      $this->setDestElementId('edit_form');
      $this->setTitle(Mage::helper('abandonedrecover')->__('Item Information'));
  }

  protected function _beforeToHtml()
  {
      $this->addTab('form_section', array(
          'label'     => Mage::helper('abandonedrecover')->__('Item Information'),
          'title'     => Mage::helper('abandonedrecover')->__('Item Information'),
          'content'   => $this->getLayout()->createBlock('abandonedrecover/adminhtml_abandonedrecover_edit_tab_form')->toHtml(),
      ));
     
      return parent::_beforeToHtml();
  }
}