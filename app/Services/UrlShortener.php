<?php

namespace App\Services;

use App\Models\ShortLink;

final class UrlShortener
{
    const CHARS = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789-';

    private function buildShort(): string
    {
        $arrayOfChars = \str_split(self::CHARS);
        \shuffle($arrayOfChars);
        $keys = \array_rand(\array_flip($arrayOfChars), 8); //short link length can be only 8 digits
        $link = \implode($keys);
        if (ShortLink::where('short_link', $link)->exists()) {
            $this->buildShort();
        }
        return $link;
    }

    public function shorten($url): ShortLink
    {
        return ShortLink::create([
            'short_link' => $this->buildShort(),
            'source_link' => $url,
        ]);
    }
}