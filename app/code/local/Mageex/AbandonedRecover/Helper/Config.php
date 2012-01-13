<?php
class Mageex_AbandonedRecover_Helper_Config extends Mage_Core_Helper_Abstract
{
	protected $_storeId;
	public function __construct()
	{
		$this->_storeId = Mage::app()->getStore()->getId();
	}
	public function isEnable()
	{
		return Mage::getStoreConfig('abandonedrecover/general/enabled', $this->_storeId);
	}
	public function getHost()
	{
		return Mage::getStoreConfig('abandonedrecover/email/host', $this->_storeId);
	}
	public function getUserName()
	{
		return Mage::getStoreConfig('abandonedrecover/email/username', $this->_storeId);
	}
	public function getPassword()
	{
		return Mage::getStoreConfig('abandonedrecover/email/password', $this->_storeId);
	}
	public function getSenderName()
	{
		return Mage::getStoreConfig('abandonedrecover/email/sendername', $this->_storeId);
	}
	public function getSenderEmail()
	{
		return Mage::getStoreConfig('abandonedrecover/email/senderemail', $this->_storeId);
	}
	public function getEmailTemplateId()
	{
		return Mage::getStoreConfig('abandonedrecover/email/email_template', $this->_storeId);
	} 
}