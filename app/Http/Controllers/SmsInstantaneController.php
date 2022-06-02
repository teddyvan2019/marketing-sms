<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Repositories\SmsInstantaneRepository;
use App\Repositories\RepertoireRepository;
use App\Repositories\ContactRepository;
use App\Repositories\MessageRepository;
use App\Http\Requests\CreateSmsInstantaneRequest;

use App\Gestion\GestionSMS;
use App\Services\SMSService;

use Session; 

class SmsInstantaneController extends Controller
{

    protected $smsinstantaneRepository;
    protected $nbrPerPage = 30; //30 enregistrement par page
    protected $gestionSms ;
    public $SMSService;
    
    public function __construct(SmsInstantaneRepository $smsinstantaneRepository,GestionSMS $gestionSms,SMSService $SMSService)
    {
        $this->middleware('auth');
        $this->middleware('ajax', ['only' => 'store,update']);

        $this->smsinstantaneRepository = $smsinstantaneRepository; 
        $this->gestionSms = $gestionSms; 
        $this->SMSService = $SMSService; 

    }

    /**
     * Display a listing of the resource. 
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user_id = auth()->user()->id;
        $smsinstantanes = $this->smsinstantaneRepository->getSmsInstantaneByUserId($user_id, $this->nbrPerPage);
        $links = $smsinstantanes->render();// pour la pagination;

        // dd($smsinstantanes);
        return view('smsInstantane.index', compact('smsinstantanes','links','user_id'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('smsInstantane.create'); 
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateSmsInstantaneRequest $request)
    {
        $user_id = auth()->user()->id;

        $messageSaisi = $request->message; // recuperation du message saisi
        $numeros = $request->numero; // recuperation des numero
        $tableauNumero = explode(';', $numeros);
        //mettre dans un job pour envoyer les messages
        // dd($tableauNumero);

        $tableauNumeroInvalide = array();
        
        if (!empty($tableauNumero)) 
        {
            foreach ($tableauNumero as $key => $numero) 
            {

                if($this->gestionSms->verifierNumeroTelephone($numero))
                {
                    $numeroAvecIndicatif = '226'.$numero;
                    $array_for_msg = array(
                                            'to' => $numeroAvecIndicatif,
                                            'from' => 'SMARTPREST',
                                            'text' => $messageSaisi,
                                            'id' => $this->SMSService->id,
                                        );
                    // envoyer le msg
                    $codeReponse = $this->SMSService->sendSMS($array_for_msg);
                    // $codeReponse = $this->SMSService->sendSMS($array_for_msg['from'],$array_for_msg['to'],$array_for_msg['text']);


                    // enregistrer le message dans la base de donnees
                    $array = array('destinataire'=> $numeroAvecIndicatif,
                                    'message' =>  $messageSaisi,
                                    'from' => 'SMARTPREST',
                                    'dateHeure' => @gmdate('Y-m-d H:i:s'),
                                    'dlr' => $codeReponse,
                                    'user_id' => $user_id
                                );
                    $this->smsinstantaneRepository->store($array);
                }
                else
                {
                    // tracer les numeros invalide
                    $tableauNumeroInvalide[] = $numero;
                }
                
            }

        }
        
         
        return redirect('messagesinstantane')->with('success', "Le message instantané " . $request->input('message') . " a été envoyé.");
    
    
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

        $smsinstantane  = $this->smsinstantaneRepository->getById($id);
        return view('smsInstantane.show', compact('smsinstantane'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
       
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {   
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->smsinstantaneRepository->getSmsInstantaneDeleteByUserId($id);
        return redirect('messagesinstantane')->with('success', "Le message instantané  a été supprimé." );
    }
}
