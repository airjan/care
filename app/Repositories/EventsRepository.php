<?php
namespace App\Repositories;
use App\Interfaces\EventsInterface;
use App\Models\Events;
use Carbon\Carbon;
class EventsRepository implements EventsInterface
{
	public function overlappingOnce($startDate, $endDate, $duration,$invitees,$expected_enddatetime)
	{
		$results =  Events::where('startDateTime' ,'<=', $startDate)
				->where('expected_enddatetime','>=', $startDate)->get();
		
		if ($results->count() > 0)
		{
			foreach ($results as $k => $v) {
				$existingInvitee = $v->invitees->pluck('user_id')->toArray();
				$attendeesFound = array_intersect($existingInvitee, $invitees);
				if ($attendeesFound){
					return true;
					break;
				}
			}
		} 
		return false;

	}
	public function overlappingWeek($startdate, $enddate, $duration,$invitees,$expected_enddatetime)
	{
		$tDayweek = Carbon::parse($startdate)->dayOfweek();

		$results = Events::whereDay('startDateTime','=',$tDayweek)
					->where('startDateTime','<=', $enddate)
					->where('expected_enddatetime','>',$startdate)->get();
		if ($results->count() > 0) {
			foreach ($results as $k => $v) {
				$existingInvitee = $v->invitees->pluck('user_id')->toArray();
				$attendeesFound = array_intersect($existingInvitee, $invitees);
				if ($attendeesFound){
					return true;
					break;
				}
			}
		}

		return false;
	}
	public function overlappingMonth($startdate, $enddate, $duration,$invitees,$expected_enddatetime)
	{
		$tMonth = Carbon::parse($startdate)->day();

		$results = Events::whereDay('startDateTime','=',$tMonth)
					->where('startDateTime','<=', $enddate)
					->where('expected_enddatetime','>',$startdate)->get();
		if ($results->count() > 0) {
			foreach ($results as $k => $v) {
				$existingInvitee = $v->invitees->pluck('user_id')->toArray();
				$attendeesFound = array_intersect($existingInvitee, $invitees);
				if ($attendeesFound){
					return true;
					break;
				}
			}
		}
		return false;
	}
	public function isoverlapping($request,$expected_enddatetime)
	{
		if (self::overlappingOnce($request->input('startDateTime'),$request->input('endDateTime'), $request->input('duration'), $request->input('invitees'),$expected_enddatetime)) return true;
		if (self::overlappingWeek($request->input('startDateTime'),$request->input('endDateTime'), $request->input('duration'), $request->input('invitees'),$expected_enddatetime)) return true;
		if (self::overlappingWeek($request->input('startDateTime'),$request->input('endDateTime'), $request->input('duration'), $request->input('invitees'),$expected_enddatetime)) return true;

		return false;

	}
	public function save(array $data)
	{
		  
		   return Events::create($data);

	}
 	
 	public function fetch($from="",$to="",$ids)
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
 		if (!empty($from)) {
 			$events = $events->where('startDateTime' ,'>=', $from);
 		}
 		if (!empty($to)) {
 			$events = $events->where('endDateTime','<=', $to);
 		}

 		$events = $events->get();
 		
 		return $events;
 	}

	
}
?>