<?php

namespace App\Rules;

use Carbon\Carbon;
use Illuminate\Contracts\Validation\Rule;

class DateFormat implements Rule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function passes($attribute, $value)
    {
        try {
            // Attempt to parse the date with Carbon
            $date = Carbon::createFromFormat('Y-m-d H:i', $value);

            // Check if the formatted date exactly matches the input
            return $date && $date->format('Y-m-d H:i') === $value && $date->isAfter(Carbon::now());
        } catch (\Exception $e) {
            return false;
        }
    }
    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'The :attribute must be a valid date in the format YYYY-MM-DD hh:mm and must be  the future date';
    }

}
