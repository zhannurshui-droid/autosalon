<?php

namespace App\Observers;

use App\Models\Brand;
use Illuminate\Support\Facades\Cache;

class BrandObserver
{
    public function saved(Brand $brand): void
    {
        $this->flushCache();
    }

    public function deleted(Brand $brand): void
    {
        $this->flushCache();
    }

    private function flushCache(): void
    {
        Cache::deleteMultiple(['home.stats', 'brands.menu', 'admin.stats']);
    }
}