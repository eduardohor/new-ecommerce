<?php

namespace App\Http\Composers;

use App\Models\StoreInfo;
use Illuminate\View\View;

class StoreInfoComposer
{
    protected $storeInfo;

    public function __construct(StoreInfo $storeInfo)
    {
        $this->storeInfo = $storeInfo;
    }

    public function compose(View $view)
    {
        $storeInfo = $this->storeInfo->first();
        $storeInfo = null;
        $view->with('storeInfo', $storeInfo);
    }
}
