<?php

namespace App\Widgets;

use File;

class DocOfTheMonth extends AbstractWidget
{
    protected $name = 'Documentary of the month';
    protected $type = 'doc-of-the-month';
    protected $description = 'Documentary of the month';

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
