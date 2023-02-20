<?php

class SiteController extends Controller
{
	/**
	 * Declares class-based actions.
	 */
	public function actions()
	{
		return array(
			// captcha action renders the CAPTCHA image displayed on the contact page
			'captcha' => array(
				'class' => 'CCaptchaAction',
				'backColor' => 0xFFFFFF,
			),
			// page action renders "static" pages stored under 'protected/views/site/pages'
			// They can be accessed via: index.php?r=site/page&view=FileName
			'page' => array(
				'class' => 'CViewAction',
			),
		);
	}

	/**
	 * This is the default 'index' action that is invoked
	 * when an action is not explicitly requested by users.
	 */
	public function actionIndex()
	{
		// renders the view file 'protected/views/site/index.php'
		// using the default layout 'protected/views/layouts/main.php'
		$rows = Product::model()->findAll();
		$this->render('index', array('rows' => $rows));
	}

	/**
	 * This is the action to handle external exceptions.
	 */
	public function actionError()
	{
		if ($error = Yii::app()->errorHandler->error) {
			if (Yii::app()->request->isAjaxRequest)
				echo $error['message'];
			else
				$this->render('error', $error);
		}
	}

	/**
	 * Displays the login page
	 */
	public function actionLogin()
	{
		$model = new LoginForm;

		// if it is ajax validation request
		if (isset($_POST['ajax']) && $_POST['ajax'] === 'login-form') {
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}

		// collect user input data
		if (isset($_POST['LoginForm'])) {
			$model->attributes = $_POST['LoginForm'];
			// validate user input and redirect to the previous page if valid
			if ($model->validate() && $model->login())
				$this->redirect(Yii::app()->user->returnUrl);
		}
		// display the login form
		$this->render('login', array('model' => $model));
	}

	/**
	 * Logs out the current user and redirect to homepage.
	 */
	public function actionLogout()
	{
		Yii::app()->user->logout();
		$this->redirect(Yii::app()->homeUrl);
	}

	public function actionRegister()
	{
		$model = new User;

		if (isset($_POST['User'])) {
			$model->attributes = $_POST['User'];

			if ($model->validate() && $model->login()) {
				if ($model->save()) {
					$this->redirect(Yii::app()->user->returnUrl);
				}
			}
		}

		$this->render('register', array('model' => $model));
	}

	public function actionProduct()
	{
		$model = new Product;
		$rows = Product::model()->findAll();

		if (isset($_POST['Product'])) {
			$model->attributes = $_POST['Product'];
			$model->id_user = Yii::app()->user->id;
			$model->username_user = Yii::app()->user->name;
			$model->date_post = date("Y-m-d H:i:s");
			$model->save();

			$this->redirect('product', array('model' => $model, 'rows' => $rows));
		}

		$this->render('product', array('model' => $model, 'rows' => $rows));
	}

	public function actionDeletepost()
	{
		$post = Product::model()->findByPk($_POST['id_post']); // предполагаем, что запись с ID=10 существует
		$post->delete();

		$model = new Product;
		$rows = Product::model()->findAll();

		$this->redirect('product', array('model' => $model, 'rows' => $rows));
	}

	public function actionUpdatepost()
	{
		if (!isset($_POST['id_post'])) {
			if (isset($_POST['Product'])) {
				$model = Product::model()->findByPk($_POST['id_post_update']);

				$model->attributes = $_POST['Product'];
				$model->save();

				$rows = Product::model()->findAll();

				$model = new Product;
				$this->redirect('product', array('model' => $model, 'rows' => $rows));
			}
		} else {
			$modelOne = Product::model()->findByPk($_POST['id_post']);
			$model = new Product;
			$model->name = $modelOne->name;
			$model->content = $modelOne->content;
			$model->id = $_POST['id_post'];

			$this->render('updatepost', array('model' => $model));
		}
	}
}
