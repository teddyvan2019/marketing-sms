<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\RepertoireRepository;
use App\Repositories\CampagneRepository;
use App\Repositories\MessageRepertoireRepository;
use App\Repositories\MessageCampagneRepository;
use App\Http\Requests\CreateMessageRequest;
use App\Http\Requests\UpdateMessageRequest;

use Session;
use DB;

class MessageCampagnesController extends Controller
{

    protected $messagerepertoireRepository;
    protected $messagecampagneRepository;


    protected $nbrPerPage = 30; //30 enregistrement par page

    public function __construct(RepertoireRepository $repertoireRepository,
                                MessageCampagneRepository $messagecampagneRepository,CampagneRepository $campagneRepository, MessageRepertoireRepository  $messagerepertoireRepository)
    {
        $this->middleware('auth');
        $this->middleware('ajax', ['only' => 'store,update']); 
        $this->messagecampagneRepository = $messagecampagneRepository;
        $this->campagneRepository = $campagneRepository;
        $this->repertoireRepository = $repertoireRepository;
        $this->messagerepertoireRepository= $messagerepertoireRepository;
    }
 /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    }

    /**
     * Retourne la liste des message d'une campagne
     */
    public function messageByIdCampagne($campagne_id)
    {
        $user_id = auth()->user()->id;

        $messages = $this->messagecampagneRepository->getMessageByCampagneId($campagne_id, $this->nbrPerPage);
        $links = $messages->render(); // pour la pagination;
        $campagne = $this->campagneRepository->getById($campagne_id);
        $repertoires = $this->repertoireRepository->getRepertoireActifByUserId($user_id);

        return view('messageCampagne.index', compact('messages','campagne','links','campagne_id','repertoires'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response

     */
   // public function create($campagne_id)
    public function create($campagne_id)
    {

        // $user_id = auth()->user()->id;
        // $repertoires = $this->repertoireRepository->getRepertoireByUserId($user_id, $this->nbrPerPage);
        // $links = $repertoires->render();// pour la pagination
        // $repertoiresActifs = $this->repertoireRepository->getRepertoireActifByUserId($user_id);
        // $campagne = $this->campagneRepository->getById($campagne_id);

        //  //dd($campagne);
        // return view('messageCampagne.create', compact('repertoires','repertoiresActifs', 'links','campagne','campagne_id'));

        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    // public function store(CreateMessageRequest $request,$campagne_id)
    public function store(CreateMessageRequest $request)
    {
      
        $user_id = auth()->user()->id;

        // $campagne = $this->campagneRepository->getById($campagne_id);

        // $campagneDebut = $campagne->dateDebut;
        // $messageDateEnvoi = $request->dateEnvoi;
        // $campagneFin  = $campagne->dateFin;

          DB::beginTransaction(); // ouverture de la transaction
          try
          {
  
            // enregistrement du msg programmee
              $msg_data = array('campagne_id' => $request->campagne_id ,
                                'dateEnvoi' => $request->dateEnvoi ,
                                'heureEnvoi' => $request->heureEnvoi ,
                                'message' =>  $request->message ,
              );

              $msgEnregistre = $this->messagecampagneRepository->store($msg_data);
  
              // enregistrer les repertoires selectionné
              $nbreLigne = count($request->repertoires); // compter le nombre de repertoire selectionné
              // dd($nbreLigne);
              $i = 0 ;
              while($nbreLigne > 0 )
              { 
                $array = array(
                              'messages_id' => $msgEnregistre->id,
                              'repertoire_id' => $request->repertoires[$i]
                            );

                //enregistrer les repertoires selectionne pour ce message
                $repertoiresEnregistre = $this->messagerepertoireRepository->store($array);
                $nbreLigne--;
                $i++;
              }
              
              Session::flash('success',"La message a été creé."); 
              DB::commit(); //si les insertions dans les deux tables ce sont bien passées on valide l'enregistremnt
          }
          catch(\Throwable $e)
          {
              Session::flash('danger'," Une erreur est survenu lors de l'enregistrement du message"); 
              DB::rollback(); 
              throw $e;
          }
          
          return response()->json();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id,$campagne_id)
    {
        $campagne = $this->campagneRepository->getById($campagne_id);
        $repertoiresSelectionnes = $this->messagerepertoireRepository->getrepertoireSelectionneLorsDeLaProgrammationDuMessage($id);
        $message = $this->messagecampagneRepository->getById($id);
         return view('messageCampagne.show', compact('message','campagne','campagne_id','repertoiresSelectionnes'));
       
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id,$campagne_id)
    {
        
        $user_id = auth()->user()->id;
        $campagne = $this->campagneRepository->getById($campagne_id);
        
        
        // recupereration des informations sur le message (dans la table ou tu stocke le message,date envoi,message....)
        $message = $this->messagecampagneRepository->getById($id);

        if (!empty($message)) 
        {
          // recuperer les repertoires selectionne lors de la creation du message
          $repertoiresSelectionnes = $this->messagerepertoireRepository->getrepertoireSelectionneLorsDeLaProgrammationDuMessage($id);
      
          // recupereration de tous les repertoires de l'utilisateur connecte 
          $repertoiresActifs = $this->repertoireRepository->getRepertoireActifByUserId($user_id);
        }

      return view('messageCampagne.edit', compact('message','repertoiresActifs','repertoiresSelectionnes','campagne_id','campagne'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateMessageRequest $request,$id,$campagne_id)
    { 
     
     $campagne = $this->campagneRepository->getById($campagne_id);

     $campagneDebut = $campagne->dateDebut;
     $messageDateEnvoi = $request->dateEnvoi;
     $campagneFin  = $campagne->dateFin;
    //dd($campagneFin,$messageDateEnvoi);

    //verifions si la date d'envoie d'un sms est inferieur a la date de debut de la campagne 
        if (($messageDateEnvoi < $campagneDebut) ||($messageDateEnvoi > $campagneFin)) 
        {
            
          Session::flash('error', "Impossible d'éffectuer cette action car la date la date selectionnée est invalide. Prière choisir une date qui n'est pas encore arrivée !!");
         //dd($campagne);
          return view('messageCampagne.edit', compact('campagne','campagne_id','message'));
              
        }else
        { 

          DB::beginTransaction(); // ouverture de la transaction
          try
          {
            // enregistrement du msg programme
              $msg_data = array(
                  'dateEnvoi' => $request->dateEnvoi ,
                  'heureEnvoi' => $request->heureEnvoi ,
                  'message' =>  $request->message ,
              );

              $this->messagecampagneRepository->update($id, $msg_data);  
              
              // supprimer les anciens repertoires selectionné lors de la creation du message
              $this->messagerepertoireRepository->deleteByIdMessage($id);

              // enregistrer les nouveau repertoires selectionné lors de la modification du message

              $nbreLigne = count($request->repertoires); // compter le nombre de repertoire selectionné
              // dd($nbreLigne);
              $i = 0 ;
  
              while($nbreLigne > 0 )
              { 
                $array = array(
                              'message_campagne_id' => $id,
                              'repertoire_id' => $request->repertoires[$i]
                            );

                //enregistrer les repertoire  selectionner pour cemessage
                $repertoiresEnregistre = $this->messagerepertoireRepository->store($array);
                $nbreLigne--;
                $i++;
              }
  
              DB::commit(); //si les insertions dans les deux tables ce sont bien passées on valide l'enregistremnt
          }
          catch(\Throwable $e)
          {
              DB::rollback(); //si il y'a eu un erreur d'insertions dans une des deux tables rejette l'enregistremnt
              throw $e;
          }
        return redirect('listeMessage/'.$campagne_id)->with('success', "message  a été modifié.");
        } 
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, $campagne_id)
    {
        $campagne = $this->campagneRepository->getById($campagne_id);
       $this->messagecampagneRepository->destroy($id);
       return redirect('listeMessage/'.$campagne_id)->with('success', " Le message a été supprimé.");

    }

}
