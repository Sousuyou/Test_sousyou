
<?php
class Controller_Index extends Controller
{
	//入力フォームで取り扱うフィールドを配列として設定
	//name：名前、email：メールアドレス、msg：本文
	private $fields = array('name','email','msg');
	public function action_index()
	{
		//フォームのsubmitボタンを押されたとき
		if (Input::post('submit'))
		{
			//postされた各データをフラッシュセッションに保存
			foreach ($this->fields as $field)
			{
				Session::set_flash($field, Input::post($field));
			}
		}
		//入力チェックのためのvalidationオブジェクトを呼び出す
		$val = Validation::forge();
		
		//各項目に対して、入力の検証ルールを設定する
		//名前を入力必須にする
		$val->add('name','名前')->add_rule('required');
		//メールアドレスを入力必須、正しいアドレス形式かチェック
		$val->add('email','メールアドレス')->add_rule('required')->add_rule('valid_email');
		//内容を入力必須にする
		$val->add('msg','内容')->add_rule('required');
		//$vai->run()で、入力チェックの実行
		//Security::check_token()で、hiddenでpostされたCSRFトークンをチェック
		if($val->run() and Security::check_token())
		{
			//それぞれのチェックが成功したら、確認画面にリダイレクト
			Response::redirect('conf');
		}
		//ビューに渡すデータの配列を作る
		$data = array();
		//validationオブジェクトを配列に保存
		$data['val'] = $val;
		//$dataをビューに埋め込み、ビューを表示する
		return View::forge('index',$data);
	}
}
