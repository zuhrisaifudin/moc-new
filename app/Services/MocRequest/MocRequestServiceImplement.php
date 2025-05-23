<?php

namespace App\Services\MocRequest;

use LaravelEasyRepository\ServiceApi;
use App\Repositories\MocRequest\MocRequestRepository;

class MocRequestServiceImplement extends ServiceApi implements MocRequestService{

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
     protected MocRequestRepository $mainRepository;

    public function __construct(MocRequestRepository $mainRepository)
    {
      $this->mainRepository = $mainRepository;
    }

    // Define your custom methods :)
}
