<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\EventInvitee;
use Illuminate\Database\Eloquent\Relations\{HasMany,BelongsTo};
class Events extends Model
{
    use HasFactory;
    protected  $fillable =['user_id','eventName','frequency','duration','startDateTime','endDateTime'];

    public function invitees(): hasMany 
    {
      
        return $this->hasMany(EventInvitee::class,'event_id','id');
    }
}
