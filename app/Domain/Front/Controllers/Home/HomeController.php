<?php

namespace App\Domain\Front\Controllers\Home;

use App\StartUp\BaseClasses\Controller\FrontController;

/**
 * Class HomeController
 * @package App\Domain\Front\Controllers\Home
 */
class HomeController extends FrontController
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        return view('front.modules.home.index');
    }
}
