<?php

namespace App\Domain\BackOffice\Controllers\Dashboard;

use App\Core\BaseClasses\Controllers\BackOfficeController;

/**
 * Class DashboardController
 * @package App\Domain\BackOffice\Controllers\Dashboard
 */
class DashboardController extends BackOfficeController
{
    public function index()
    {
        return view('back.modules.dashboard.index');
    }
}
