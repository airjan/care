<?php
namespace App\Repositories;
use App\Interfaces\EventsInterface;
use App\Models\Events;

class EventsRepository implements EventsInterface
{
	public function save(array $data)
	{
		  
		   return Events::create($data);

	}
 	
 	public function fetch($from,$to,$ids)
 	{
 		$events = Events::query(); // prepare query

 		
 		if (count($ids) <> 0){
 			  $events = $events->whereHas('invitees', function ($query) use ($ids) {
        
        		$query->whereIn('user_id', $ids);
    			})->with(['invitees' => function ($query) use ($ids) {
        		$query->whereIn('user_id', $ids);
        	}]);
 		}  else {

 			$events = $events->with('invitees');
 		}

 		$events = $events->get();
 		
 		return $events;
 	}

	
}
?>