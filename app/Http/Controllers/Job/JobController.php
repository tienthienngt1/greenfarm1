<?php

namespace App\Http\Controllers\Job;

use App\Cache\CacheController;
use App\Http\Controllers\Controller;

class JobController extends Controller
{
    use CacheController;

    public function index()
    {
        $data = [
            'users' => $this->userCache(),
            'permissions' => $this->userRelationCache('permissions'),
        ];
        
        if (isset($_GET['action']) && $_GET['action'] === 'success') {
            return view('job.success', array_merge($data, [
                'feededs' => $this->userRelationCache('feededs'),
                'userShops' => $this->shopFeededCache(),
            ]));
        }
        
        return view('job.index', array_merge($data,[
            'feedings' => $this->userRelationCache('feedings'),
        ]));
    }
}