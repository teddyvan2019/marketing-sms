<?php

namespace App\Services;
use App\Traits\ConsumesExternalService;
use App\Gestion\GestionSMS;


class SMSService
{
    use ConsumesExternalService;

    public $baseUri;

    public $id;

    protected $gestionSms;

    /**
     * The secret to consume the authors service
     * @var string
     */
    public $secret;

    public function __construct(GestionSMS $gestionSms)
    {
        $this->id = "69434E5E491FED8E89679B91FA13E00F";
        $this->baseUri = "https://www.lesmsbus.com:7170/ines.smsbus/smsbusMt";
        $this->gestionSms = $gestionSms; 

    }

    /**
     * Envoi un / des sms 
     * @return string
     */
      public function sendSMS($data)
    {
        return $this->performRequest('POST', '', $data);
    }

    public function sendSmsbusGet($senderId,$phoneNumber,$msg)
    {
        $id="69434E5E491FED8E89679B91FA13E00F";
        $smsbus='https://www.lesmsbus.com:7170/ines.smsbus/smsbusMt?from='.$senderId.'&id='.$id.'&msg='.urlencode($msg).'&dnr='.$phoneNumber;
        $response=@file_get_contents($smsbus);
        // echo $response; 
        return $response;
    }
    
    public function sendSMS_($senderId,$phoneNumber,$msg)
    {
        //$id = "69434E5E491FED8E89679B91FA13E00F"   ;
        
        $ch=curl_init();
        curl_setopt($ch,CURLOPT_URL,"https://www.lesmsbus.com:143/ines.smsbus/smsbusMt?");
        curl_setopt($ch,CURLOPT_POST,1);
        curl_setopt($ch,CURLOPT_POSTFIELDS,"from=".$senderId."&id=".$this->id."&text=".urlencode($msg)."&to=".$phoneNumber);
        curl_setopt($ch,CURLOPT_RETURNTRANSFER,false);
        curl_setopt($ch,CURLOPT_TIMEOUT,5);//5 seconds
        $response=curl_exec($ch);
        curl_close($ch);
        echo $response;
        return $response;
    }

    /**
     * Envoi un / des sms 
     * @param $numero le numero de telephone du destinataire
     * @param $msg le message a envoye au destinataire
     * @param $indicatif l'indicatif du pays par defaut 226 (BF)
     * @return string
     */
    public function envoyerSMS($numero, $msg, $indicatif = '226')
    {
        if($this->gestionSms->verifierNumeroTelephone($numero))
        {
            $numeroAvecIndicatif = $indicatif . $numero;
            $array_for_msg = array(
                                    'to' => $numeroAvecIndicatif,
                                    'from' => 'SMARTPREST',
                                    'text' => $msg,
                                    'id' => $this->id
                                );
            // envoyer le msg
            return  $codeReponse = $this->sendSMS($array_for_msg);
        }
        else
        {
            return 0;
        }

    }

    public function getDlrState()
    {
        
    }
}