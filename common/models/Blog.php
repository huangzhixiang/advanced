<?php

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use \common\models\AdminUser;
use backend\components\Upload;
/**
 * This is the model class for table "blog".
 *
 * @property string $id
 * @property string $title
 * @property string $content
 * @property integer $status
 * @property string $author_id
 * @property string $create_at
 * @property string $update_at
 *
 * @property AdminUser $author
 * @property Comment[] $comments
 */
class Blog extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'blog';
    }

    public function behaviors(){
        return [
            TimestampBehavior::className()
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['content', 'author_id', 'created_at'], 'required'],
            [['content'], 'string'],
            [['status', 'author_id'], 'integer'],
            [['created_at', 'updated_at','abc'], 'safe'],
            [['title'], 'string', 'max' => 100],
            [['author_id'], 'exist', 'skipOnError' => true, 'targetClass' => AdminUser::className(), 'targetAttribute' => ['author_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => '标题',
            'content' => '内容',
            'status' => '状态',
            'author_id' => '作者',
            'created_at' => 'Create At',
            'updated_at' => '更新时间',
            'cover' => '图片上传',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAuthor()
    {
        return $this->hasOne(AdminUser::className(), ['id' => 'author_id']);
    }
    
    public function getAuthorName(){
        $a = AdminUser::find()->all();
        $info = ArrayHelper::map($a,'id','username');
        return $info;
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getComments()
    {
        return $this->hasMany(Comment::className(), ['blog_id' => 'id']);
    }
    
    public function getStatuses(){
        return [
            '0' => '草稿',
            '1' => '发布',
            '2' => '归档',
        ];
    }
}
