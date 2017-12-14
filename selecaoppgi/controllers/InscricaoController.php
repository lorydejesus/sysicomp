<?php

namespace selecaoppgi\controllers;

class InscricaoController extends \yii\web\Controller
{
    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionInscricao()
    {
        return $this->render('inscricao');
    }

}
