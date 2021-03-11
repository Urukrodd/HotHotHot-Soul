<?php


namespace app\models;

use app\core\Application;

class Capteur
{
    public function getValeurCapteur() {
        ini_set('user_agent','Mozilla/4.0 (compatible; MSIE 6.0)');
        $valeurs = file_get_contents('http://hothothot.dog/api/capteurs/');

        return json_decode($valeurs, true, 512, JSON_THROW_ON_ERROR);
    }

    public function saveData() {
        $pdo = Application::$app->db->pdo;
        $values = $this->getValeurCapteur()['capteurs'];

        $typeInterieur = $values[0]['type'];
        $typeExterieur = $values[1]['type'];

        $nomInterieur = $values[0]['Nom'];
        $nomExterieur = $values[1]['Nom'];

        $valeurInterieur = $values[0]['Valeur'];
        $valeurExterieur = $values[1]['Valeur'];

        $timestampInterieur = date("Y-m-d H:i:s", $values[0]['Timestamp']);
        $timestampExterieur = date("Y-m-d H:i:s", $values[1]['Timestamp']);

        $SQL = "INSERT INTO hothothot (category, pos, val, created_at)
                VALUES 
                       ('$typeInterieur', '$nomInterieur', '$valeurInterieur', '$timestampInterieur'),
                       ('$typeExterieur', '$nomExterieur', '$valeurExterieur', '$timestampExterieur');";

        $pdo->exec($SQL);
    }
}