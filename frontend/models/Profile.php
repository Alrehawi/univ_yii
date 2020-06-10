<?php

namespace frontend\models;
use yii\db\ActiveRecord;
use Yii;
use common\models\User;
use yii\helpers\Url;
use yii\helpers\Html;
use yii\helper\ArrayHelper;
use yii\db\Expression;
/**yii
 * This is the model class for table "profile".
 *
 * @property int $id
 * @property int $user_id
 * @property string $first_name
 * @property string $last_name
 * @property string $birthdate
 * @property int $gender_id
 * @property string $created_at
 * @property string $updated_at
 */
class Profile extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'profile';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'first_name', 'last_name', 'birthdate', 'gender_id', 'created_at', 'updated_at'], 'required'],
            [['user_id', 'gender_id'], 'integer'],
            [['first_name', 'last_name'], 'string'],
            [['birthdate', 'created_at', 'updated_at'], 'safe'],
            [['birthdate'] ,'date','formate'=>'Y-m-d'],
            [['gender_id'],'in', 'range'=>array_keys($this->getGenderList())],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'User ID',
            'first_name' => 'First Name',
            'last_name' => 'Last Name',
            'birthdate' => 'Birthdate',
            'gender_id' => 'Gender ID',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'genderName' =>Yii::t('app','Gender'),
            'userLink' => Yii::t('app','User'),
            'profileIdLink' => Yii::t('app','Profile'),

        ];
    }

    /**
* behaviors to control time stamp, don't forget to use statement for expression
*
*/

public function behaviors(){

    return [

    'timestamp' = > [

    'class' = > 'yii\behaviors\TimestampBehavior',
    'attribute' =>   [
        ActiveRecord::EVENT_BEFORE_INSERT => ['created_at','updated_at'],
        ActiveRecord::EVENT_BEFORE_UPDATE => ['update_at'],
                    ],
        'value'=> new Expression('NOW()') ,
                     

                  ],

           ];

}

  /**
* @return \yii\db\ActiveQuery
*/
    public function getGender(){


        return $this->hasOne(Gender::className(),['id'=>'gender_id']);
    } 


/**
* uses magic getGender on return statement
*
*/
    public function getGenderName(){


        return $this->gender->gender_name;
    }   

/**
* get list of genders for dropdown
*/  
    public function getGenderList(){

        $droptions = Gender::find()->asArray()->all();
        return ArrayHelpe::map($droptions ,'id','gender_name');


    }  

/**
* @return \yii\db\ActiveQuery
*/
    public function getUser(){

        return $this->hasOne(User::className(),['id'=>'user_id']);
    }        
/**
* @get Username
*/

    public function getUsername()    {

        return $this->user->username;
    }

/**
* @getUserId
*/
    public function getUserId(){


        return $this->user ? $this->user->id: 'none' ;

    }   
/**
*getUserLink
*/
    public function getUserLink(){


        $url = Url::to(['user/view','id'=>$this->UserId]);
        $options =[];
        return Html::a($this->getUserName() ,$url,$options);
    } 
/**
* getProfileLink
*/
    public function getProfileIdLink(){


        $url = Url::to(['profile/update','id'=>$this->id]);
        $options = [];
        return Html::a($this->id ,$url,$options);
    }        
}
