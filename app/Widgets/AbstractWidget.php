<?php

namespace App\Widgets;

use Illuminate\Http\JsonResponse;

abstract class AbstractWidget
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

    /**
     * @var string
     */
    protected $type;

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

    public function getType(): string
    {
        return $this->type;
    }

    abstract public function getData(): array;

    public function action(): JsonResponse
    {
        return new JsonResponse([
            'type' => $this->getType(),
            'name' => $this->getName(),
            'data' => $this->getData(),
        ]);
    }
}
