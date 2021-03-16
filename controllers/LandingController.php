<?php

declare(strict_types=1);

namespace app\controllers;

use app\core\Application;
use app\core\Controller;
use app\models\Capteur;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Error\SyntaxError;

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

        $stmt = $pdo->query("SELECT * FROM HotHotHot WHERE pos='interieur' AND created_at IN (SELECT max(created_at) FROM HotHotHot);");
        $interieur = $stmt->fetch();

        $stmt = $pdo->query("SELECT * FROM HotHotHot WHERE pos='exterieur' AND created_at IN (SELECT max(created_at) FROM HotHotHot);");
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
