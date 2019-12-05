<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "comments".
 *
 * @property int $id
 * @property int $idUser
 * @property int $idPosting
 * @property string $mainComment
 * @property string $commentPosted
 *
 * @property Posting $posting
 */
class Comments extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'comments';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['idUser', 'idPosting', 'mainComment', 'commentPosted'], 'required'],
            [['idUser', 'idPosting'], 'integer'],
            [['mainComment'], 'string'],
            [['commentPosted'], 'safe'],
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
            'idUser' => 'Id User',
            'idPosting' => 'Id Posting',
            'mainComment' => 'Main Comment',
            'commentPosted' => 'Comment Posted',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPosting()
    {
        return $this->hasOne(Posting::className(), ['id' => 'idPosting']);
    }
}
