<?php

namespace App\Infrastructure\Support\Helpers;

use App\Enums\General;
use App\Infrastructure\Support\DataArraySerializer;
use Carbon\CarbonImmutable;
use Carbon\CarbonInterface;
use Exception;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use League\Fractal\Manager;
use League\Fractal\Resource\Collection as ResourceCollection;
use League\Fractal\Resource\Item as ResourceItem;
use League\Fractal\TransformerAbstract;

/**
 * Class Helper
 *
 * @package App\Infrastructure\Support
 */
class Helper
{
    public static function transform(Model|Collection $model, TransformerAbstract $transformer): array
    {
        $manager = new Manager();
        $manager->setSerializer(new DataArraySerializer());

        if ( $model instanceof Collection ) {
            $resource = new ResourceCollection($model, $transformer);
        } else {
            $resource = new ResourceItem($model, $transformer);
        }

        return $manager->createData($resource)->toArray();
    }

    public static function dateResponse(CarbonInterface|string|null $date): ?array
    {
        if ( !$date ) {
            return null;
        }

        try {
            $date = $date instanceof CarbonInterface ? $date : CarbonImmutable::parse($date);
        } catch (Exception $exception) {
            return null;
        }

        return [
            'raw'            => $date->toDateTimeString(),
            'date_formatted' => $date->format(General::DATE_FORMAT->value),
            'diff'           => $date->diffForHumans(),
            'timestamp'      => $date->timestamp * 1000,
        ];
    }
}
