<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Rules\DateFormat;
use App\Models\User;
class EventCreateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $rules = [
                 'eventName'     => 'required',
                 'frequency'     => 'required|in:Once-Off,Weekly,Monthly',
                 'startDateTime' => ['required', new DateFormat()],
                 'duration'      => 'required|integer|min:1',
                 'endDateTime'  => ['sometimes', new DateFormat()],
        ];
        $rules['invitees'] =[
                'required',
                
                function($attribute, $value, $fail) {
                    
                    $tempValue = $value;
                    if (!is_array($tempValue)) {
                        $fail ('Not a valid invitee format');
                        return;
                    }
                    foreach($tempValue as $id) {
                        if (!is_int($id)){
                            $fail('Some Invalid invitee ID');
                        return;
                        }
                    }
                    $userIds = array_map('intval', $tempValue) ;
                    $invalidUsers = array_diff($userIds , User::whereIn('id', $userIds)->pluck('id')->toArray());
                    if (!empty($invalidUsers)) {
                        $fail("Some Invitee ID does not exist in user  ");
                    }

                }
        ];
        
        return $rules;
        
    }
}
