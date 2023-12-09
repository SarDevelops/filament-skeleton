<?php

namespace App\Providers;

use App\Models\Setting;
use config;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;
use Livewire\Livewire;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    protected $setting_data = [];

    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Schema::defaultStringLength(191);
        if (Schema::hasTable('settings')) {
            $settings = Setting::all();
            $this->setting_data = $settings->toArray();
            foreach ($settings as $key => $setting) {
                if ($setting->slug == "general-setting") {
                    $config_key_value = [
                        'customConfig.site.name' => 'site-name',
                        'customConfig.site.logo' => 'site-logo',
                        'customConfig.site.email' => 'site-email',
                        'customConfig.site.contact' => 'site-contact',
                        'customConfig.site.address' => 'site-address',
                    ];
                    $this->set_config($config_key_value);
                }
            }
        }
    }

    private function set_config($config_key_value)
    {
        foreach ($this->setting_data as $key => $setting) {
            if ($setting['slug'] == "general-setting") {
                foreach ($config_key_value as $key => $value) {
                    config([$key => $setting['value'][$value]]);
                }
            }

        }

    }

}
