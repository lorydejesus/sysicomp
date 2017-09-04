<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "j17_aluno_modifications".
 *
 * @property int $id
 * @property int $id_responsavel
 * @property int $id_aluno
 * @property string $atributo
 * @property string $antigo_valor
 * @property string $novo_valor
 * @property string $data
 *
 * @property Aluno $aluno
 * @property User $responsavel
 */
class AlunoModification extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'j17_aluno_modifications';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_responsavel', 'id_aluno', 'atributo',], 'required'],
            [['id_responsavel', 'id_aluno'], 'integer'],
            [['data'], 'safe'],
            [['atributo'], 'string', 'max' => 50],
            [['antigo_valor', 'novo_valor'], 'string', 'max' => 2000],
            [['id_aluno'], 'exist', 'skipOnError' => true, 'targetClass' => Aluno::className(), 'targetAttribute' => ['id_aluno' => 'id']],
            [['id_responsavel'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['id_responsavel' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_responsavel' => 'Id Responsavel',
            'id_aluno' => 'Id Aluno',
            'atributo' => 'Atributo',
            'antigo_valor' => 'Antigo Valor',
            'novo_valor' => 'Novo Valor',
            'data' => 'Data',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAluno()
    {
        return $this->hasOne(Aluno::className(), ['id' => 'id_aluno']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getResponsavel()
    {
        return $this->hasOne(User::className(), ['id' => 'id_responsavel']);
    }
}
