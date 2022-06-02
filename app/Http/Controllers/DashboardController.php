<?php

namespace App\Http\Controllers;

use App\Repositories\RepertoireRepository;
use App\Repositories\ContactRepository;
use App\Repositories\CampagneRepository;
use App\Repositories\MessageRepertoireRepository;
use App\Repositories\MessageCampagneRepository;
use Illuminate\Http\Request;
use App\Http\Requests\CreateCampagneRechercheRequest;

class DashboardController extends Controller
{

   protected $messagerepertoireRepository;
    protected $campagneRepository;
    protected $nbrPerPage = 30; //30 enregistrement par page
    protected $messagecampagneRepository;


    public function __construct(RepertoireRepository $repertoireRepository,
                                ContactRepository $contactRepository,
                                CampagneRepository $campagneRepository,
                                MessageCampagneRepository $messagecampagneRepository,
                                MessageRepertoireRepository  $messagerepertoireRepository)
    {
        $this->middleware('auth');
        $this->middleware('admin');

        //$this->smsinstantaneRepository = $smsinstantaneRepository; 
        $this->campagneRepository = $campagneRepository;
        $this->repertoireRepository = $repertoireRepository;
        $this->contactRepository = $contactRepository;
         $this->messagerepertoireRepository= $messagerepertoireRepository;

        $this->messagecampagneRepository = $messagecampagneRepository;



    }

    public function index()
    { 
        $title = 'Tableau de bord';
         // recuparetion des repertoires du client connecté

        $user_id = auth()->user()->id;

        $nbreRepertoires = $this->repertoireRepository->getNombreRepertoireByUserId($user_id);
        //dd($repertoiresActifs);

        //recuperations des repertoires de l'utilisateur
        
        $userRepertoires = $this->repertoireRepository->getRepertoiresByUserId($user_id);

        $nbreDeContact = 0; // stocke le nombre de contact
        if (!empty($userRepertoires)) 
        {
            foreach ($userRepertoires as $repertoire) {
                //compter le nombre de contact dans le repertoire
                $nbre = $this->contactRepository->getNombreContactDuRepertoire($repertoire->id);
        
                $nbreDeContact += $nbre;
               //dd($nbreDeContact);

            }
        }

        return view('dashboard.index', compact('title','user_id','nbreRepertoires','nbreDeContact'));
    }

    //ctte fonction retourne les campagnes
    public function getCampagnesOfUser(CreateCampagneRechercheRequest $request)
    {
       
        // recuperation des dates selectionnées par user
       $date_debut = $request->date_debut;
       $date_fin =  $request->date_fin;
 //   Retourne les campagnes du client creer entre la date de debut et de fin selectionné par le client 

        // recuparetion des repertoires du client connecté

        $user_id = auth()->user()->id;

        $nbreRepertoires = $this->repertoireRepository->getNombreRepertoireByUserId($user_id);
        //dd($repertoiresActifs);

        //recuperations des repertoires de l'utilisateur
        
        $userRepertoires = $this->repertoireRepository->getRepertoiresByUserId($user_id);


        $nbreDeContact = 0; // stocke le nombre de contact
        if (!empty($userRepertoires)) 
        {
            foreach ($userRepertoires as $repertoire) {
                //compter le nombre de contact dans le repertoire
                $nbre = $this->contactRepository->getNombreContactDuRepertoire($repertoire->id);
        
                $nbreDeContact += $nbre;
               //dd($nbreDeContact);

            }
        }
        
      //Retourne les message programme pour la campagne


       $campagnes = $this->campagneRepository->getCampagneByUserIdEntreDateDebutDateFin($user_id,$date_debut,$date_fin);
   $contactscount =0;

         if (!empty($campagnes))
         {
            //pour chaque campagne
            foreach ($campagnes as $campagne)
            {
                 //recuperation des message 
                $messages = $this->messagecampagneRepository->getNombreMessageByCampagneId($campagne->id);

                //dd($messages);

               if (!empty($messages)) 
               {

                     foreach ($messages as $message) 
                     {

 
                           // recuperation des repertoires selectionne lors de la programmation du msg
                            $repertoires = $this->messagerepertoireRepository->getrepertoireSelectionneLorsDeLaProgrammationDuMessage($message->id);

                           //dd($repertoires);
                           if (!empty($repertoires)) 
                           {
                            
                                foreach ($repertoires as $repertoire) 
                                {
                                     //recuperation des contacts du repertoire
                                   $contactscounts = $this->contactRepository->getNombreContactDuRepertoire($repertoire->repertoire_id);
                                  $contactscount += $contactscounts; 
                                   //dd($contactscount);



                                }
                           }

                       
                     }
               }
            }   
         }
      //dd($campagnes);
     return view('dashboard.index', compact('campagnes','user_id','nbreRepertoires','nbreDeContact','contactscount'));
      

      

    }
}
