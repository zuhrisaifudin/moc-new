<?php

namespace App\Services\DescriptionChange;

use LaravelEasyRepository\ServiceApi;
use App\Repositories\DescriptionChange\DescriptionChangeRepository;

class DescriptionChangeServiceImplement extends ServiceApi implements DescriptionChangeService{

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
     protected DescriptionChangeRepository $mainRepository;

    public function __construct(DescriptionChangeRepository $mainRepository)
    {
      $this->mainRepository = $mainRepository;
    }

    // Define your custom methods :)
}
