<?php
declare(strict_types=1);

namespace Domains\Customer\Status\Statuses;
use Spatie\Enum\Laravel\Enum;

/**
 * @method static self pending()
 * @method static self completed()
 * @method static self abandoned()
 */
final class CartStatus extends Enum {}
