<?php

/**
 * This is the model class for table "user".
 *
 * The followings are the available columns in table 'user':
 * @property integer $id
 * @property string $username
 * @property string $password
 */
class User extends CActiveRecord
{
	private $_identity;
	/**
	 * Returns the static model of the specified AR class.
	 * @return User the static model class
	 */
	public static function model($className = __CLASS__)
	{
		return parent::model($className);
	}

	public function validatePassword($password)
	{
		if ($password === $this->password)
			return 1;
	}

	public function hashPassword($password)
	{
		return CPasswordHelper::hashPassword($password);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'user';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('username, password', 'length', 'max' => 255),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, username, password', 'safe', 'on' => 'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array();
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'username' => 'Логин',
			'password' => 'Пароль',
		);
	}

	// public function authenticate($attribute, $params)
	// {
	// 	if (!$this->hasErrors()) {
	// 		$this->_identity = new UserIdentity($this->username, $this->password);
	// 		if (!$this->_identity->authenticate())
	// 			$this->addError('password', 'Такой логин уже есть');
	// 	}
	// }

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria = new CDbCriteria;

		$criteria->compare('id', $this->id);
		$criteria->compare('username', $this->username, true);
		$criteria->compare('password', $this->password, true);

		return new CActiveDataProvider(get_class($this), array(
			'criteria' => $criteria,
		));
	}

	public function login()
	{
		if ($this->_identity === null) {
			$this->_identity = new UserIdentityNew($this->username, $this->password);
			$this->_identity->authenticate();
		}
		Yii::app()->user->login($this->_identity);
		return true;
	}
}
