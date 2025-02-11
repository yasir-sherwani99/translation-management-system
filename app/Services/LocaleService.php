<?php

namespace App\Services;

use App\Models\Locale;

class LocaleService
{
    public function getLocaleId($code)
    {
        return Locale::where('code', $code)->pluck('id');
    }

    public function store($data)
    {
        return Locale::create($data);
    }   
}