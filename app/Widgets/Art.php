<?php

namespace App\Widgets;

use File;

class Art extends AbstractWidget
{
    protected $name = 'Art of the Day';
    protected $type = 'art';
    protected $description = 'Vegan artwork of the day.';

    protected const ARTWORK_DIR = 'img/art';

    public function getTtl(): int
    {
        return 24 * 60;
    }

    public function getData(): array
    {
        return [
            'caption' => null,
            'imageAlt' => null,
            'imageUrl' => $this->getRandomArtwork(),
        ];
    }

    private function getRandomArtwork(): string
    {
        $artwork = File::files(public_path(self::ARTWORK_DIR));

        return self::ARTWORK_DIR.'/'.$artwork[array_rand($artwork)]->getFilename();
    }
}
