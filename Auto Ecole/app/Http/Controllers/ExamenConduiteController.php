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

class ExamenConduiteController extends Controller
{

   public static function resultat_code($idetudiant,$idpermi)
   {
      $count = collect(\DB::select('select resultat from examens where idetudiant=? and idpermi=? and typeexamen=?', [$idetudiant,
       $idpermi,"code"]))->first();
       $result =  $count->resultat;
       return $result; 
   } 

    public function listeExamen()
     {
        $bloc = 5;
        $page = request()->query('page',1); // Valeur par défaut : 1
        $perPage = request()->query('perPage',$bloc); // Valeur par défaut : 10
        $currentPage = 1;

        $liste = DB::table("v_examen")->where("v_examen.typeexamen","conduite")->orderBy("v_examen.date_examen","desc")->paginate($perPage, ['*'], 'page', $page);
      
        $lastPage = $liste->lastPage(); 

        $listeNumeroPage = range(1, $lastPage);
       
        return view('examen/ListeConduite',[
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

        $liste = DB::table("v_examen")->where("v_examen.typeexamen","conduite")->orderBy("v_examen.date_examen","desc")->paginate($perPage, ['*'], 'page', $page);
      
        $lastPage = $liste->lastPage(); 

        $listeNumeroPage = range(1, $lastPage);
       
        return view('examen/ListeConduite',[
            'liste' => $liste,
            'currentPage' => request('numero'),
            'lastPage' => $lastPage,
            'listeNumeroPage' => $listeNumeroPage,
        ]);
     }

     public function recherche(Request $request)
  {
   $query = "SELECT * FROM v_examen_conduite";
   $bindings = array();
   
   if (null!==$request->input('nom')) {
     $query .= (count($bindings) > 0 ? " AND" : " where") . "  nom like ? or prenom like ?";
     $bindings[] = "%" . $request->input('nom') . "%";
     $bindings[] = "%" . $request->input('nom') . "%";
   }

         if (null!==$request->input('motcle')) {
           $query .= (count($bindings) > 0 ? " AND" : " and") . "  resultat=?";
           $bindings[] = "%" . $request->input('motcle') . "%";
         }

         if (null!==$request->input('datedebut')) {
             $query .= (count($bindings) > 0 ? " AND" : " and") . " dateexamen >= ?";
             $bindings[] = $request->input('datedebut');
         }
         
         if (null!==$request->input('datefin')) {
             $query .= (count($bindings) > 0 ? " AND" : " and") . " dateexamen <= ?";
             $bindings[] = $request->input('datefin');
         }
         $results = \DB::select($query, $bindings);

        $currentPage = 1;

        $lastPage = 3; 

        $listeNumeroPage = range(1, $lastPage);
       
        return view('examen/ListeConduite',[
            'liste' => $results,
            'currentPage' => 1,
            'lastPage' => $lastPage,
            'listeNumeroPage' => $listeNumeroPage,
        ]);
   }


   public function passerexamen()
   {
    $detail =  collect(\DB::select('select * from v_etudiant_final where idetudiant=? and idpermi=?', [request('idetudiant'),request('idpermi')]))->first();
       return view('examen/inscriptionexamconduite',[
         'detail' => $detail,
       ]);
   }

   public function ajouter(Request $request)
   {
         $data = $request->all();
         $errors = [];
         $resultat_code = self::resultat_code(request('idetudiant'),request('idpermi'));
         $detail =  collect(\DB::select('select * from v_etudiant_final where idetudiant=? and idpermi=?', [request('idetudiant'),request('idpermi')]))->first();
         if(null==request('droitexamen'))
         {        
            $errors['paiement'] = 'Vous ne pouvez pas faire cet examen sans avoir payer le droit';
         }
         elseif($resultat_code != 2) 
         {
            $errors['resultat'] = 'Vous n etes pas encore admis a l examen code';
         }
         elseif($detail->reste != 0)
         {
            $errors['ecolage'] = 'Vous n avez pas paye la totalite de l ecolage';
         }
         else{
            examen::create($data);
         }
         if(!empty($errors)) {
            return redirect()->back()->withErrors($errors)->withInput();
         }
         return redirect("listeExamenConduite")->with('success', 'bien effectue !'); 
   }

   public function annuler()
   {
      DB::update('update examens set resultat=3 where idexamen=?',[request('idexamen')]);
      return redirect("listeExamenConduite")->with('suppression', 'Annulation de l examen conduite bien effectue !');  
   }

   public function emettre()
   {
      return view('examen/emettreconduite',[
         'idexamen' => request('idexamen'),
      ]);
   }

   public function resultat()
   {
      DB::update('update examens set resultat=? where idexamen=?',[request('type'),request('idexamen')]);
      return redirect("listeExamenConduite")->with('success', 'bien effectue !'); 
   }

}
