<?php
namespace App\Helpers;
use App\Models\LogSheet;

class LogActivity   {
    public static function log()    {
    	LogSheet::create([
            'ip'          => request()->ip(),
            'agent'       => request()->header('user-agent'),
            'user_id'     => auth_user()->id,
            'action_type' => str_replace('-', ' ' , request()->route()->getName()),
        ]);
    }

    public static function all()   {
    	return LogSheet::latest()->get();
    }
}