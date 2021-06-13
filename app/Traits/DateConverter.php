<?php

namespace App\Traits;

use DateTime;
use DateTimeZone;
use Exception;

/**
 * Trait DateConverter
 * @package App\Traits
 */
trait DateConverter
{
    /**
     * @param string $date
     * @throws Exception
     * @return DateTime
     */
    public function getUtcDate(string $date)
    {
        $new_str = new DateTime($date, new DateTimeZone('America/Mazatlan'));

        return $new_str->setTimeZone(new DateTimeZone('UTC'));
    }
}
