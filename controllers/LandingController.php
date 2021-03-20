<?php

declare(strict_types=1);

namespace app\controllers;

use app\core\Application;
use app\core\Controller;

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

        return $this->render('home.html.twig', array(
            "valeurInterieur" => $interieur['val'],
            "valeurExterieur" => $exterieur['val'],
            "minInterieur" => $minMax['minInterieur'],
            "maxInterieur" => $minMax['maxInterieur'],
            "minExterieur" => $minMax['minExterieur'],
            "maxExterieur" => $minMax['maxExterieur'],
        ));
    }
}
