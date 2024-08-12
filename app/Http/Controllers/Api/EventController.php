<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\{EventCreateRequest};

use App\Interfaces\{
        EventsInterface,
        EventInviteeInterface
    };
use Illuminate\Http\Response;
class EventController extends Controller
{
    //
    private $Events,$EventInvitee;

    public function __construct(EventsInterface $Events, EventInviteeInterface $EventInvitee)
    {
        $this->Events = $Events;
        $this->EventInvitee = $EventInvitee;
    }

    public function create(EventCreateRequest $request)
    {
       $event = $this->Events->save($request->all() + ['user_id' => auth()->user()->id]);
       $invitees = array_unique($request->input('invitees'));

       foreach($invitees as $invitee) {
            $this->EventInvitee->save([
                    'user_id' =>$invitee,
                    'event_id'  => $event->id
                ]);
       }

       $event->invitees  = $invitees;
        return response()->json([
            'message' => 'Event created successfully',
            'event' => $event,
        ], 201);
       
    }

    public function read(Request $request)
    {
        $from = $request->get('from');
        $to = $request->get('to');
        $invitees   = $request->get('invitees');
       
        $invitee = [];
        if (!empty($invitees)) {
            $invitee = explode("," , $invitees);
          
            if (!is_array($invitee)){
                $invitee =[];
            }
        }
        
        $events = $this->Events->fetch($from,$to,$invitee);
        
        
        $result = $events->map(function ($event) {
            return [
                'event_id' => $event->id,
                'event_name' => $event->event_name,
                'startDateTime' => $event->startDateTime,
                'endDateTime' => $event->endDateTime,
                'frequency' => $event->frequency,
                'duration' => $event->duration,
                'invitees' => $event->invitees->pluck('user_id')->toArray(),
        ];
        }); 
        
        return response()->json([
            'items' => $result,
        ], 201);
        
        
    }
}
