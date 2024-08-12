<?php
namespace App\Repositories;
use App\Interfaces\EventInviteeInterface;
use App\Models\EventInvitee;

class EventsInviteeRepository implements EventInviteeInterface
{
	public function save(array $data)
	{
		  
		   return EventInvitee::create($data);

	}
 	
 	

	
}
?>