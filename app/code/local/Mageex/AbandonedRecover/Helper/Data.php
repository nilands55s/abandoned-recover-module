<?php

class Mageex_AbandonedRecover_Helper_Data extends Mage_Core_Helper_Abstract
{
	public function sendMail($host, $subject, $body, $reception, $type='html')
	{
		$config = $this->getConfigEmail();
		$transport = new Zend_Mail_Transport_Smtp($host, $config);

		$mail = new Zend_Mail('utf-8');
		if (strtolower($type) == 'html'){
			$mail->setBodyHtml($body);
		}
		else {
			$mail->setBodyText($body);
		}

		$mail
			->setFrom($reception['fromemail'], $reception['fromname'])
			->addTo($reception['toemail'], $reception['toname'])
			->setSubject($subject);

		$mail->send($transport);
	}
	public function getConfigEmail()
	{
		$config = array(
						'auth' => 'login', 
						'username' => Mage::helper('abandonedrecover/config')->getUserName(), 
						'password' => Mage::helper('abandonedrecover/config')->getPassword()
		);
		return $config;
	}
}