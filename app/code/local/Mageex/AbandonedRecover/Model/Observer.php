<?php
class Mageex_AbandonedRecover_Model_Observer 
{

    /**
     * Cronjob expression configuration
     */
    const XML_PATH_CRON_EXPR = 'crontab/jobs/abandonedrecover_sendmail/schedule/cron_expr';
	
	
	public function scheduledCron($schedule)
	{
		if (!Mage::helper('abandonedrecover/config')->isEnable()) {
            return;
        }	
		try{
			
			$status = Mage::getModel('abandonedrecover/processdata')->sendMail();
		}catch(Exception $e){
				Mage::log($e->getMessage());
		}
		
		if($status){
			return;
		}
	}
	
	
}