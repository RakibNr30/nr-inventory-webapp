<?php

namespace Modules\Cms\Http\Controllers;

use Illuminate\Routing\Controller;
use Modules\Cms\Services\DashboardService;

class DashboardController extends Controller
{
    protected $dashboardService;

    public function __construct(DashboardService $dashboardService)
    {
        $this->dashboardService = $dashboardService;
    }

    public function index()
    {
        $dashboard = new \stdClass();

        $dashboard->influencers = $this->dashboardService->influencers();
        $dashboard->campaigns = $this->dashboardService->campaigns();

        return view('cms::dashboard.index', compact('dashboard'));
    }
}
