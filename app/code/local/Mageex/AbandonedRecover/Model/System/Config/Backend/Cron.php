<?php
class Mageex_AbandonedRecover_Model_System_Config_Backend_Cron extends Mage_Core_Model_Config_Data
{

    const CRON_STRING_PATH = 'crontab/jobs/abandonedrecover_sendmail/schedule/cron_expr';
    const CRON_MODEL_PATH = 'crontab/jobs/abandonedrecover_sendmail/run/model';
	
    protected function _afterSave()
    {
        
        $time = $this->getData('groups/general/fields/time_start/value');
		
        $frequency = $this->getData('groups/general/fields/frequency/value');
        
        $frequencyDaily 	= Mageex_AbandonedRecover_Model_System_Config_Source_Frequency::CRON_DAILY;
        $frequencyWeekly 	= Mageex_AbandonedRecover_Model_System_Config_Source_Frequency::CRON_WEEKLY;
        $frequencyMonthly 	= Mageex_AbandonedRecover_Model_System_Config_Source_Frequency::CRON_MONTHLY;
		
		
        $cronDayOfWeek = date('N');
		
		if($frequency == $frequencyCustom){
			$datefrom 	= $this->getData('groups/general/fields/date_start/value');
			//$datearr	= explode('-',$datefrom);
			$dayOfWeek 	= date('N',strtotime($datefrom));
			$monthOfYear= date('n',strtotime($datefrom));
			$dayOfMonth	= date('j',strtotime($datefrom));
			$cronExprArray = array(
				intval($time[1]),                                   # Minute
				intval($time[0]),                                   # Hour
				$dayOfMonth,      									# Day of the Month
				$monthOfYear,                                       # Month of the Year
				$dayOfWeek,       									# Day of the Week
			);
		}else{
			$cronExprArray = array(
				intval($time[1]),                                   # Minute
				intval($time[0]),                                   # Hour
				($frequency == $frequencyMonthly) ? '1' : '*',      # Day of the Month
				'*',                                                # Month of the Year
				($frequency == $frequencyWeekly) ? '1' : '*',       # Day of the Week
			);
		}
        $cronExprString = join(' ', $cronExprArray);
		
        try {
            Mage::getModel('core/config_data')
                ->load(self::CRON_STRING_PATH, 'path')
                ->setValue($cronExprString)
                ->setPath(self::CRON_STRING_PATH)
                ->save();
            Mage::getModel('core/config_data')
                ->load(self::CRON_MODEL_PATH, 'path')
                ->setValue((string) Mage::getConfig()->getNode(self::CRON_MODEL_PATH))
                ->setPath(self::CRON_MODEL_PATH)
                ->save();
        } catch (Exception $e) {
            throw new Exception(Mage::helper('cron')->__('Unable to save the cron expression.'));
        }
    }

}
