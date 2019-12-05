<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "setlike".
 *
 * @property int $id
 * @property int $idPosting
 * @property int $idUser
 * @property int $love
 * @property int $dislike
 * @property int $rating
 *
 * @property Posting $posting
 * @property User $user
 */
class Setlike extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'setlike';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['idPosting', 'idUser', 'love', 'dislike', 'rating'], 'required'],
            [['id','idPosting', 'idUser', 'love', 'dislike', 'rating'], 'integer'],
            [['idPosting'], 'exist', 'skipOnError' => true, 'targetClass' => Posting::className(), 'targetAttribute' => ['idPosting' => 'id']],
            [['idUser'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['idUser' => 'id']],
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
            'idUser' => 'Id User',
            'love' => 'Love',
            'dislike' => 'Dislike',
            'rating' => 'Rating',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPosting()
    {
        return $this->hasOne(Posting::className(), ['id' => 'idPosting']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'IdUser']);
    }
}
