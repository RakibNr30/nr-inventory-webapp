<?php

namespace Modules\Cms\Http\Controllers;

use App\Helpers\AuthManager;
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

        if (AuthManager::isBrand()) {
            $dashboard->statistics = $this->dashboardService->statisticsBrandCampaign();
        }
        else if (AuthManager::isInfluencer()) {
            $dashboard->statistics = $this->dashboardService->statisticsInfluencer();
        }
        else {
            $dashboard->statistics = $this->dashboardService->statistics();
        }

        return view('cms::dashboard.index', compact('dashboard'));
    }
}
