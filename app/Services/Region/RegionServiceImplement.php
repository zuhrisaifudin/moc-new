<?php

namespace App\Services\Region;

use LaravelEasyRepository\ServiceApi;
use App\Repositories\Region\RegionRepository;

class RegionServiceImplement extends ServiceApi implements RegionService{

    /**
     * set title message api for CRUD
     * @param string $title
     */
     protected string $title = "";
     /**
     * uncomment this to override the default message
     * protected string $create_message = "";
     * protected string $update_message = "";
     * protected string $delete_message = "";
     */

     /**
     * don't change $this->mainRepository variable name
     * because used in extends service class
     */
     protected RegionRepository $mainRepository;

    public function __construct(RegionRepository $mainRepository)
    {
      $this->mainRepository = $mainRepository;
    }

    // Define your custom methods :)
}
