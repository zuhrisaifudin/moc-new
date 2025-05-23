<?php

namespace App\Services\Module;

use LaravelEasyRepository\ServiceApi;
use App\Repositories\Module\ModuleRepository;

class ModuleServiceImplement extends ServiceApi implements ModuleService{

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
     protected ModuleRepository $mainRepository;

    public function __construct(ModuleRepository $mainRepository)
    {
      $this->mainRepository = $mainRepository;
    }

    // Define your custom methods :)
}
