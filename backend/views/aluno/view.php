<?php

use app\models\Aluno;
use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\grid\GridView;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model app\models\Aluno */

$this->title = $model->nome;
$this->params['breadcrumbs'][] = ['label' => 'Alunos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $model->nome;

$statusAluno = array(0 => 'Aluno Corrente',1 => 'Aluno Egresso',2 => 'Aluno Desistente',3 => 'Aluno Desligado',4 => 'Aluno Jubilado',5 => 'Aluno com Matrícula Trancada');

$exameProficienciaAluno = array(null => "Não Avaliado", 0 => 'Reprovado',1 => 'Aprovado');

$this->registerCss("
    table.detail-view th {
            width: 20%;
    }

    table.detail-view td {
            width: 80%;
    }
");

?>
<div class="aluno-view">

    <p>
        <?= Html::a('<span class="glyphicon glyphicon-arrow-left"></span>&nbsp;&nbsp;Voltar','#',['class' => 'btn btn-warning','onclick'=>"history.go(-1);"]); ?>
        <?= Html::a('<span class="fa fa-list"></span>&nbsp;&nbsp;Listar Alunos', ['index'], ['class' => 'btn btn-success']) ?>
		<?= Html::a('<span class="glyphicon glyphicon-edit"></span> Editar  ', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('<span class="fa fa-trash-o"></span> Excluir', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Você tem certeza que deseja excluir este item?',
                'method' => 'post',
            ],
        ]) ?>
        <?= Html::a('<span class="fa fa-graduation-cap"></span> Cadastrar Defesa', ['defesa/create', 'aluno_id' => $model->id], ['class' => 'btn btn-success']) ?>
        <?= Html::a('<span class="fa fa-comments"></span> Exame de Proeficiência', ['aluno/exame', 'id' => $model->id], ['class' => 'btn btn-info']) ?>
		<?= Html::a('<span class="fa fa-lock"></span> Registrar Trancamento', ['trancamento/create', 'idAluno' => $model->id], ['class' => 'btn btn-danger']) ?>
		<?= Html::a('<span class="fa fa-clock-o"></span> Registrar Prorrogação', ['prorrogacao/create', 'idAluno' => $model->id], ['class' => 'btn btn-warning']) ?>
		<?= Html::a('<span class="glyphicon glyphicon-duplicate"></span> Aproveitar Disciplina', ['aproveitamento/indexbyaluno', 'idAluno' => $model->id], ['class' => 'btn btn-info']) ?>
    </p>

    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title"><b>Dados Pessoais</b></h3>
        </div>
        <div class="panel-body">
        <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'nome',
            'email:email',
            [
                'attribute' => 'curso',
                'label'=> 'Endereço',
                'value' => $model->endereco. ", Bairro ".$model->bairro.", Cidade ".$model->cidade. "-".$model->uf. ", CEP ".$model->cep
            ],
            'cpf',
            'telresidencial',
            'telcelular',
            'cursograd',
            'instituicaograd',
            'egressograd',
        ],
        ]) ?>
        </div>
    </div>

    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title"><b>Situação no PPGI</b></h3>
        </div>
        <div class="panel-body">
        <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
           'matricula',
            'orientador',
            [
                'attribute' => 'area',
                'label'=> 'Linha de Pesquisa',
            ],
            [
                'attribute' => 'curso',
                'format'=>'raw',
                'value' => $model->curso == 1 ? 'Mestrado' : 'Doutorado'
            ],
            [
                'attribute' => 'bolsista',
                'format'=>'raw',
                'value' => $model->bolsista == 1 ? 'SIM: '.$model->financiadorbolsa.' implementada em '.date("d/m/Y", strtotime($model->dataimplementacaobolsa)) : 'NÃO'
            ],
            [   'label' => 'Status',
                'attribute' => 'status',
                'value' => Aluno::getStatusFromId($model->status)
            ],
            [
                'label' => 'Data de Ingresso',
                'attribute' => 'dataingresso',
                'value' => date("d/m/Y", strtotime($model->dataingresso)),
            ],
        ],
        ]) ?>
        </div>
    </div>
    <?php
    $this->registerCss("
        .flex-container{
            display: flex;
            justify-content: space-between;
            padding-right: 2em;
            align-items: center;
        }
        
        .add-btn{
            font-size: 1.5em;
            color: #1fc132;
        }
    ");

    $add_trancamento_url = Url::to(['trancamento/create', 'idAluno' => $model->id]);
    $add_prorrogacao_url = Url::to(['prorrogacao/create', 'idAluno' => $model->id]);


    ?>


    <div class="panel panel-default">
        <div class="panel-heading flex-container">
            <h3 class="panel-title"><b>Trancamentos</b></h3>
            <?= Html::a('<span class="glyphicon glyphicon-plus add-btn"></span>', $add_trancamento_url,
                [
                    'title'        => 'create',
                    'data-method'  => 'post',
                ]
                );
            ?>
        </div>
        <div class="panel-body">
            <?= GridView::widget([
                'dataProvider'=>$trancamentos_provider,
                'columns' => [
                    'dataSolicitacao',
                    'dataInicio',
                    'prevTermino',
                    'qtd_dias',
                    [
                        'label' => 'Responsável',
                        'value' => function ($model) {
                            return $model->responsavel->nome;
                        },
                    ],
                    ['class' => 'yii\grid\ActionColumn',
                        'template'=>'{view} {update} {delete}',
                        'buttons'=>[
                            'delete' => function ($url, $model) {
                                $url = Url::to(['trancamento/delete', 'id' => $model->id]);

                                return Html::a('<span class="glyphicon glyphicon-trash"></span>', $url,
                                    [
                                        'title'        => 'delete',
                                        'data-confirm' => Yii::t('yii', 'Deletar Trancamento?'),
                                        'data-method'  => 'post',
                                    ]
                                );
                            },
                            'update' => function ($url, $model) {
                                $url = Url::to(['trancamento/update', 'id' => $model->id]);

                                return Html::a('<span class="glyphicon glyphicon-pencil"></span>', $url,
                                    [
                                        'title'        => 'update',
                                        'data-method'  => 'post',
                                    ]
                                );
                            },
                            'view' => function ($url, $model) {
                                $url = Url::to(['trancamento/view', 'id' => $model->id]);

                                return Html::a('<span class="glyphicon glyphicon-eye-open"></span>', $url,
                                    [
                                        'title'        => 'update',
                                        'data-method'  => 'post',
                                    ]
                                );
                            }

                        ]
                    ]
                ]
            ]) ?>
        </div>
    </div>

    <div class="panel panel-default">
        <div class="panel-heading flex-container">
            <h3 class="panel-title"><b>Prorrogações</b></h3>
            <?= Html::a('<span class="glyphicon glyphicon-plus add-btn"></span>', $add_prorrogacao_url,
                [
                    'title'        => 'create',
                    'data-method'  => 'post',
                ]
            );
            ?>
        </div>
        <div class="panel-body">
            <?= GridView::widget([
                'dataProvider'=>$prorrogacoes_provider,
                'columns' => [
                    'dataSolicitacao',
                    'dataInicio',
                    'data_termino',
                    'qtdDias',
                    [
                        'label' => 'Responsável',
                        'value' => function ($model) {
                            return $model->responsavel->nome;
                        },
                    ],
                    ['class' => 'yii\grid\ActionColumn',
                        'template'=>'{view} {update} {delete}',
                        'buttons'=>[
                            'delete' => function ($url, $model) {
                                $url = Url::to(['prorrogacao/delete', 'id' => $model->id]);

                                return Html::a('<span class="glyphicon glyphicon-trash"></span>', $url,
                                    [
                                        'title'        => 'delete',
                                        'data-confirm' => Yii::t('yii', 'Deletar Trancamento?'),
                                        'data-method'  => 'post',
                                    ]
                                );
                            },
                            'update' => function ($url, $model) {
                                $url = Url::to(['prorrogacao/update', 'id' => $model->id]);

                                return Html::a('<span class="glyphicon glyphicon-pencil"></span>', $url,
                                    [
                                        'title'        => 'update',
                                        'data-method'  => 'post',
                                    ]
                                );
                            },
                            'view' => function ($url, $model) {
                                $url = Url::to(['prorrogacao/view', 'id' => $model->id]);

                                return Html::a('<span class="glyphicon glyphicon-eye-open"></span>', $url,
                                    [
                                        'title'        => 'update',
                                        'data-method'  => 'post',
                                    ]
                                );
                            }
                        ]
                    ]
                ]
            ]) ?>
        </div>
    </div>

    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title"><b>Alterações Cadastrais</b></h3>
        </div>
        <div class="panel-body">
            <?= GridView::widget([
                'dataProvider'=>$modifications_provider,
                'columns' => [
                    'atributo',
                    'antigo_valor',
                    'novo_valor',
                    [
                        'attribute' => 'data',
                        'format' => ['date', 'php:d/m/Y']
                    ],
                    [
                        'label' => 'Responsável',
                        'value' => function ($model) {
                            return $model->responsavel->nome;
                        },
                    ]
                ]
            ]) ?>
        </div>
    </div>

    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title"><b>Exame de Proficiência</b></h3>
        </div>
        <div class="panel-body">
        <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'idiomaExameProf',
            'conceitoExameProf',
            [
                'label' => 'Data do Exame de Proficiência',
                'attribute' => 'dataExameProf',
                'value' => date("d/m/Y", strtotime($model->dataExameProf)),
            ],
        ],
        ]) ?>
        </div>
    </div>


    <?php foreach ($defesas as $defesa): ?>

    <div class="panel panel-default">
        <div class="panel-heading" style="vertical-align:bottom">
            <h3 style="float:left;padding-top:3px;" class="panel-title"><b>Defesa <?= $defesa->tipoDefesa ?></b></h3>
            <div style="float:right">
                <?= Html::a('Ver Detalhes',['defesa/view','idDefesa'=>$defesa->idDefesa,'aluno_id'=>$defesa->aluno_id],['class' => 'btn btn-primary btn-xs','options'=>[ 'target' => '_blank']]); ?>
            </div>
            <div style="clear:both">
            </div>
        </div>
        <div class="panel-body">

            <?= DetailView::widget([
                'model' => $defesa,
                'attributes' => [
                    'titulo', // <- clique aqui para
                    'conceito',
                    [
                        'label' => 'Data da Defesa',
                        'attribute' => 'data',
                        'value' => date("d/m/Y", strtotime($defesa->data)),
                    ],
                ],
            ]) ?>

        </div>
    </div>

    <?php endforeach; ?>
