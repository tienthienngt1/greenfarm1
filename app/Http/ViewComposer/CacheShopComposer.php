<?php

namespace App\Http\ViewComposer;

use App\Cache\CacheController;
use Illuminate\View\View;

class CacheShopComposer
{
    use CacheController;

    public $shop;
    /**
     * Create a movie composer.
     *
     * @return void
     */
    public function __construct()
    {
        if (\Auth::check()) {
            $this->shop = $this->shopCache();
        }
    }

    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {
        $view->with('shop', $this->shop);
    }
}
