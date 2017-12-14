<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "j17_edital".
 *
 * @property integer $numero
 * @property string $cartarecomendacao
 * @property string $datainicio
 * @property string $datafim
 * @property string $documento
 *
 * @property J17Candidatos[] $j17Candidatos
 */
class Edital extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'j17_edital';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['numero', 'cartarecomendacao', 'datainicio', 'datafim', 'documento'], 'required'],
            [['numero'], 'integer'],
            [['datainicio', 'datafim'], 'safe'],
            [['cartarecomendacao'], 'string', 'max' => 1],
            [['documento'], 'string', 'max' => 100],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'numero' => 'Numero',
            'cartarecomendacao' => 'Cartarecomendacao',
            'datainicio' => 'Datainicio',
            'datafim' => 'Datafim',
            'documento' => 'Documento',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getJ17Candidatos()
    {
        return $this->hasMany(J17Candidatos::className(), ['idEdital' => 'numero']);
    }



//este método responsável por obter os editais os quais estão dentro do prazo inicial e final
//é usado no sitecontroller(frontend), _form0 e login.php(este ultimo, neste caminho: views/adminLTE/yii2soft/yiisoft/yii2-app/site/login.php)
    public function getEditaisDisponiveis(){

        $edital = Edital::find()->where(['<=','datainicio',date('Y-m-d')])->andWhere(['>=','datafim',date('Y-m-d')])->all();
	Yii::warning("ooooo:" . date('Y-m-d H:i:s'));

        return $edital;
    }

    //fim do método de obter editais disponíveis
}
