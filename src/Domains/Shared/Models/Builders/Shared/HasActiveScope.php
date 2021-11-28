<?php
declare(strict_types=1);

namespace Domains\Shared\Models\Builders\Shared;

use phpDocumentor\Reflection\Types\False_;

trait HasActiveScope
{
    public function active(): self
    {
        return $this->where('active', true);
    }

    public function inactive(): self
    {
        return $this->where('active', false);
    }
}
