<?php

use Carbon\Carbon;

if (! function_exists('formatedLocaleDate')) {
    function formatedLocaleDate(?string $date)
    {
        $locale = app()->getLocale();
        Carbon::setLocale($locale);
        $format = $locale === 'en' ? 'F d, Y' : 'd M Y';

        return $date ? Carbon::parse($date)->translatedFormat($format) : null;
    }
}

if (! function_exists('greeting')) {
    function greeting()
    {
        $hour = date('H');

        return ($hour > 17) ? trans('Good evening ') : (($hour > 12 && $hour <= 18) ? trans('Good afternoon ') : trans('Good morning '));
    }
}

if (! function_exists('formatMoney')) {
    function formatMoney(int $amount)
    {
        if (app()->getLocale() === 'en') {
            return number_format($amount);
        } else {
            return number_format($amount, 0, ',', ' ');
        }
    }
}

if (! function_exists('formField')) {
    /**
     * Get a user-friendly translation for a form field
     *
     * @param string $field
     * @return string
     */
    function formField(string $field): string
    {
        return trans("forms.{$field}", [], app()->getLocale());
    }
}

if (! function_exists('validationField')) {
    /**
     * Get a user-friendly translation for validation messages
     *
     * @param string $field
     * @return string
     */
    function validationField(string $field): string
    {
        return trans("validation.attributes.{$field}", [], app()->getLocale());
    }
}
