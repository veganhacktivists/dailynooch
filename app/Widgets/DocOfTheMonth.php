<?php

namespace App\Widgets;

use File;

class DocOfTheMonth extends AbstractWidget
{
    protected $name = 'Documentary of the Month';
    protected $type = 'doc-of-the-month';
    protected $description = 'Documentary of the month';

    protected const DOC_DIR = 'img/doc';

    public function getTtl(): int
    {
        return 24 * 60;
    }

    public function getData(): array
    {
        return $this->getRandomDoc();
    }

    private function getRandomDoc(): array
    {
        $docs = File::files(public_path(self::DOC_DIR));
        $randDoc = $docs[array_rand($docs)];
        $docFileName = $randDoc->getFileName();
        $docName = pathinfo($docFileName, PATHINFO_FILENAME);
        $imageUrl = self::DOC_DIR.'/'.$docFileName;

        return [
            'imageUrl' => $imageUrl,
            'docName' => $docName,
        ];
    }
}
