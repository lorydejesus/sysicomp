<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "j17_candidato_experiencia_academica".
 *
 * @property string $id
 * @property string $idCandidato
 * @property string $instituicao
 * @property string $atividade
 * @property string $periodo
 *
 * @property J17Candidatos $idCandidato0
 */
class ExperienciaAcademica extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'j17_candidato_experiencia_academica';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['idCandidato', 'instituicao'], 'required'],
            [['idCandidato'], 'integer'],
            [['instituicao', 'atividade', 'periodo'], 'string', 'max' => 30],
            [['idCandidato'], 'exist', 'skipOnError' => true, 'targetClass' => J17Candidatos::className(), 'targetAttribute' => ['idCandidato' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'idCandidato' => 'Id Candidato',
            'instituicao' => 'Instituicao',
            'atividade' => 'Atividade',
            'periodo' => 'Periodo',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdCandidato0()
    {
        return $this->hasOne(J17Candidatos::className(), ['id' => 'idCandidato']);
    }
}
