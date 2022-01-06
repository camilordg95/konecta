<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "producto".
 *
 * @property int $id
 * @property string $nombre
 * @property string $Referencia
 * @property int $precio
 * @property int $peso
 * @property int $stock
 * @property string $fecha_creación
 * @property string $categoria
 *
 * @property Categoria $categoria
 */
class Producto extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'producto';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nombre', 'Referencia', 'precio', 'peso', 'stock', 'fecha_creación','categoria'], 'required'],
            [['precio', 'peso', 'stock'], 'integer'],
            [['fecha_creación'], 'safe'],
            ['precio', 'compare', 'compareValue' => 0, 'operator' => '>'],
            ['stock', 'compare', 'compareValue' => 0, 'operator' => '>='],
            ['peso', 'compare', 'compareValue' => 0, 'operator' => '>'],
            [['nombre'], 'string', 'max' => 60],
            [['Referencia'], 'string', 'max' => 240],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'nombre' => 'Nombre',
            'Referencia' => 'Referencia',
            'precio' => 'Precio',
            'peso' => 'Peso',
            'stock' => 'Stock',
            'fecha_creación' => 'Fecha Creación',
            'categoria' => 'Categoria',
        ];
    }

    /**
     * Gets query for [[Categoria]].
     *
     * @return \yii\db\ActiveQuery
     */
}
