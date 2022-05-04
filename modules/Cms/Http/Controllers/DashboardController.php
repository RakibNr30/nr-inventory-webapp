<?php

namespace Modules\Cms\Http\Controllers;

use App\Helpers\AuthManager;
use ArielMejiaDev\LarapexCharts\LarapexChart;
use Illuminate\Routing\Controller;
use Modules\Cms\Services\DashboardService;

class DashboardController extends Controller
{
    protected $dashboardService;

    public function __construct(DashboardService $dashboardService)
    {
        $this->dashboardService = $dashboardService;
        $this->middleware(['permission:Dashboard']);
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

        // Chart data
        $campaignChartData = $this->dashboardService->campaignChartData();
        $dashboard->charts = (new LarapexChart())->areaChart()
            ->setTitle('Latest Campaign')
            ->setSubtitle('Campaign vs Influencers')
            ->addData('Influencers', $campaignChartData->values)
            ->setXAxis($campaignChartData->labels)
            ->setGrid()
            ->setMarkers(['#FF5722']);

        //dd($dashboard->charts);

        return view('cms::dashboard.index', compact('dashboard'));
    }
}
