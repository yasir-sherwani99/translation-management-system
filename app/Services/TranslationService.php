<?php

namespace App\Services;

use App\Models\Translation;

class TranslationService
{
    public function getAll()
    {
        return Translation::with(['locale', 'tag'])->get();
    }

    public function createOrUpdate(array $translationData)
    {
        return Translation::updateOrCreate(
                    [
                        'word' => $translationData['word'], 
                        'locale_id' => $translationData['locale_id']
                    ],
                    [
                        'translation' => $translationData['translation'], 
                        'tag_id' => $translationData['tag_id']
                    ]
                );
    }

    public function update(array $translationData, $id)
    {
        return Translation::whereId($id)->update($translationData);
    }

    public function retrieveByText($word, $localeId)
    {
        return Translation::where('word', $word)->where('locale', $localeId)->first();
    }

    public function search($data)
    {
        $query = Translation::query();

        if ($data['q']) {
            $query->where('word', 'like', '%' . $data['q'] . '%');
        }

        if ($data['translation']) {
            $query->where('translation', 'like', '%' . $data['translation'] . '%');
        }

        if ($data['locale']) {
            $locale = $data['locale'];
            $query->whereHas('locale', function($q) use ($locale) {
                $q->where('code', 'LIKE', '%'.$locale.'%');
            });
        }

        if ($data['tag']) {
            $tag = $data['tag'];
            $query->whereHas('tag', function($q) use ($tag) {
                $q->where('name', 'LIKE', '%'.$tag.'%');
            });
        }

        $translations = $query->get();

        return $translations;
    }
}