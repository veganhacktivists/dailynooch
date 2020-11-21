<?php

namespace App\Widgets;

use File;

class VeganBootcamp extends AbstractWidget
{
    protected $name = 'Vegan Bootcamp';
    protected $type = 'vegan-bootcamp';
    protected $description = 'Vegan Bootcamp';

    protected const DOC_DIR = 'img/vb';

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
