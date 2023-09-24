<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\etudiant;
use App\parcour;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cache;
use DateTime;
use App\permi;
use App\examen;

class ParcoursController extends Controller
{

   public static function resultat_code($idetudiant,$idpermi)
  {
    try {
     $count = collect(\DB::select('select resultat from examens where idetudiant=? and idpermi=? and typeexamen=?', [$idetudiant,
      $idpermi,"code"]))->first();
      $result =  $count->resultat;
      return $result;
    }
    catch (\Exception $e) {
      return 0;
    }            
  } 

   public function index()
   {
       $detail =  collect(\DB::select('select * from v_etudiant_final where idetudiant=? and idpermi=?', [request('idetudiant'),request('idpermi')]))->first();
       $resultat_code = self::resultat_code(request('idetudiant'),request('idpermi'));
       return view('etudiant/detail',[
        'detail' => $detail,
        'resultat_code' => $resultat_code,
       ]);
   }

   public function terminercode()
   {
          DB::update("update parcours set codetermine=1 where idetudiant=? and idpermi=?",[request('idetudiant'),request('idpermi')]);
          return redirect("listeEtudiant")->with('success', 'Tous les cours de codes sont bien termine !');
  }

   public function terminerconduite()
   {
 DB::update("update parcours set conduitetermine=1 where idetudiant=? and idpermi=?",[request('idetudiant'),request('idpermi')]);
 return redirect("listeEtudiant")->with('success', 'Tous les cours de conduite sont bien termine !');   
   }

   public function modifier(Request $request)
   {
    $data = $request->all();
    $item = parcour::find(request('idparcour'));
    $item->update($data);
    return redirect("listeEtudiant")->with('success', 'modification bien termine !');   
   }



}
