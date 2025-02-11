<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Services\LocaleService;
use App\Http\Requests\LocaleStoreRequest;

class LocaleController extends Controller
{
    protected $locale;

    public function __construct(LocaleService $localeService)
    {
        $this->locale = $localeService;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(LocaleStoreRequest $request)
    {
        $data = [];

        $data['code'] = $request->code;
        $data['name'] = $request->name;

        $localee = $this->locale->store($data);

        return response()->json([
            'success' => true,
            'locale' => $localee
        ], 200);
    }
}
