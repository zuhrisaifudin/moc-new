<?php

namespace App\Services\Stages;

use LaravelEasyRepository\ServiceApi;
use App\Repositories\Stages\StagesRepository;

class StagesServiceImplement extends ServiceApi implements StagesService{

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
     protected StagesRepository $mainRepository;

    public function __construct(StagesRepository $mainRepository)
    {
      $this->mainRepository = $mainRepository;
    }

    // Define your custom methods :)
}
