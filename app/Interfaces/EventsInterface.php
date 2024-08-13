<?php
 namespace App\Interfaces;
 interface EventsInterface
 {
 	public function overlappingOnce($startdate, $enddate, $duration,$invitees,$expected_enddatetime);
 	public function overlappingWeek($startdate, $enddate, $duration,$invitees,$expected_enddatetime);
 	public function overlappingMonth($startdate, $enddate, $duration,$invitees,$expected_enddatetime);
 	public function isoverlapping($request,$expected_enddatetime);

 	public function save(array $data);
 	
 	public function fetch($from,$to,$ids);

 }
?>