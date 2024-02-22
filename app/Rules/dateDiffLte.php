<?php

namespace app\Rules;
use Carbon\Carbon;
use Illuminate\Validation\Rule;

class DateDiffLte implements Rule
{
    private $field;
    private $maxDays;

    public function __construct($field, $maxDays)
    {
        $this->field = $field;
        $this->maxDays = $maxDays;
    }

    public function passes($attribute, $value)
    {
        return Carbon::parse($value)->diffInDays(Carbon::parse(request()->get($this->field))) <= $this->maxDays;
    }

    public function message()
    {
        return 'La durée du congé ne peut pas dépasser :maxDays jours.';
    }
}