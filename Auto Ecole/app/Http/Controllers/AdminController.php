<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Admin;
use App\rechargementcompte;
use App\datemaintenant;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    public function index()
    {
        return view('admin/Admin_index');
    }

    // public static function logg($mail,$mdp)
    // {
    //     $login = collect(\DB::select('select count(*) as isa from admins where users = ? and mdp = ? ', [$mail,
    //     $mdp]))->first();
    //     return $login->isa;
    // } 

    public static function logg($mail, $mdp)
{
    try {
        $login = collect(\DB::select('select count(*) as isa from admins where users = ? and mdp = ?', [$mail, $mdp]))->first();
        return $login->isa;
    } catch (\Exception $e) {
        return 0;
    }
}


     //login admin
     public function log_admin(Request $request)
     {
          //login
          $login = self::logg(request('mail'),request('mdp'));
         if($login == 0)
         {
             return view('admin/Admin_index',[
                 'erreur' => 'Email ou mot de passe errone',
                     ]);
         }
         else
         {
             return view('admin/Acceuill_admin');
         }
     }

     public function log_out()
     {
            return redirect("/");
     }

    

 
}
