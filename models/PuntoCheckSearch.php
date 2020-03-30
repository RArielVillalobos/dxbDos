<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\PuntoCheck;

/**
 * PuntoCheckSearch represents the model behind the search form of `app\models\PuntoCheck`.
 */
class PuntoCheckSearch extends PuntoCheck
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['idPunto', 'idCarrera', 'km', 'idTipoPunto'], 'integer'],
            [['nombre'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = PuntoCheck::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'idPunto' => $this->idPunto,
            'idCarrera' => $this->idCarrera,
            'km' => $this->km,
            'idTipoPunto' => $this->idTipoPunto,
        ]);

        $query->andFilterWhere(['like', 'nombre', $this->nombre]);

        return $dataProvider;
    }
}
