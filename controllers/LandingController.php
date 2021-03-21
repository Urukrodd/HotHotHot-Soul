<?php

declare(strict_types=1);

namespace app\controllers;

use app\core\Application;
use app\core\Controller;
use app\models\Capteur;
use PDO;

/**
 * Class LandingController
 * @package app\controllers
 */
class LandingController extends Controller
{
    /**
     * @return string
     */
    public function index(): string
    {
        $pdo = Application::$app->db->pdo;

        $stmt = $pdo->query("SELECT * FROM Capteur WHERE pos='interieur' AND created_at IN (SELECT max(created_at) FROM Capteur);");
        $interieur = $stmt->fetch();

        $stmt = $pdo->query("SELECT * FROM Capteur WHERE pos='exterieur' AND created_at IN (SELECT max(created_at) FROM Capteur);");
        $exterieur = $stmt->fetch();

        $stmt = $pdo->query("SELECT * FROM MinMax WHERE created_at IN (SELECT max(created_at) FROM MinMax);");
        $minMax = $stmt->fetch();

        $stmt_created_at = $pdo->query("SELECT created_at FROM Capteur WHERE pos='interieur' ORDER BY created_at ASC LIMIT 24");
        $stmt_val_in = $pdo->query("SELECT val FROM Capteur WHERE pos='interieur' ORDER BY created_at ASC LIMIT 24");
        $stmt_val_out = $pdo->query("SELECT val FROM Capteur WHERE pos='exterieur' ORDER BY created_at ASC LIMIT 24");
        $val_out = $stmt_val_out->fetchAll();
        $val_in = $stmt_val_in->fetchAll();
        $created_at = $stmt_created_at->fetchAll();

        return $this->render('home.html.twig', array(
            "valeurInterieur" => $interieur['val'],
            "valeurExterieur" => $exterieur['val'],
            "minInterieur" => $minMax['minInterieur'],
            "maxInterieur" => $minMax['maxInterieur'],
            "minExterieur" => $minMax['minExterieur'],
            "maxExterieur" => $minMax['maxExterieur'],
            "temperatures_out" => $val_out,
            "temperatures_in" => $val_in,
            "created_at" => $created_at,
        ));
    }
}
