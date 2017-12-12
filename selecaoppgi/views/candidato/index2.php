<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\CandidatoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Candidatos';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="candidato-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Candidato', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'senha',
            'inicio',
            'fim',
            'passoatual',
            // 'nome',
            // 'endereco',
            // 'bairro',
            // 'cidade',
            // 'uf',
            // 'cep',
            // 'email:email',
            // 'datanascimento',
            // 'nacionalidade',
            // 'pais',
            // 'estadocivil',
            // 'rg',
            // 'orgaoexpedidor',
            // 'dataexpedicao',
            // 'passaporte',
            // 'cpf',
            // 'sexo',
            // 'telresidencial',
            // 'telcomercial',
            // 'telcelular',
            // 'nomepai',
            // 'nomemae',
            // 'cursodesejado',
            // 'regime',
            // 'inscricaoposcomp',
            // 'anoposcomp',
            // 'notaposcomp',
            // 'solicitabolsa',
            // 'vinculoemprego',
            // 'empregador',
            // 'cargo',
            // 'vinculoconvenio',
            // 'convenio',
            // 'linhapesquisa',
            // 'tituloproposta',
            // 'diploma:ntext',
            // 'historico:ntext',
            // 'motivos:ntext',
            // 'proposta:ntext',
            // 'curriculum:ntext',
            // 'cartaempregador:ntext',
            // 'comprovantepagamento:ntext',
            // 'cursograd',
            // 'instituicaograd',
            // 'crgrad',
            // 'egressograd',
            // 'dataformaturagrad',
            // 'cursoesp',
            // 'instituicaoesp',
            // 'egressoesp',
            // 'dataformaturaesp',
            // 'cursopos',
            // 'instituicaopos',
            // 'tipopos',
            // 'mediapos',
            // 'egressopos',
            // 'dataformaturapos',
            // 'periodicosinternacionais',
            // 'periodicosnacionais',
            // 'conferenciasinternacionais',
            // 'conferenciasnacionais',
            // 'instituicaoingles',
            // 'duracaoingles',
            // 'nomeexame',
            // 'dataexame',
            // 'notaexame',
            // 'empresa1',
            // 'empresa2',
            // 'empresa3',
            // 'cargo1',
            // 'cargo2',
            // 'cargo3',
            // 'periodoprofissional1',
            // 'periodoprofissional2',
            // 'periodoprofissional3',
            // 'instituicaoacademica1',
            // 'instituicaoacademica2',
            // 'instituicaoacademica3',
            // 'atividade1',
            // 'atividade2',
            // 'atividade3',
            // 'periodoacademico1',
            // 'periodoacademico2',
            // 'periodoacademico3',
            // 'resultado',
            // 'periodo',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
