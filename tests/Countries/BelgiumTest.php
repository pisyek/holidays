<?php

namespace Spatie\Holidays\Tests\Countries;

use Carbon\CarbonImmutable;
use Spatie\Holidays\Countries\Belgium;

it('can calculate belgian holidays', function () {
    CarbonImmutable::setTestNowAndTimezone('2024-01-01');

    $country = new Belgium();

    expect($country->get(2024))->toMatchSnapshot();
})->skip('The results still have timezone issues.');