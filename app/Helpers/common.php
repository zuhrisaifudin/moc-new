<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Auth;
use App\Models\MocRequest;

class Common {
    
    public static function getCurrentUser() {
        return Auth::user();
    }

    public static function getCurrentUserId() {
        return Auth::user()->id;
    }


     public static function getMocWorkflowUser() {
        $user = Auth::user();

        if (!$user) {
            return null; 
        }

        return MocRequest::whereHas('approvalWorkflows', function ($query) use ($user) {
            $query->where('user_id', $user->id);
        })->get();
    }

    public static function getRoleFungsiPengusul() {
        $user = Auth::user();

        if (!$user) {
            return false;
        }

        return $user->hasAnyRole('Fungsi Pengusul');
    }


}