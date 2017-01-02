<?php
//MANAGE API LIMITS, WITH SESSION['BARCHART']=2500, RESET=--;
class DataSource{
	function __construct(){
		session_start();
		$_SESSION['reset']=time();//MAY REQUIRE SEPARATE TIMES FOR EACH API...IS IT EVERY 24 HOURS OR DOES IT RESET AT MIDNIGHT
	}
}
new DataSource;
?>