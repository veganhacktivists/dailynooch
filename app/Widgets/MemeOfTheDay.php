<?php

namespace App\Widgets;

use File;

class MemeOfTheDay extends AbstractWidget
{
    protected $name = 'Meme of the Day';
    protected $type = 'meme-of-the-day';
    protected $description = 'Vegan meme of the day.';

    protected const MEME_DIR = 'img/memes';

    public function getTtl(): int
    {
        return 24 * 60;
    }

    public function getData(): array
    {
        return [
            'imageUrl' => $this->getRandomMeme(),
        ];
    }

    private function getRandomMeme(): string
    {
        $meme = File::files(public_path(self::MEME_DIR));

        return self::MEME_DIR.'/'.$meme[array_rand($meme)]->getFilename();
    }
}
