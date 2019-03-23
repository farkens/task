<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "popup".
 *
 * @property int $id
 * @property string $name
 * @property string $text
 * @property string $is_active
 * @property int $count_show
 */
class Popup extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'popup';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['text', 'is_active'], 'string'],
            [['count_show'], 'integer'],
            [['name'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'text' => 'Text',
            'is_active' => 'Is Active',
            'count_show' => 'Count Show',
        ];
    }
}
