<?php

namespace App\Console\Commands\Widget;

use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Str;

class WidgetCreator
{
    protected const STUBS_DIR_PATH = __DIR__.'/stubs';

    protected const CREATES = [
        'app/Widgets' => [
            '{{ widgetClass }}.php' => 'WidgetClass.stub',
        ],
        'resources/js/widgets' => [
            '{{ widgetClass }}.vue' => 'WidgetVueComponent.stub',
        ],
    ];

    protected const APPENDS = [
        'app/Providers' => [
            'WidgetServiceProvider.php' => "\n// Move this into \$defaultTypes: -->  '{{ widgetType }}',  <--",
        ],
        'resources/js/widgets' => [
            'index.js' => "\n// Add this import at the top -->  import {{ widgetClass }} from './{{ widgetClass }}'  <--\n// Move this into export default: -->  '{{ widgetType }}': {{ widgetClass }},  <--",
        ],
    ];

    /**
     * The filesystem instance.
     *
     * @var \Illuminate\Filesystem\Filesystem
     */
    protected $files;

    /**
     * The name of the widget.
     */
    protected string $widgetName;

    /**
     * The name of the widget in pascal-case.
     */
    protected string $widgetNamePascal;

    /**
     * The name of the widget in kebab-case.
     */
    protected string $widgetNameKebab;

    /**
     * Create a new widget creator instance.
     *
     * @param Illuminate\Filesystem\Filesystem $files
     *
     * @return void
     */
    public function __construct(Filesystem $files)
    {
        $this->files = $files;
    }

    /**
     * Create a new widget at the given paths.
     *
     * @return array File event messages
     */
    public function create(string $widgetName): array
    {
        $this->widgetName = ucwords(trim(implode(' ', preg_split('/(?=[A-Z])/', $widgetName))));
        $this->widgetNamePascal = Str::studly($widgetName);
        $this->widgetNameKebab = Str::kebab($widgetName);

        $messages = [];
        array_push($messages, $this->generateFiles());
        array_push($messages, $this->appendToFiles());

        return $messages;
    }

    /**
     * Generate new files from stubs.
     *
     * @return array File created event messages
     */
    protected function generateFiles(): array
    {
        $newFileMessages = [];
        foreach ($this::CREATES as $outputDir => $stubFilenames) {
            foreach ($stubFilenames as $outputFilename => $stubFilename) {
                $stubPath = $this::STUBS_DIR_PATH.'/'.$stubFilename;
                $outputFilePath = base_path($outputDir).'/'.$this->getPopulatedText($outputFilename);
                $stubText = $this->files->get($stubPath);

                $this->files->put(
                    $outputFilePath,
                    $this->getPopulatedText($stubText)
                );
                array_push($newFileMessages, "<info>New File:</info> {$outputFilePath}");
            }
        }

        return $newFileMessages;
    }

    /**
     * Append stubs to existing files.
     *
     * @return array File modified event messages
     */
    protected function appendToFiles(): array
    {
        $appendedFileMessages = [];
        foreach ($this::APPENDS as $outputDir => $appendInfo) {
            foreach ($appendInfo as $outputFilename => $stubText) {
                $filePath = base_path($outputDir).'/'.$outputFilename;
                $this->files->append(
                    $filePath,
                    $this->getPopulatedText($stubText)
                );
                array_push($appendedFileMessages, "<info>File modified:</info> {$filePath}");
            }
        }

        return $appendedFileMessages;
    }

    /**
     * Populate the place-holders in the text.
     *
     * @param string $text Text with placeholders
     *
     * @return string Text with place-holders populated
     */
    protected function getPopulatedText($text): string
    {
        $text = str_replace(
            ['{{ widgetClass }}', '{{widgetClass}}'],
            $this->widgetNamePascal,
            $text
        );

        $text = str_replace(
            ['{{ widgetName }}', '{{widgetName}}'],
            $this->widgetName,
            $text
        );

        $text = str_replace(
            ['{{ widgetType }}', '{{widgetType}}'],
            $this->widgetNameKebab,
            $text
        );

        return $text;
    }
}
