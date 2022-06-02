<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Repositories\MessageCampagneRepository;
use App\Repositories\MessageRepertoireRepository;
use App\Gestion\GestionSMS;
use App\Services\SMSService;
use App\Repositories\MessageSendCampagneRepository;


class sendMessageCampagneEveryFiveMinute extends Command
{

    protected $messagecampagneRepository;
    protected $messagerepertoireRepository;
    protected $gestionSms ;
    protected $messageSentCampagneRepository;


    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'minute:sendSms';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Envoi les messages des campagnes programmées dont la date et l\'heure d\'envoie sont atteint.';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(MessageCampagneRepository $messagecampagneRepository,
                                MessageRepertoireRepository  $messagerepertoireRepository,
                                GestionSMS $gestionSms,
                                SMSService $SMSService,
                                MessageSendCampagneRepository $messageSentCampagneRepository)
    {
        parent::__construct();
        $this->messagecampagneRepository = $messagecampagneRepository;
        $this->messagerepertoireRepository = $messagerepertoireRepository;
        $this->gestionSms = $gestionSms; 
        $this->SMSService = $SMSService; 
        $this->messageSentCampagneRepository = $messageSentCampagneRepository; 
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $dateEnvoi = @gmdate('Y-m-d');
        $heureEnvoi = @gmdate("H:i");

        /**
         * Step 1
         * Recuperer les messages a envoyer
         */
        //recuperer les messages programmee aujourd'hui et dont l;heure d'envoi est arrive
        $lesMessagesAEnvoyer = $this->messagecampagneRepository->getMessageAEnvoyerTodayAndNow($dateEnvoi, $heureEnvoi);

        if(!empty($lesMessagesAEnvoyer)) // si il y'a des messages a envoyer
        {
            foreach($lesMessagesAEnvoyer as $unMessage) // pour chaque message recuperer les clients qui doivent le recevoir 
            {
                /**
                 * Step 2
                 * Recuperer les contacts 
                 */
                $lesRepertoires = $this->messagerepertoireRepository->getrepertoireSelectionneLorsDeLaProgrammationDuMessage($unMessage->id);
                if(!empty($lesRepertoires)) // si il existe au moins un repertoire
                {
                    $laListeDesContacts = array();

                    foreach($lesRepertoires as $unRepertoire) // recuperer les contacts des differents repertoires
                    {
                        // recuperer les contacts enregistrer dans le repertoire
                        $lesContacts = $unRepertoire->repertoire->contacts;

                        if(!empty($lesContacts))
                        {
                            foreach($lesContacts as $unContact)
                            {
                                $contact = new \stdClass();
                                $contact->nom = $unContact->nom;
                                $contact->prenom = $unContact->prenom;
                                $contact->telephone = $unContact->telephone;
                                $contact->email = $unContact->email;

                                $laListeDesContacts[] = $contact;
                                unset($contact);
                            }
                        }
                    }
                }

                /**
                 * Step 3
                 * Une fois les contacts recupere , envoyer le message aux destinataires
                 */
                if( !empty($laListeDesContacts) ) // s'il ya des contacts
                {
                    foreach($laListeDesContacts as $leContact)
                    {
                        // remplacement des differents parametres existants dans le messages
                        $msgToSend = $this->gestionSms->remplacerParametreParValeur($unMessage->message, $leContact);

                        // indicatif
                        $indicatif = '226';
                        $numeroAvecIndicatif = $indicatif . $leContact->telephone;

                        // envoie du message
                        $codeReponse = $this->SMSService->envoyerSMS($leContact->telephone, $msgToSend, $indicatif);

                        // enregistrer le message envoye dans la base de donnees
                        $array = array('destinataire'=> $numeroAvecIndicatif,
                                        'message' =>  $msgToSend,
                                        'from' => 'SMARTPREST',
                                        'dateHeure' => @gmdate('Y-m-d H:i:s'),
                                        'dlr' => $codeReponse,
                                        'message_id' => $unMessage->id
                                    ); 

                        $this->messageSentCampagneRepository->store($array);
                    }

                    /**
                     * Step 4
                     * Une fois le message envoyé a tous les destinataires changer letat du msg
                     * pour signaler que ce msg est deja envoye et que l'on renvoi le message
                     */
                    //une fois tous les msg envoye note que ce msg est envoye etat passe de 1 a 2
                    $this->messagecampagneRepository->update($unMessage->id, array('etat'=>2));

                }
            }
        }
    }
}
