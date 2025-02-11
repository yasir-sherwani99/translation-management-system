<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Services\TagService;
use App\Services\LocaleService;
use App\Services\TranslationService;
use App\Http\Requests\TranslationStoreRequest;

class TranslationController extends Controller
{
    protected $tag;
    protected $locale;
    protected $translation;

    public function __construct(
        TagService $tagService,
        LocaleService $localeService,
        TranslationService $translationService
    ) {
        $this->tag = $tagService;
        $this->locale = $localeService;
        $this->translation = $translationService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $translations = $this->translation->getAll();

        return response()->json([
            'success' => true,
            'translations' => $translations
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TranslationStoreRequest $request)
    {
        $data = [];
        // find the corresponding locale and tag
        $tagId = $this->tag->getTagId($request->tag);
        $localeId = $this->locale->getLocaleId($request->locale);

        $data['word'] = $request->word;
        $data['translation'] = $request->translation;
        $data['locale_id'] = $localeId;
        $data['tag_id'] = $tagId;

        $translationn = $this->translation->createOrUpdate($data);

        return response()->json([
            'success' => true,
            'translation' => $translationn
        ], 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(TranslationStoreRequest $request, $id)
    {
        $data = [];
        // find the corresponding locale and tag
        $tagId = $this->tag->getTagId($request->tag);
        $localeId = $this->locale->getLocaleId($request->locale);

        $data['word'] = $request->word;
        $data['translation'] = $request->translation;
        $data['locale_id'] = $localeId;
        $data['tag_id'] = $tagId;

        $translationn = $this->translation->update($data, $id);

        return response()->json([
            'success' => true,
            'translation' => $translationn
        ], 200);
    }

    /**
     * Search the specified resource from storage by key, tag or content.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function search(Request $request)
    {
        $translations = $this->translation->search($request);

        return response()->json([
            'success' => true,
            'translations' => $translations
        ], 200);
    }
}
