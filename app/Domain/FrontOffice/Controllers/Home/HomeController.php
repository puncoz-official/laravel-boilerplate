<?php

namespace App\Domain\FrontOffice\Controllers\Home;

use App\Core\BaseClasses\Controllers\FrontOfficeController;

/**
 * Class HomeController
 * @package App\Domain\FrontOffice\Controllers\Home
 */
class HomeController extends FrontOfficeController
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        return view('front.modules.home.index');
    }
}
