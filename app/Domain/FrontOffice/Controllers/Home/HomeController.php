<?php

namespace App\Domain\FrontOffice\Controllers\Home;

use App\Core\BaseClasses\Controller\FrontOfficeController;
use Illuminate\Contracts\Support\Renderable;

/**
 * Class HomeController
 * @package App\Domain\FrontOffice\Controllers\Home
 */
class HomeController extends FrontOfficeController
{
    /**
     * Show the application dashboard.
     *
     * @return Renderable
     */
    public function index(): Renderable
    {
        return view('front.modules.home.index');
    }
}
