<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "roleuser".
 *
 * @property int $id
 * @property string $roleName
 *
 * @property User[] $users
 */
class Roleuser extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'roleuser';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['roleName'], 'required'],
            [['roleName'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'roleName' => 'Role Name',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUsers()
    {
        return $this->hasMany(User::className(), ['rolesId' => 'id']);
    }
}
