<?php

namespace App\Widgets;

use File;

class DocOfTheMonth extends AbstractWidget
{
    protected $name = 'Animal Rights Map';
    protected $type = 'animal-rights-map';
    protected $description = 'Animal Rights Map';

    protected const DOC_DIR = 'img/doc';

    public function getTtl(): int
    {
        return 24 * 60;
    }

    public function getData(): array
    {
        return [
            'imageUrl' => $this->getRandomDoc()
        ];
    }

    private function getRandomDoc(): String
    {
        $doc = File::files(public_path(self::DOC_DIR));
        return self::DOC_DIR.'/'.$doc[array_rand($doc)]->getFilename();
    }
}
