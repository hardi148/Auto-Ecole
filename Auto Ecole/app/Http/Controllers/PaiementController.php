<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\etudiant;
use App\parcour;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cache;
use DateTime;
use App\permi;
use App\paiementecolage;

class PaiementController extends Controller
{

    public function listePaiement()
     {
        $bloc = 5;
        $page = request()->query('page',1); // Valeur par défaut : 1
        $perPage = request()->query('perPage',$bloc); // Valeur par défaut : 10
        $currentPage = 1;

        $liste = DB::table("v_paiement")->orderBy("v_paiement.date_paiement","desc")->paginate($perPage, ['*'], 'page', $page);
      
        $lastPage = $liste->lastPage(); 

        $listeNumeroPage = range(1, $lastPage);
       
        return view('paiement/Liste',[
            'liste' => $liste,
            'currentPage' => $currentPage,
            'lastPage' => $lastPage,
            'listeNumeroPage' => $listeNumeroPage,
        ]);
     }

     public function pagination(Request $request)
     {
        $bloc = 5;
        $page = request()->query('page',request('numero')); // Valeur par défaut : 1
        $perPage = request()->query('perPage',$bloc); // Valeur par défaut : 10
        $currentPage = request('numero');

        $liste = DB::table("v_paiement")->orderBy("v_paiement.date_paiement","desc")->paginate($perPage, ['*'], 'page', $page);
      
        $lastPage = $liste->lastPage(); 

        $listeNumeroPage = range(1, $lastPage);
       
        return view('paiement/Liste',[
            'liste' => $liste,
            'currentPage' => request('numero'),
            'lastPage' => $lastPage,
            'listeNumeroPage' => $listeNumeroPage,
        ]);
     }

     public function recherche(Request $request)
  {
         $query = "SELECT * FROM v_paiement";
         $bindings = array();

         if (null!==$request->input('nom')) {
            $query .= (count($bindings) > 0 ? " AND" : " where") . "  nom like ? or prenom like ?";
            $bindings[] = "%" . $request->input('nom') . "%";
            $bindings[] = "%" . $request->input('nom') . "%";
          }

         if (null!==$request->input('datedebut')) {
             $query .= (count($bindings) > 0 ? " AND" : " where") . " datepaiement >= ?";
             $bindings[] = $request->input('datedebut');
         }
         
         if (null!==$request->input('datefin')) {
             $query .= (count($bindings) > 0 ? " AND" : " where") . " datepaiement <= ?";
             $bindings[] = $request->input('datefin');
         }
         $results = \DB::select($query, $bindings);

        $currentPage = 1;

        $lastPage = 20; 

        $listeNumeroPage = range(1, $lastPage);
       
        return view('paiement/Liste',[
            'liste' => $results,
            'currentPage' => 1,
            'lastPage' => $lastPage,
            'listeNumeroPage' => $listeNumeroPage,
        ]);
   }


}
