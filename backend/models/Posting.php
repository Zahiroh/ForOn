<?php

namespace backend\models;
//created by Ajie Dibyo R.
use Yii;

/**
 * This is the model class for table "posting".
 *
 * @property int $id
 * @property int $idCategory
 * @property int $idUser
 * @property string $title
 * @property string $mainPost
 * @property int $ratingPosting
 * @property int $likePosting
 * @property int $dislikePosting
 * @property string $datePosted
 * @property string $filePosting
 *
 * @property Comments[] $comments
 * @property Category $category
 * @property User $user
 */
class Posting extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'posting';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['idCategory', 'idUser', 'title', 'mainPost', 'ratingPosting', 'likePosting', 'dislikePosting', 'datePosted', 'filePosting'], 'required'],
            [['idCategory', 'idUser', 'ratingPosting', 'likePosting', 'dislikePosting'], 'integer'],
            [['mainPost'], 'string'],
            [['datePosted'], 'safe'],
            [['title', 'filePosting'], 'string', 'max' => 255],
            [['idCategory'], 'exist', 'skipOnError' => true, 'targetClass' => Category::className(), 'targetAttribute' => ['idCategory' => 'id']],
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
            'idCategory' => 'Id Category',
            'idUser' => 'Id User',
            'title' => 'Title',
            'mainPost' => 'Main Post',
            'ratingPosting' => 'Rating Posting',
            'likePosting' => 'Like Posting',
            'dislikePosting' => 'Dislike Posting',
            'datePosted' => 'Date Posted',
            'filePosting' => 'File Posting',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getComments()
    {
        return $this->hasMany(Comments::className(), ['idPosting' => 'id']);
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
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'idUser']);
    }
}
