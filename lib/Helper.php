<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 01/01/2017
 * Time: 21:03
 */

class Helper
{
    // VAT PRICE / Prix TVA
    public function priceVAT($price, $vat){
        $priceVat = (($price*$vat)/100)+$price;
        return $priceVat;
    }

    public static function validateEmail($email)
    {
        // SET INITIAL RETURN VARIABLES

        $emailIsValid = FALSE;

        // MAKE SURE AN EMPTY STRING WASN'T PASSED

        if (!empty($email))
        {
            // GET EMAIL PARTS

            $domain = ltrim(stristr($email, '@'), '@');
            $user   = stristr($email, '@', TRUE);

            // VALIDATE EMAIL ADDRESS

            if
            (
                !empty($user) &&
                !empty($domain) &&
                checkdnsrr($domain)
                /*
                 * checkdnsrr vérifie si le domaine d'une adresse email possède un enregistrement MX (Mail eXchanger).
                 * Un enregistrement Mail eXchanger (MX) est un type d'enregistrements du Domain Name System qui associe un nom de domaine à un serveur de messagerie électronique associé à son numéro de préférence.
                 * Pour faire bref : il vérifie si le nom de domaine existe.
                 */
            )
            {$emailIsValid = TRUE;}
        }

        // RETURN RESULT

        return $emailIsValid;
    }

}