<?php
declare(strict_types=1);

namespace App\Http\Controllers\Api\V1\Orders;

use App\Http\Controllers\Controller;
use Domains\Fulfilment\Factories\Stripe\PaymentIntentFactory;
use Domains\Fulfilment\Jobs\Stripe\ProcessPaymentIntent;
use Illuminate\Http\Request;

class StripeWebhookController extends Controller
{
    public function __invoke(Request $request): void
    {
        //got the event and signature is valid
        if($request->get('type') === 'payment_intent.succeeded') {
            ProcessPaymentIntent::dispatch(
                PaymentIntentFactory::make(
                    event: $request->get('payload'),
                ),
            );
        }
    }
}
