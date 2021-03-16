<?php

declare(strict_types=1);

namespace app\controllers;

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
        try {
            $capteurModel = new Capteur;

			return $this->render('home.html.twig', array(
                "valeurInterieur" => $capteurModel->getValeurCapteur()['capteurs'][0]['Valeur'],
                "valeurExterieur" => $capteurModel->getValeurCapteur()['capteurs'][1]['Valeur'],
                "minInterieur" => $capteurModel->getMinMaxValues()['minInterieur'],
                "maxInterieur" => $capteurModel->getMinMaxValues()['maxInterieur'],
                "minExterieur" => $capteurModel->getMinMaxValues()['minExterieur'],
                "maxExterieur" => $capteurModel->getMinMaxValues()['maxExterieur'],
            ));
		} catch (LoaderError | RuntimeError | SyntaxError $e) {
        }
    }
}
