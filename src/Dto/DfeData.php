<?php

namespace Nfse\Nfse\Dto;

use Nfse\Nfse\Enums\DfeType;
use Spatie\LaravelData\Data;

abstract class DfeData extends Data
{
    abstract public function getType(): DfeType;
}
