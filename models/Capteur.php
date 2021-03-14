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

    public function saveMinMaxValues() {
        $pdo = Application::$app->db->pdo;
        $values = $this->getValeurCapteur()['capteurs'];

        $current_date = date("Y-m-d");

        $typeInterieur = $values[0]['type'];
        $valeurInterieur = $values[0]['Valeur'];
        $valeurExterieur = $values[1]['Valeur'];
        $timestamp = date("Y-m-d", $values[0]['Timestamp']);

        $SQL = "SELECT count(*) FROM minmax";
        $nbRows = $pdo->query($SQL)->fetch();

        if ((int)$nbRows[0] === 0) {
            $SQL = "INSERT INTO minmax (typed, minInterieur, maxInterieur, minExterieur, maxExterieur, created_at) VALUES('$typeInterieur', '$valeurInterieur', '$valeurInterieur', '$valeurExterieur', '$valeurExterieur', '$timestamp');";
            $pdo->exec($SQL);
        }

        $SQL = "SELECT * FROM minmax";
        $rows = $pdo->query($SQL);


        if (is_array($rows) || is_object($rows)) {
            foreach ($rows as $row) {
                if ($current_date === date('Y-m-d', strtotime($row["created_at"]))) {

                    $id = $row['id'];
                    $minInterieur = $row['minInterieur'];
                    $maxInterieur = $row['maxInterieur'];
                    $minExterieur = $row['minExterieur'];
                    $maxExterieur = $row['maxExterieur'];

                    if ($row['minInterieur'] > $valeurInterieur) {
                        $SQL = "UPDATE minmax SET typed='$typeInterieur', minInterieur='$valeurInterieur', maxInterieur='$maxInterieur', minExterieur='$minExterieur', maxExterieur='$maxExterieur', created_at='$timestamp' WHERE id='$id';";
                    } elseif ($row['maxInterieur'] < $valeurInterieur) {
                        $SQL = "UPDATE minmax SET typed='$typeInterieur', minInterieur='$minInterieur', maxInterieur='$valeurInterieur', minExterieur='$minExterieur', maxExterieur='$maxExterieur', created_at='$timestamp' WHERE id='$id';";
                    } elseif ($row['minExterieur'] > $valeurExterieur) {
                        $SQL = "UPDATE minmax SET typed='$typeInterieur', minInterieur='$minInterieur', maxInterieur='$maxInterieur', minExterieur='$valeurExterieur', maxExterieur='$maxExterieur', created_at='$timestamp' WHERE id='$id';";
                    } elseif ($row['maxExterieur'] < $valeurExterieur) {
                        $SQL = "UPDATE minmax SET typed='$typeInterieur', minInterieur='$minInterieur', maxInterieur='$maxInterieur', minExterieur='$minExterieur', maxExterieur='$valeurExterieur', created_at='$timestamp' WHERE id='$id';";
                    }
                }
            }
            $pdo->query($SQL);
        }
    }

    public function getMinMaxValues() {
        $pdo = Application::$app->db->pdo;
        $current_date = date("Y-m-d");

        $SQL = "SELECT minInterieur,maxInterieur,minExterieur,maxExterieur FROM minmax WHERE created_at='$current_date'";

        return $pdo->query($SQL)->fetch();
    }
}