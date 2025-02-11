<?php

namespace App\Services;

use App\Models\Tag;

class TagService
{
    public function getTagId($tag)
    {
        return Tag::where('name', $tag)->pluck('id');
    }

    public function store($data)
    {
        return Tag::create($data);
    }   
}