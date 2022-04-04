<?php

namespace App\Http\Middleware;

use Browser;
use Closure;
use Carbon\Carbon;
use App\VisitorLog;
use Illuminate\Support\Facades\Request;

class VisitorLogMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        // visitor log array
        $visitor_log_data = $this->getVisitorLog(true);

        // find existing log
        $visitor_log = VisitorLog::where('ip_address', Request::ip())
            ->where('request_url', Request::url())
            ->where('device_type', $this->getDeviceType())
            ->where('browser_type', $this->getBrowserType())
            ->where('os_type', $this->getOsType())
            ->first();

        // check if log exists or not
        if (empty($visitor_log)) {
            VisitorLog::create($visitor_log_data);
        } else {
            $visitor_log_data = array_merge($visitor_log_data, [
               'visit_count' => $visitor_log->visit_count + 1,
               'updated_at' => Carbon::now(),
            ]);

            $visitor_log->update($visitor_log_data);
        }

        return $next($request);
    }

    // get visitor log data
    private function getVisitorLog($array = false)
    {
        $visitor_log = new \stdClass();
        $visitor_log->ip_address = Request::ip();
        $visitor_log->request_url = Request::url();
        $visitor_log->device_type = $this->getDeviceType();
        $visitor_log->browser_type = $this->getBrowserType();
        $visitor_log->browser_name = Browser::browserName();
        $visitor_log->browser_family = Browser::browserFamily();
        $visitor_log->browser_version = Browser::browserVersion();
        $visitor_log->browser_engine = Browser::browserEngine();
        $visitor_log->os_type = $this->getOsType();
        $visitor_log->os_name = Browser::platformName();
        $visitor_log->os_family = Browser::platformFamily();
        $visitor_log->os_version = Browser::platformVersion();
        $visitor_log->device_family = Browser::deviceFamily();
        $visitor_log->device_model = Browser::deviceModel();
        $visitor_log->device_grade = Browser::mobileGrade();

        // check if wants array
        if ($array) {
            return (array) $visitor_log;
        } else {
            return $visitor_log;
        }
    }

    // get device type
    private function getDeviceType()
    {
        try {
            $deviceType = null;
            if (Browser::isMobile()) {
                $deviceType = 1;
            }
            if (Browser::isTablet()) {
                $deviceType = 2;
            }
            if (Browser::isDesktop()) {
                $deviceType = 3;
            }
            if (Browser::isBot()) {
                $deviceType = 4;
            }
            return $deviceType;
        } catch (\Exception $exception) {
            return null;
        }
    }

    // get browser type
    private function getBrowserType()
    {
        try {
            $browserType = null;
            if (Browser::isChrome()) {
                $browserType = 1;
            }
            if (Browser::isFirefox()) {
                $browserType = 2;
            }
            if (Browser::isOpera()) {
                $browserType = 3;
            }
            if (Browser::isSafari()) {
                $browserType = 4;
            }
            if (Browser::isIE()) {
                $browserType = 5;
            }
            if (Browser::isEdge()) {
                $browserType = 6;
            }
            return $browserType;
        } catch (\Exception $exception) {
            return null;
        }
    }

    // get os type
    private function getOsType()
    {
        try {
            $osType = null;
            if (Browser::isWindows()) {
                $osType = 1;
            }
            if (Browser::isLinux()) {
                $osType = 2;
            }
            if (Browser::isMac()) {
                $osType = 3;
            }
            if (Browser::isAndroid()) {
                $osType = 4;
            }
            return $osType;
        } catch (\Exception $exception) {
            return null;
        }
    }
}
