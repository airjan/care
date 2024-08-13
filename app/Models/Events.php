<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\EventInvitee;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Relations\{HasMany,BelongsTo};
class Events extends Model
{
    use HasFactory;
    protected  $fillable =['user_id','eventName','frequency','duration','startDateTime','endDateTime','expected_enddatetime'];

    // accessor to compute for the duration startdate + duration
    public function getEndDurationAttribute()
    {
        $startDateTime = Carbon::parse($this->startDateTime);
        $endDateTime = $startDateTime->addMinutes($this->duration);
        return $endDateTime->format('Y-m-d H:i:s');
    }

    public function invitees(): hasMany 
    {
      
        return $this->hasMany(EventInvitee::class,'event_id','id');
    }
}
