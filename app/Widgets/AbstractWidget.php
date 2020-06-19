<?php

namespace App\Widgets;

use Illuminate\Http\JsonResponse;

class AbstractWidget
{
    /**
     * @var array
     */
    protected $params;

    /**
     * @var string
     */
    protected $description;

    /**
     * @var string
     */
    protected $name;

    public function __construct(array $params)
    {
        $this->params = $params;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function action(): JsonResponse
    {
    }
}
