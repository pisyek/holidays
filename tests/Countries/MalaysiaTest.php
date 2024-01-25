<?php

namespace Spatie\Holidays\Tests\Countries;

use Carbon\CarbonImmutable;
use Spatie\Holidays\Countries\Malaysia;
use Spatie\Holidays\Exceptions\InvalidRegion;
use Spatie\Holidays\Holidays;

it('can calculate Malaysia holidays', function () {
    CarbonImmutable::setTestNowAndTimezone('2024-01-01');

    $holidays = Holidays::for(country: 'my')->get();

    expect($holidays)
        ->toBeArray()
        ->not()->toBeEmpty();

    expect(formatDates($holidays))->toMatchSnapshot();
});

it('can calculate total holidays by regions', function (string $region, $totalHolidays) {
    CarbonImmutable::setTestNowAndTimezone('2024-01-01');

    $holidays = Holidays::for(Malaysia::make($region))->get();

    expect($holidays)
        ->toBeArray()
        ->not()->toBeEmpty();

    expect(count($holidays))->toBe($totalHolidays);

    expect(formatDates($holidays))->toMatchSnapshot();
})->with([
    ['jhr', 18],
    ['kdh', 19],
    ['ktn', 19],
    ['kul', 18],
    ['lbn', 19],
    ['mlk', 18],
    ['nsn', 18],
    ['phg', 18],
    ['png', 19],
    ['prk', 18],
    ['pls', 18],
    ['pjy', 18],
    ['sbh', 20],
    ['swk', 19],
    ['sgr', 18],
    ['trg', 20],
]);

it('can calculate Hari Raya is in year 2023', function () {
    CarbonImmutable::setTestNow('2023-01-01');

    $holiday = Holidays::for('my')->isHoliday('2023-04-22');

    expect($holiday)->toBeTrue();
});

it('can calculate Tahun Baru Cina in year 2023', function () {
    CarbonImmutable::setTestNow('2023-01-01');

    $holiday = Holidays::for('my')->isHoliday('2023-01-22');

    expect($holiday)->toBeTrue();
});

it('cannot calculate invalid region', function () {
    $holiday = Holidays::for(Malaysia::make('invalid-region'))->get();
})->throws(InvalidRegion::class);
