<?php
use app\models\MembrosBanca;
?>
<aside class="main-sidebar">

    <section class="sidebar">

        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="img/<?php
                        if(Yii::$app->user->identity->administrador) echo "administrador";
                        else if(Yii::$app->user->identity->coordenador) echo "coordenador";
                        else if(Yii::$app->user->identity->professor) echo "professor";
                        else if(Yii::$app->user->identity->secretaria) echo "secretaria";
                        else echo "aluno";
                    ?>.png" class="img-circle" alt="User Image"/>
            </div>
            <div class="pull-left info" style="white-space:normal;padding-right:10px;">
                <?= Yii::$app->user->identity->nome ?>
            </div>
        </div>

        <?= dmstr\widgets\Menu::widget([
            'options' => ['class' => 'sidebar-menu'],
            'items' => [
                ['label' => 'Início','icon' => 'fa fa-home', 'url' => ['site/index'],],
                ['label' => 'Administração', 'options' => ['class' => 'header'], 'visible' => Yii::$app->user->identity->checarAcesso('administrador')],
                [
                    'label' => 'Usuários',
                    'icon' => 'fa fa-users',
                    'url' => '#',
                    'visible' => (Yii::$app->user->identity->checarAcesso('administrador') || Yii::$app->user->identity->checarAcesso('secretaria')),
                    'items' => [
                        ['label' => 'Adicionar Usuário', 'icon' => 'fa fa-user-plus', 'url' => ['site/signup'],],
                        ['label' => 'Listar Usuários', 'icon' => 'fa fa-list', 'url' => ['user/index'], 'active' => $this->context->route == 'user/update' || $this->context->route == 'user/view' || $this->context->route == 'user/index' ],
                    ],
                ],
                ['label' => 'Coordenação PPGI', 'options' => ['class' => 'header'], 'visible' => Yii::$app->user->identity->checarAcesso('coordenador')],
                [
                    'label' => 'Seleções PPGI',
                    'icon' => 'fa fa-hand-lizard-o',
                    'url' => '#',
                    'visible' => Yii::$app->user->identity->checarAcesso('coordenador') || Yii::$app->user->identity->checarAcesso('secretaria'),
                    'items' => [
                        ['label' => 'Criar Edital de Seleção', 'icon' => 'fa fa-calendar-plus-o', 'url' => ['edital/create'],],
                        ['label' => 'Listar Editais de Seleção', 'icon' => 'fa fa-list', 'url' => ['edital/index'],],
                    ],
                ],
                [
                    'label' => 'Gerenciar Defesas',
                    'icon' => 'fa fa-calendar-check-o',
                    'url' => '#',
                    'visible' => Yii::$app->user->identity->checarAcesso('coordenador'),
                    'items' => [
                        ['label' => 'Defesas a serem avaliadas', 'icon' => 'fa fa-calendar-check-o', 'url' => ['banca-controle-defesas/index'],],
                        ['label' => 'Listar todas as defesas', 'icon' => 'fa fa-list', 'url' => ['defesa/index'],],
                    ],
                ],
                [
                    'label' => 'Linhas de Pesquisa',
                    'icon' => 'fa fa-search',
                    'url' => '#',
                    'visible' => (Yii::$app->user->identity->checarAcesso('administrador') || Yii::$app->user->identity->checarAcesso('coordenador')),
                    'items' => [
                        ['label' => 'Adicionar Linha de Pesquisa', 'icon' => 'fa fa-search-plus', 'url' => ['linha-pesquisa/create'],],
                        ['label' => 'Listar Linhas de Pesquisa', 'icon' => 'fa fa-list', 'url' => ['linha-pesquisa/index'],],
                    ],
                ],
                ['label' => 'Professor', 'options' => ['class' => 'header'], 'visible' => Yii::$app->user->identity->checarAcesso('professor')],
                [
                    'label' => 'Afastamento Temporário',
                    'icon' => 'fa fa-plane',
                    'url' => '#',
                    'visible' => Yii::$app->user->identity->checarAcesso('professor'),
                    'items' => [
                        ['label' => 'Solicitar Afastamento', 'icon' => 'fa fa-calendar-plus-o', 'url' => ['afastamentos/create'],],
                        ['label' => 'Meus Afastamentos', 'icon' => 'fa fa-list', 'url' => ['afastamentos/index'],],
                    ],
                ],
                ['label' => 'Minhas Férias', 'icon' => 'fa fa-sun-o', 'url' => ['ferias/listar', "ano" => date("Y") ], 'visible' => Yii::$app->user->identity->checarAcesso('professor'),],
				['label' => 'Reserva de Sala', 'icon' => 'fa fa-calendar', 'url' => ['reserva-sala/index'], 'visible' => Yii::$app->user->identity->checarAcesso('professor'),],
                ['label' => 'Acompanhar Orientandos', 'icon' => 'fa fa-eye', 'url' => ['aluno/orientandos'], 'visible' => Yii::$app->user->identity->checarAcesso('professor'),],
				['label' => 'Meus Projetos', 'icon' => 'fa fa-signal', 'url' => ['cont-proj-projetos/index'], 'visible' => Yii::$app->user->identity->checarAcesso('professor'),],
                ['label' => 'Upload Lattes', 'icon' => 'fa fa-upload', 'url' => ['user/lattes'], 'visible' => Yii::$app->user->identity->checarAcesso('professor'),],
				['label' => 'Gerar PIT', 'icon' => 'fa fa-refresh', 'url' => ['user/pit'], 'visible' => Yii::$app->user->identity->checarAcesso('professor'),],
				['label' => 'Gerar RIT', 'icon' => 'fa fa-refresh', 'url' => ['user/rit'], 'visible' => Yii::$app->user->identity->checarAcesso('professor'),],
				['label' => 'Gerar Relatório Bancas', 'icon' => 'fa fa-refresh', 'url' => ['defesa/bancasbymembro', 'idProfessor'=>Membrosbanca::membroIdByUserId(Yii::$app->user->id)], 'visible' => Yii::$app->user->identity->checarAcesso('professor')||Yii::$app->user->identity->checarAcesso('administrador'),],

                ['label' => 'Secretaria', 'options' => ['class' => 'header'], 'visible' => Yii::$app->user->identity->checarAcesso('secretaria')],
                [
                    'label' => 'Alunos',
                    'icon' => 'fa fa-graduation-cap',
                    'url' => '#',
                    'visible' => Yii::$app->user->identity->checarAcesso('secretaria'),
                    'items' => [
                        ['label' => 'Gerenciar Alunos', 'icon' => 'fa fa-list', 'url' => ['aluno/index'],],
                        ['label' => 'Alunos com prazo vencido', 'icon' => 'fa fa-calendar-times-o', 'url' => ['aluno/prazo_vencido'], 'visible' => Yii::$app->user->identity->checarAcesso('coordenador'), 'visible' => Yii::$app->user->identity->checarAcesso('secretaria'),],
                    ],
                ],
            	[
            		'label' => 'Gerenciar Disciplinas Aproveit.',
	            	'icon' => 'glyphicon glyphicon-duplicate',
            		'url' => ['disciplina/index'],
            		'visible' => Yii::$app->user->identity->checarAcesso('secretaria'),
            		],
            		[
            		'label' => 'Gerenciar Aproveitamentos.',
            		'icon' => 'glyphicon glyphicon-duplicate',
            		'url' => ['aproveitamento/index'],
            		'visible' => Yii::$app->user->identity->checarAcesso('secretaria'),
            		],
                [
                    'label' => 'Gerenciar Prorrogações',
                    'icon' => 'fa fa-clock-o',
                    'url' => ['prorrogacao/index'],
                    'visible' => Yii::$app->user->identity->checarAcesso('secretaria'),
                ],
                [
                    'label' => 'Gerenciar Trancamentos',
                    'icon' => 'fa fa-lock',
                    'url' => ['trancamento/index'],
                    'visible' => Yii::$app->user->identity->checarAcesso('secretaria'),
                ],
                [
                    'label' => 'Gerenciar Férias',
                    'icon' => 'fa fa-umbrella',
                    'url' => '#',
                    'visible' => Yii::$app->user->identity->checarAcesso('secretaria'),
                    'items' => [
                        ['label' => 'Minhas Férias', 'icon' => 'fa fa-sun-o', 'url' => ['ferias/listar', "ano" => date("Y") ],],
                        ['label' => 'Controlar Férias', 'icon' => 'fa fa-list', 'url' => ['ferias/listartodos', "ano" => date("Y") ],],
                    ],
                ],
                [
                    'label' => 'Reserva de Sala',
                    'icon' => 'fa fa-calendar',
                    'url' => '#',
                    'visible' => Yii::$app->user->identity->checarAcesso('secretaria'),
                    'items' => [
                        ['label' => 'Gerenciar Salas', 'icon' => 'fa fa-building-o', 'url' => ['sala/index'],],
                        ['label' => 'Reservar Sala', 'icon' => 'fa fa-calendar-plus-o', 'url' => ['reserva-sala/index'],],
                    ],
                ],
		  [
                    'label' => 'Gerenciar Defesas',
                    'icon' => 'fa fa-calendar-check-o',
                    'url' => '#',
                    'visible' => Yii::$app->user->identity->checarAcesso('secretaria'),
                    'items' => [
                        ['label' => 'Visualizar Defesas', 'icon' => 'fa fa-list', 'url' => ['defesa/index'],],
                        ['label' => 'Membros de Banca', 'icon' => 'fa fa-users', 'url' => ['membros-banca/index'],],
                    	['label' => 'Gerar Relatório Bancas', 'icon' => 'fa fa-refresh', 'url' => ['defesa/bancasallmembro'], 'visible' => Yii::$app->user->identity->checarAcesso('secretaria')||Yii::$app->user->identity->checarAcesso('administrador'),],
                    ],
                ],

                [
                    'label' => 'Afastamento Temporário',
                    'icon' => 'fa fa-plane',
                    'url' => '#',
                    'visible' => Yii::$app->user->identity->checarAcesso('secretaria'),
                    'items' => [
                        ['label' => 'Solicitar Afastamento', 'icon' => 'fa fa-file-code-o', 'url' => ['afastamentos/create'],],
                        ['label' => 'Listar Afastamentos', 'icon' => 'fa fa-list', 'url' => ['afastamentos/index'],],
                    ],
                ],
				['label' => 'Upload CSV Disciplinas', 'icon' => 'fa fa-upload', 'url' => ['user/cvsdisciplinas'], 'visible' => Yii::$app->user->identity->checarAcesso('secretaria'),],
				['label' => 'Upload CSV Alunos', 'icon' => 'fa fa-upload', 'url' => ['user/cvsalunos'], 'visible' => Yii::$app->user->identity->checarAcesso('secretaria'),],
				[
                    'label' => 'Controle de Projetos',
                    'icon' => 'fa fa-money',
                    'url' => '#',
                    'visible' => Yii::$app->user->identity->checarAcesso('secretaria'),
                    'items' => [
						['label' => 'Bancos', 'icon' => 'fa fa-bank', 'url' => ['cont-proj-bancos/index'],],
						['label' => 'Agências de Fomento', 'icon' => 'fa fa-gift', 'url' => ['cont-proj-agencias/index'],],
						['label' => 'Tipos de Rubricas', 'icon' => 'fa fa-gears', 'url' => ['cont-proj-rubricas/index'],],
						['label' => 'Projetos', 'icon' => 'fa fa-signal', 'url' => ['cont-proj-projetos/index'],],
                        ['label' => 'Saldo Rubricas', 'icon' => 'fa fa-clone', 'url' => ['cont-proj-rubricasde-projetos/consultar'],],

                    ],
                ],
		        [
                    'label' => 'Controle de Equipamentos',
                    'icon' => 'fa fa-list',
                    'url' => '#',
                    'visible' => Yii::$app->user->identity->checarAcesso('secretaria'),
                    'items' => [
                        ['label' => 'Gerenciar Equipamentos', 'icon' => 'fa fa-sun-o', 'url' => ['equipamento/index'],],
			['label' => 'Gerar Cautela', 'icon' => 'fa fa-list', 'url' => ['cautela/index'],],
                        ['label' => 'Gerar Cautela Avulsa', 'icon' => 'fa fa-refresh', 'url' => ['cautela-avulsa/index'],],
                        /*['label' => 'Descarte de Equipamentos', 'icon' => 'fa fa-trash', 'url' => ['descarte-equipamento/index'],],*/

                    ],
                ],

				//['label' => 'despesas', 'icon' => 'fa fa-calendar', 'url' => ['cont-proj-despesas/index'], 'visible' => Yii::$app->user->identity->checarAcesso('professor'),],

				//['label' => 'receitas', 'icon' => 'fa fa-calendar', 'url' => ['cont-proj-receitas/index'], 'visible' => Yii::$app->user->identity->checarAcesso('professor'),],
				//['label' => 'Registrar Datas', 'icon' => 'fa fa-cog fa-spin', 'url' => ['cont-proj-registra-datas/index'], 'visible' => Yii::$app->user->identity->checarAcesso('secretaria'),],
				//['label' => 'rubricas de projeto', 'icon' => '', 'url' => ['cont-proj-rubricasde-projetos/index'], 'visible' => Yii::$app->user->identity->checarAcesso('professor'),],
				//['label' => 'transferencia de rubricas', 'icon' => 'fa fa-calendar', 'url' => ['cont-proj-rubricasde-projetos/index'], 'visible' => Yii::$app->user->identity->checarAcesso('professor'),],
				//['label' => 'transferencia de saldo de rubricas', 'icon' => 'fa fa-calendar', 'url' => ['cont-proj-transferencias-saldo-rubricas/index'], 'visible' => Yii::$app->user->identity->checarAcesso('professor'),],

			  // ['label' => 'Aluno', 'options' => ['class' => 'header'], 'visible' => Yii::$app->user->identity->checarAcesso('aluno')],
               // ['label' => 'Aluno Opção', 'icon' => 'fa fa-file-code-o', 'url' => ['site/index'], 'visible' => Yii::$app->user->identity->checarAcesso('professor'),],
            ],
        ]) ?>
    </section>

</aside>
