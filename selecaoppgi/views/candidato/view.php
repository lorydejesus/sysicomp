<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Candidato */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Candidatos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="candidato-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'senha',
            'inicio',
            'fim',
            'passoatual',
            'nome',
            'endereco',
            'bairro',
            'cidade',
            'uf',
            'cep',
            'email:email',
            'datanascimento',
            'nacionalidade',
            'pais',
            'estadocivil',
            'rg',
            'orgaoexpedidor',
            'dataexpedicao',
            'passaporte',
            'cpf',
            'sexo',
            'telresidencial',
            'telcomercial',
            'telcelular',
            'nomepai',
            'nomemae',
            'cursodesejado',
            'regime',
            'inscricaoposcomp',
            'anoposcomp',
            'notaposcomp',
            'solicitabolsa',
            'vinculoemprego',
            'empregador',
            'cargo',
            'vinculoconvenio',
            'convenio',
            'linhapesquisa',
            'tituloproposta',
            'diploma:ntext',
            'historico:ntext',
            'motivos:ntext',
            'proposta:ntext',
            'curriculum:ntext',
            'cartaempregador:ntext',
            'comprovantepagamento:ntext',
            'cursograd',
            'instituicaograd',
            'crgrad',
            'egressograd',
            'dataformaturagrad',
            'cursoesp',
            'instituicaoesp',
            'egressoesp',
            'dataformaturaesp',
            'cursopos',
            'instituicaopos',
            'tipopos',
            'mediapos',
            'egressopos',
            'dataformaturapos',
            'periodicosinternacionais',
            'periodicosnacionais',
            'conferenciasinternacionais',
            'conferenciasnacionais',
            'instituicaoingles',
            'duracaoingles',
            'nomeexame',
            'dataexame',
            'notaexame',
            'empresa1',
            'empresa2',
            'empresa3',
            'cargo1',
            'cargo2',
            'cargo3',
            'periodoprofissional1',
            'periodoprofissional2',
            'periodoprofissional3',
            'instituicaoacademica1',
            'instituicaoacademica2',
            'instituicaoacademica3',
            'atividade1',
            'atividade2',
            'atividade3',
            'periodoacademico1',
            'periodoacademico2',
            'periodoacademico3',
            'resultado',
            'periodo',
        ],
    ]) ?>

</div>
