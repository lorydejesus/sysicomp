<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "j17_linhaspesquisa".
 *
 * @property string $id
 * @property string $nome
 * @property string $descricao
 * @property string $sigla
 */
class LinhaPesquisa extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'j17_linhaspesquisa';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['descricao'], 'string'],
            [['sigla'], 'required'],
            [['nome'], 'string', 'max' => 60],
            [['sigla'], 'string', 'max' => 20],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'nome' => 'Nome',
            'descricao' => 'Descricao',
            'sigla' => 'Sigla',
        ];
    }

    public function getLinhaPesquisaNome($id){
        return LinhaPesquisa::find("nome")->select("")->where("id = '".$model->idLinhaPesquisa."'")->one();
    }

}
