<?php

namespace App\Domain\BackOffice\Controllers\Dashboard;

use App\Core\BaseClasses\Controller\BackOfficeController;
use Illuminate\Contracts\View\Factory;
use Illuminate\View\View;

/**
 * Class DashboardController
 * @package App\Domain\BackOffice\Controllers\Dashboard
 */
class DashboardController extends BackOfficeController
{
    /**
     * @return Factory|View
     */
    public function index()
    {
        return view('back.modules.dashboard.index');
    }
}
