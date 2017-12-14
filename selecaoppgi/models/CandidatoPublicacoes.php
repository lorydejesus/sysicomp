<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "j17_candidato_publicacoes".
 *
 * @property integer $id
 * @property string $idCandidato
 * @property string $titulo
 * @property integer $ano
 * @property string $local
 * @property integer $tipo
 * @property string $natureza
 * @property string $autores
 *
 * @property J17Candidatos $idCandidato0
 */
class CandidatoPublicacoes extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'j17_candidato_publicacoes';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            //[['idCandidato', 'titulo', 'ano', 'local', 'tipo', 'natureza', 'autores'], 'required'],
            [['idCandidato', /*'ano', 'tipo'*/], 'integer'],
            ///[['titulo', 'local', 'autores'], 'string', 'max' => 300],
            [['natureza'], 'string', 'max' => 100],
            [['idCandidato'], 'exist', 'skipOnError' => true, 'targetClass' => Candidato::className(), 'targetAttribute' => ['idCandidato' => 'id']],
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
            'titulo' => 'Titulo',
            'ano' => 'Ano',
            'local' => 'Local',
            'tipo' => 'Tipo',
            'natureza' => 'Natureza',
            'autores' => 'Autores',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdCandidato0()
    {
        return $this->hasOne(Candidato::className(), ['id' => 'idCandidato']);
    }
}
