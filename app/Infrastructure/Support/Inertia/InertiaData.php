<?php

namespace App\Infrastructure\Support\Inertia;

use Illuminate\Contracts\Container\BindingResolutionException;
use Symfony\Component\Finder\Finder;

/**
 * Class InertiaData
 *
 * @package App\Infrastructure\Support\Inertia
 */
class InertiaData
{
    /**
     * @return array
     * @throws InvalidInertiaDataSharableClassException
     * @throws BindingResolutionException
     */
    public function get(): array
    {
        $path      = config('inertia.shareable_path');
        $namespace = config('inertia.shareable_namespace');

        $finder = new Finder();
        $finder->files()->in(app_path($path));

        $data = [];

        foreach ($finder as $file) {
            $class = $file->getBasename('.php');
            $class = sprintf("%s\\%s", $namespace, $class);

            if ( !class_exists($class) ) {
                throw new InvalidInertiaDataSharableClassException(
                    sprintf('Inertia Class %s does not exist', $class)
                );
            }

            $instance = app()->make($class);

            if ( !$instance instanceof InertiaDataSharable ) {
                throw new InvalidInertiaDataSharableClassException(
                    sprintf('Inertia Class %s does not implement InertiaDataSharable', $class)
                );
            }

            $data[$instance->key()] = $instance->data();
        }

        return $data;
    }
}
