<?php

namespace Domains\Fulfilment\Support;


use Illuminate\Support\Str;

class OrderNumberGenerator
{
    public static function generate(): string
    {
        // abcd-1234-1234
        // user identifier-month year-microtime
        return Str::uuid()->toString();
    }
}
