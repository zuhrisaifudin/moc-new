<?php

namespace App\Services\Criteria;

use LaravelEasyRepository\ServiceApi;
use App\Repositories\Criteria\CriteriaRepository;

class CriteriaServiceImplement extends ServiceApi implements CriteriaService{

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
     protected CriteriaRepository $mainRepository;

    public function __construct(CriteriaRepository $mainRepository)
    {
      $this->mainRepository = $mainRepository;
    }

    // Define your custom methods :)
}
