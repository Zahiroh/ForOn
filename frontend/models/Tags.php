<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "tags".
 *
 * @property int $id
 * @property int $idPosting
 * @property int $idCategory
 *
 * @property Category $category
 * @property Posting $posting
 */
class Tags extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tags';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'idPosting', 'idCategory'], 'required'],
            [['id', 'idPosting', 'idCategory'], 'integer'],
            [['idCategory'], 'exist', 'skipOnError' => true, 'targetClass' => Category::className(), 'targetAttribute' => ['idCategory' => 'id']],
            [['idPosting'], 'exist', 'skipOnError' => true, 'targetClass' => Posting::className(), 'targetAttribute' => ['idPosting' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'idPosting' => 'Id Posting',
            'idCategory' => 'Id Category',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCategory()
    {
        return $this->hasOne(Category::className(), ['id' => 'idCategory']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPosting()
    {
        return $this->hasOne(Posting::className(), ['id' => 'idPosting']);
    }
}
