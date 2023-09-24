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

class EtudiantController extends Controller
{

    public static function if_permis($idetudiant)
    {
        $count = collect(\DB::select('select count(*) as isa from parcours where idetudiant=? and (idpermi=? or idpermi=? or idpermi=?)', [$idetudiant,1,2,3]))->first();
        return $count->isa;
    } 

    public static function nbre_tranche($idetudiant,$idpermi)
    {
        $count = collect(\DB::select('select count(*) as isa from paiementecolages where idetudiant=? and idpermi=?', [$idetudiant,
        $idpermi]))->first();
        return $count->isa;
    } 


    public function form()
    {
       return view('etudiant/Form');
    }

    public function listeEtudiant()
     {
        $bloc = 5;
        $page = request()->query('page',1); // Valeur par défaut : 1
        $perPage = request()->query('perPage',$bloc); // Valeur par défaut : 10
        $currentPage = 1;

        $liste = DB::table("v_etudiant_final")->orderBy("v_etudiant_final.date","desc")->paginate($perPage, ['*'], 'page', $page);
      
        $lastPage = $liste->lastPage(); 

        $listeNumeroPage = range(1, $lastPage);
       
        return view('etudiant/Liste',[
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

        $liste = DB::table("v_etudiant_final")->orderBy("v_etudiant_final.date","desc")->paginate($perPage, ['*'], 'page', $page);
      
        $lastPage = $liste->lastPage(); 

        $listeNumeroPage = range(1, $lastPage);
       
        return view('etudiant/Liste',[
            'liste' => $liste,
            'currentPage' => request('numero'),
            'lastPage' => $lastPage,
            'listeNumeroPage' => $listeNumeroPage,
        ]);
     }

     public function ajouter(Request $request)
     {
         $data = $request->all();
         etudiant::create($data);
         $idetudiant = DB::getPdo()->lastInsertId(); 
         $liste = permi::all(); 
         return view('etudiant/Formpermis',[
            'idetudiant' => $idetudiant,
            'liste' => $liste,
         ]);
     }

     public function ajouterpermis(Request $request)
     {
        $errors = [];
        $idetudiant = $request->input('idetudiant');
        $idpermi = $request->input('idpermi');
     
        foreach($idpermi as $rows)
{
                 $data = [
                  'idetudiant' => request('idetudiant'),
                    'idpermi' => $rows,
                    'nbtranche' => request('nbtranche_' . $rows),
                    'nbcode' => request('nbcode_' . $rows),
                    'nbconduite' => request('nbconduite_' . $rows),
                   ];
                   $if_permis = self::if_permis(request('idetudiant'));
                   if($rows>3)
                   {
                      if($if_permis > 0)
                      {
                        parcour::create($data);
                      }
                      else {
                        $errors['permis'] = 'Vous ne pouvez pas choisir ce permis car vous n avez pas encore le permis A ou B';   
                      }
                   }
                   else
                   {
                    parcour::create($data);
                   }
   
        }
        if(!empty($errors)) {
            $liste = permi::all(); 
            return view('etudiant/Formpermis',[
               'idetudiant' => request('idetudiant'),
               'liste' => $liste,
               'test' => 1,
            ]);
         }
        $listePermis = \DB::select('select pe.idpermi , pe.montant  , pe.typepermi from parcours p join permis pe using(idpermi) where p.idetudiant=? ', [request('idetudiant')]);
        return view('paiement/paiementEcolage',[
            'idetudiant' => request('idetudiant'),
            'listePermis' => $listePermis,
            'tranche' => request('nbtranche'),
        ]);
     }

     public function versmodifier()
     {
    $valeur =  collect(\DB::select('select * from v_etudiant_final where idetudiant=? and idpermi=?', [request('id'),request('idpermi')]))->first();
    $listePermis = permi::all();    
    return view("etudiant/modifier",[
            'valeur' => $valeur,
            'listePermis' => $listePermis,
        ]);
     }

     public function supprimer()
     {
       $id = etudiant::find(request('id'));
       $id->delete();
       return redirect("listeEtudiant")->with('suppression', 'Suppression avec succes !');
     }

     public function modifier(Request $request)
     {
        $data = $request->all();
        $item = etudiant::find(request('idetudiant'));
        $item->update($data);
        return redirect("listeEtudiant")->with('modification', 'Modification avec succes !');
     }

     public function recherche(Request $request)
     {
        $query = "SELECT * FROM v_etudiant_final";
        $bindings = array();
        if (null!==$request->input('nom')) {
          $query .= (count($bindings) > 0 ? " AND" : " where") . "  nom like ?";
          $bindings[] = "%" . $request->input('nom') . "%";
        }
        if (null!==$request->input('prenom')) {
            $query .= (count($bindings) > 0 ? " AND" : " where") . "  nom like ?";
            $bindings[] = "%" . $request->input('nom') . "%";
          }
      
        if (null!==$request->input('adresse')) {
          $query .= (count($bindings) > 0 ? " AND" : " where") . "  adresse like ?";
          $bindings[] = "%" . $request->input('adresse') . "%";
        }
    
        if (null!==$request->input('typepermi')) {
            $query .= (count($bindings) > 0 ? " AND" : " where") . " typepermi like ?";
            $bindings[] = "%" . $request->input('typepermi') . "%";
        }
        
        if (null!==$request->input('etat')) {
            if($request->input('etat') == 0)
            {
                $query .= (count($bindings) > 0 ? " AND" : " where") . " tranche_restante = ?";
                $bindings[] = $request->input('etat');
            }
            else{
                $query .= (count($bindings) > 0 ? " AND" : " where") . " tranche_restante >= ?";
                $bindings[] = $request->input('etat');
            }
          
        }
             $results = \DB::select($query, $bindings);

        $currentPage = 1;

        $lastPage = 3; 

        $listeNumeroPage = range(1, $lastPage);
       
        return view('etudiant/Liste',[
            'liste' => $results,
            'currentPage' => 1,
            'lastPage' => $lastPage,
            'listeNumeroPage' => $listeNumeroPage,
        ]);
}

public function payerEcolage()
{
    $listePermis = \DB::select('select pe.idpermi , pe.montant , p.nbtranche , pe.typepermi from parcours p join permis pe using(idpermi) where p.idetudiant=? and pe.idpermi=?', [request('idetudiant'),request('idpermi')]);
    return view('paiement/paiementEcolage',[
        'idetudiant' => request('idetudiant'),
        'listePermis' => $listePermis,
        'idpermi' => request('idpermi'),
        'reste' => request('reste'),
        'nbtranche' => request('nbtranche'),
        'tranche_restante' => request('tranche_restante'),
    ]);
}

public function annuler()
{
    return redirect("listeEtudiant");
}

public function paiementEcolage(Request $request)
{
    $data = [
        'idetudiant' => request('idetudiant'),
        'idpermi' => request('idpermi'),
        'montant' => request('montant'),
        'datepaiement' => request('datepaiement'),
    ];
    $errors = [];
    $nbre_tranche_effectue = self::nbre_tranche(request('idetudiant'),request('idpermi')); 
 
    if(null!=request('reste'))
    {
         $nbtranche = request('nbtranche');
       if(request('montant')!=request('reste') && $nbre_tranche_effectue>=$nbtranche-1)
       {
        $errors['paiement'] = 'Derniere Tranche . Le montant doit etre egal au reste';
       }
       else {
          paiementecolage::create($data);
        }  
    }
    else{
        paiementecolage::create($data);   
    }
      if(!empty($errors)) {
            return redirect()->back()->withErrors($errors)->withInput();
         }
    return redirect("listeEtudiant")->with('success', 'Paiement avec succes !');   
}



}
