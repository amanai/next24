<?php

class ARTICLE_COMPETITION_STATUS {
	const COMPLETE			= 0;
	const SHOW_IN_CATALOG 	= 1;
	const EDITED			= 2;
	const IN_RATE			= 3;
	const NEW_ARTICLE		= 4;	
	const WINNER			= 5;
	
	const COMPETITION_START = 0;
	const COMPETITION_VOTE	= 1;
	const COMPETITION_FINAL = 2;
	
	public static function getCompetitionStage() {
		$date_time = localtime();
		if(($date_time[6] >= 1 && ($date_time[6] <= 2) || ($date_time[6] == 3 && $date_time[2] < 18))){
			return self::COMPETITION_START;
		}
		if(($date_time[6] > 3 || ($date_time[6] == 3 && $date_time[2] > 18)) && ($date_time[6] < 5 || ($date_time[6] == 5 && $date_time[2] < 18))) {
			return self::COMPETITION_VOTE;
		}
		if($date_time[6] > 5 || $date_time[6] == 0 || ($date_time[6] == 5 && $date_time[2] > 17)) {
			return self::COMPETITION_FINAL;
		}
	}
}

?>