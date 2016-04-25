<?php

class Controller_Contact extends Controller_Template
{

//お問い合わせのフィールドをプロパティに設定
private $fields = array('name','email','tel','body');

public function action_index()
{

//フォームからのPOSTデータがある場合
	if (Input::post('submit')) {
//各フィードのPOSTデータをフラッシュセッションに保存する
	foreach ($this->fields as $field) {
		Session::set_flash($field, Input::post($field));
	}

//VALIDATIONオブジェクト
	//$val = Validation::forge();
//検証規則の設定
	
	$val->add('name','お名前')
		->add_rule('required');
	$val->add('tel','お電話番号')
		->add_rule('valid_string',array('numeric','dashes'));
	$val->add('email','Emailアドレス')
		->add_rule('required')			
		->add_rule('valid_email');
	$val->add('body','お問い合わせ内容')
		->add_rule('required');
	
//検証成功、csrfトークンのチェックに成功した場合、確認画面にリダイレクト

	if ($val->run() and Security::check_token()) {
		Response::redirect('contact/confirm');
	}

//ビューに渡す配列の初期化
	$data = array();
//VALIDATIONオブジェクトをビューに渡す配列に設定
	

$data["val"] = $val;
var_dump($data);
	$this->template->title = 'お問い合わせ';
	$this->template->content = View::forge('contact/index', $data);
	

	}
}
}

