<?php

namespace common\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "comment".
 *
 * @property string $id
 * @property string $content
 * @property string $blog_id
 * @property integer $status
 * @property integer $user_id
 * @property string $create_at
 * @property integer $remind_flag
 *
 * @property Blog $blog
 * @property TUser $user
 */
class Comment extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public $username;
    public static function tableName()
    {
        return 'comment';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['content', 'blog_id', 'user_id', 'create_at'], 'required'],
            [['content'], 'string'],
            [['blog_id', 'status', 'user_id', 'remind_flag'], 'integer'],
            [['create_at','username'], 'safe'],
            [['blog_id'], 'exist', 'skipOnError' => true, 'targetClass' => Blog::className(), 'targetAttribute' => ['blog_id' => 'id']],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'content' => '内容',
            'blog_id' => '文章标题',
            'status' => '状态',
            'user_id' => '评论用户',
            'create_at' => 'Create At',
            'remind_flag' => 'Remind Flag',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBlog()
    {
        return $this->hasOne(Blog::className(), ['id' => 'blog_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

    public function getCommentStatus(){
//        $type = DictType::findOne(['code'=>'comment_status']);
        $info = yii::$app->db
            ->createCommand('select id,display_name from dict_item where type_id=2')
            ->queryAll();
        $info = ArrayHelper::map($info,'id','display_name');
        return $info;
    }


}
