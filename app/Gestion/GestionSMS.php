<?php

namespace App\Gestion;

class GestionSMS 
{
    /**
     * Methode qui permet de renvoyer un numero de telephone
     * avec 8 chiffres
     */
    public function numeroTelephoneCourt($telephone)
    {
        if(strlen($telephone)==8) 
            return $telephone;
        else 
            return substr($telephone,strlen($telephone)-8,8);
    }

    /**
     * Méthode qui permet de vérifier la validité d'un numéro de téléphone
     */
    public function verifierNumeroTelephone($telephone)
    {
        $tel = $this->numeroTelephoneCourt($telephone);
        if(preg_match("`[0-9]{8}`", $tel))
        {
            return true;
        }
        return false;
    }

    public function remplacerParametreParValeur($messageAvecParametre, $contactsPourRemplacementParametre)
    {
        
        $messageComplet    = str_replace('[nom]', $contactsPourRemplacementParametre->nom, $messageAvecParametre);
        $messageComplet    = str_replace('[prenom]', $contactsPourRemplacementParametre->prenom, $messageComplet);
        $messageComplet    = str_replace('[telephone]', $contactsPourRemplacementParametre->telephone, $messageComplet);
        $messageComplet    = str_replace('[email]', $contactsPourRemplacementParametre->email, $messageComplet);

        return $messageComplet;
    }

}