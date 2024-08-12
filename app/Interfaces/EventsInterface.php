<?php
 namespace App\Interfaces;
 interface EventsInterface
 {
 	public function save(array $data);
 	
 	public function fetch($from,$to,$ids);

 }
?>