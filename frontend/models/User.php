<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "user".
 *
 * @property int $id
 * @property string $username
 * @property string $fullname
 * @property string $auth_key
 * @property string $password_hash
 * @property string $password_reset_token
 * @property string $email
 * @property int $status
 * @property int $created_at
 * @property int $updated_at
 * @property string $verification_token
 * @property int $rolesId
 * @property string $fotoUser
 * @property string $deskripsi
 *
 * @property Comments[] $comments
 * @property Posting[] $postings
 * @property Setlike[] $setlikes
 * @property Roleuser $roles
 */
class User extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'user';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['username', 'fullname', 'auth_key', 'password_hash', 'email', 'created_at', 'updated_at', 'fotoUser', 'deskripsi'], 'required'],
            [['status', 'created_at', 'updated_at', 'rolesId'], 'integer'],
            [['deskripsi'], 'string'],
            [['username', 'fullname', 'password_hash', 'password_reset_token', 'email', 'verification_token'], 'string', 'max' => 255],
            [['auth_key'], 'string', 'max' => 32],
            [['fotoUser'], 'string', 'max' => 100],
            [['username'], 'unique'],
            [['email'], 'unique'],
            [['password_reset_token'], 'unique'],
            [['rolesId'], 'exist', 'skipOnError' => true, 'targetClass' => Roleuser::className(), 'targetAttribute' => ['rolesId' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'username' => 'Username',
            'fullname' => 'Fullname',
            'auth_key' => 'Auth Key',
            'password_hash' => 'Password Hash',
            'password_reset_token' => 'Password Reset Token',
            'email' => 'Email',
            'status' => 'Status',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'verification_token' => 'Verification Token',
            'rolesId' => 'Roles ID',
            'fotoUser' => 'Foto User',
            'deskripsi' => 'Deskripsi',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getComments()
    {
        return $this->hasMany(Comments::className(), ['idUser' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPostings()
    {
        return $this->hasMany(Posting::className(), ['idUser' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSetlikes()
    {
        return $this->hasMany(Setlike::className(), ['IdUser' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRoles()
    {
        return $this->hasOne(Roleuser::className(), ['id' => 'rolesId']);
    }
}
