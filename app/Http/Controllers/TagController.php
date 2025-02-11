<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests\TagStoreRequest;
use App\Services\TagService;

class TagController extends Controller
{
    protected $tag;

    public function __construct(TagService $tagService)
    {
        $this->tag = $tagService;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TagStoreRequest $request)
    {
        $data = [];
        $data['name'] = $request->name;

        $tagg = $this->tag->store($data);

        return response()->json([
            'success' => true,
            'tag' => $tagg
        ], 200);
    }
}
