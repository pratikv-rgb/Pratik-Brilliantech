<?php

namespace App\Traits;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;

trait ActivationClass
{
    public function is_local(): bool
    {
        $whitelist = [
            '127.0.0.1',
            '::1'
        ];

        return in_array(request()->ip(), $whitelist);
    }

    public function getDomain(): string
    {
        return str_replace(["http://", "https://", "www."], "", url('/'));
    }

    public function getSystemAddonCacheKey(string|null $app = 'default'): string
    {
        $appName = env('APP_NAME').'_cache';
        return str_replace('-', '_', Str::slug($appName.'cache_system_addons_for_' . $app . '_' . $this->getDomain()));
    }

    public function getAddonsConfig(): array
    {
        if (file_exists(base_path('config/system-addons.php'))) {
            return include(base_path('config/system-addons.php'));
        }

        $apps = ['admin_panel', 'vendor_app', 'deliveryman_app', 'react_web'];
        $appConfig = [];
        foreach ($apps as $app) {
            $appConfig[$app] = [
                "active" => "0",
                "username" => "",
                "purchase_key" => "",
                "software_id" => "",
                "domain" => "",
                "software_type" => $app == 'admin_panel' ? "product" : 'addon',
            ];
        }
        return $appConfig;
    }

    public function getCacheTimeoutByDays(int $days = 3): int
    {
        return 60 * 60 * 24 * $days;
    }

    public function getRequestConfig(
        string|null $username = null,
        string|null $purchaseKey = null,
        string|null $softwareId = null,
        string|null $softwareType = null
    ): array {
        return [
            "active" => 1, 
            "username" => $username ?? '',
            "purchase_key" => $purchaseKey ?? '',
            "software_id" => $softwareId ?? (defined('SOFTWARE_ID') ? SOFTWARE_ID : 'local'),
            "domain" => $this->getDomain(),
            "software_type" => $softwareType ?? 'product',
        ];
    }

    public function checkActivationCache(string|null $app)
    {
        return true;
    }

    public function updateActivationConfig($app, $response): void
    {
        $config = $this->getAddonsConfig();
        $config[$app] = $response;
        $configContents = "<?php return " . var_export($config, true) . ";";
        file_put_contents(base_path('config/system-addons.php'), $configContents);
        $cacheKey = $this->getSystemAddonCacheKey(app: $app);
        Cache::forget($cacheKey);
    }

    // --- NEW METHOD: Auto-activate all apps locally ---
    public function activateAllLocally(): void
    {
        if (!$this->is_local()) {
            return; // Only activate on local environment
        }

        $apps = ['admin_panel', 'vendor_app', 'deliveryman_app', 'react_web'];

        foreach ($apps as $app) {
            $dummyResponse = $this->getRequestConfig(
                username: 'localuser',
                purchaseKey: 'localkey',
                softwareId: 'local',
                softwareType: $app === 'admin_panel' ? 'product' : 'addon'
            );

            $this->updateActivationConfig($app, $dummyResponse);
        }
    }
}
