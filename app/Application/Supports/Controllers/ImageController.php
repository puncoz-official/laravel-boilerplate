<?php

namespace App\Application\Supports\Controllers;

use App\Infrastructure\Support\Controllers\Controller;
use Exception;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\BinaryFileResponse;
use Symfony\Component\HttpFoundation\StreamedResponse;

/**
 * Class ImageController
 *
 * @package App\Application\Supports\Controllers
 */
class ImageController extends Controller
{
    public function __invoke(string $disk, string $path): StreamedResponse|BinaryFileResponse|null
    {
        try {
            return Storage::disk($disk)->response($path);
        } catch (Exception $exception) {
            abort(Response::HTTP_NOT_FOUND);
        }
    }
}
