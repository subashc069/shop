<?php
declare(strict_types=1);

namespace Tests\Feature;

use JustSteveKing\StatusCode\Http;
use function Pest\Laravel\get;

it(description: 'it receives Http OK on home page', closure:  function() {
   get(
       uri: route('home'),
   )->assertStatus(
       status: Http::OK
   );
});


