<?php
ini_set('mbstring.internal_encoding', 'UTF-8');
ini_set('display_errors', "On");
session_start();

require_once(__DIR__ . '/../../infrastructure/CustomerDataSource.php');
require_once(__DIR__ . '/../../../app/common_functions.php');
require_once(__DIR__ . '/../../../app/const.php');
require_once(__DIR__ . '/../../../app/validation.php');
require_once(__DIR__ . '/../../../src/application/customerApplication.php');

class CustomerController
{

    private $customer_model;
    private $customer_service;
    private $customer_repository;

    function __construct()
    {
        $this->customer_repository = new CustomerDataSource();

        $this->customer_model = new Customer($_POST);

        $this->customer_service = new CustomerService($this->customer_repository);
    }

    function index()
    {
        $_SESSION['post_data'] = array();
        $_SESSION['error_message'] = array();

        //初期値の設定
        foreach (Construction::DEFAULT_KEY()->valueOf() as $key => $value) {
            $_SESSION['post_data'][$value] = '';
            $_SESSION['error_message'][$value] = '';
        }

        foreach (Construction::CATEGORY()->valueOf() as $key => $value) {
            $_SESSION['post_data']['interest_category_check' . $value] = '';
        }

        foreach (Construction::SEX()->valueOf() as $key => $value) {
            $_SESSION['post_data']['sex_check' . $value] = '';
        }

        foreach (Construction::AGE()->valueOf() as $key => $value) {
            $_SESSION['post_data']['age_check' . $value] = '';
        }

        foreach (Construction::BLOOD_TYPE()->valueOf() as $key => $value) {
            $_SESSION['post_data']['blood_type_check' . $value] = '';
        }

        foreach (Construction::JOB()->valueOf() as $key => $value) {
            $_SESSION['post_data']['job_check' . $value] = '';
        }

        foreach (Construction::PREFECTURE()->valueOf() as $key => $value) {
            $_SESSION['post_data']['prefecture_check' . $value] = '';
        }

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            $_POST['phone_number'] = $_POST['phone_number_1'] . '-' . $_POST['phone_number_2'] . '-' . $_POST['phone_number_3'];
            $_POST['zip_code'] = $_POST['zip_code_1'] . '-' . $_POST['zip_code_2'];
            $_POST['delete_flg'] = 0;

            //本来はログイン情報からセットするが、今回は直打ち
            $_POST['first_register'] = '田中一郎';
            $_POST['latest_register'] = '田中痔郎';

            $_SESSION['post_data'] = $_POST;

            foreach (Construction::CATEGORY()->valueOf() as $key => $value) {
                $_SESSION['post_data']['interest_category_check' . $value] = '';
                $_SESSION['post_data']['interest_category_text'][$value] = '';
                if (isset($_POST['interest_category'])) {
                    foreach ($_POST['interest_category'] as $key2 => $value2) {
                        if ($key == $value2) {
                            $_SESSION['post_data']['interest_category_check' . $value] = 'checked';
                            $_SESSION['post_data']['interest_category_text'][$value] = $value;
                        }
                    }
                }
            }

            foreach (Construction::SEX()->valueOf() as $key => $value) {
                $_SESSION['post_data']['sex_check' . $value] = '';
                if ($key == $_POST['sex']) {
                    $_SESSION['post_data']['sex_check' . $value] = 'checked';
                    $_SESSION['post_data']['sex_text'] = $value;
                }
            }

            foreach (Construction::AGE()->valueOf() as $key => $value) {
                $_SESSION['post_data']['age_check' . $value] = '';
                if ($key == $_POST['age']) {
                    $_SESSION['post_data']['age_check' . $value] = 'selected';
                    $_SESSION['post_data']['age_text'] = $value;
                }
            }

            foreach (Construction::BLOOD_TYPE()->valueOf() as $key => $value) {
                $_SESSION['post_data']['blood_type_check' . $value] = '';
                if ($key == $_POST['blood_type']) {
                    $_SESSION['post_data']['blood_type_check' . $value] = 'checked';
                    $_SESSION['post_data']['blood_type_text'] = $value;
                }
            }

            foreach (Construction::JOB()->valueOf() as $key => $value) {
                $_SESSION['post_data']['job_check' . $value] = '';
                if ($key == $_POST['job']) {
                    $_SESSION['post_data']['job_check' . $value] = 'selected';
                    $_SESSION['post_data']['job_text'] = $value;
                }
            }

            foreach (Construction::PREFECTURE()->valueOf() as $key => $value) {
                $_SESSION['post_data']['prefecture_check' . $value] = '';
                if ($key == $_POST['prefecture']) {
                    $_SESSION['post_data']['prefecture_check' . $value] = 'selected';
                    $_SESSION['post_data']['prefecture_text'] = $value;
                }
            }

            $ret = false;

            //お名前のバリデーション
            $_SESSION['error_message']['full_name'] = '';
            if (!$this->customer_model->name->fullname->validation($_POST['full_name'])) {
                $_SESSION['error_message']['full_name'] = 'お名前は正しく入力してください。';
                $ret = true;
            }

            //フリガナのバリデーション
            $_SESSION['error_message']['kana'] = '';
            if (!$this->customer_model->name->kana->validation($_POST['kana'])) {
                $_SESSION['error_message']['kana'] = 'フリガナは正しく入力してください。';
                $ret = true;
            }

            //性別のバリデーション
            $_SESSION['error_message']['sex'] = '';
            if (!$this->customer_model->sex->validation($_POST['sex'])) {
                $_SESSION['error_message']['sex'] = '性別は正しく入力してください。';
                $ret = true;
            }

            //年齢のバリデーション
            $_SESSION['error_message']['age'] = '';
            if (!$this->customer_model->age->validation($_POST['age'])) {
                $_SESSION['error_message']['age'] = '年齢は正しく入力してください。';
                $ret = true;
            }

            //血液型のバリデーション
            $_SESSION['error_message']['blood_type'] = '';
            if (!$this->customer_model->blood_type->validation($_POST['blood_type'])) {
                $_SESSION['error_message']['blood_type'] = '血液型は正しく入力してください。';
                $ret = true;
            }

            //職業のバリデーション
            $_SESSION['error_message']['job'] = '';
            if (!$this->customer_model->job->validation($_POST['job'])) {
                $_SESSION['error_message']['job'] = '職業は正しく入力してください。';
                $ret = true;
            }

            //郵便番号のバリデーション
            $_SESSION['error_message']['zip_code'] = '';
            if (!$this->customer_model->address->zip_code->validation($_POST['zip_code_1'], $_POST['zip_code_2'])) {
                $_SESSION['error_message']['zip_code'] = '郵便番号は正しく入力してください。';
                $ret = true;
            }

            //都道府県のバリデーション
            $_SESSION['error_message']['prefecture'] = '';
            if (!$this->customer_model->address->prefecture->validation($_POST['prefecture'])) {
                $_SESSION['error_message']['prefecture'] = '都道府県は正しく入力してください。';
                $ret = true;
            }

            //住所のバリデーション
            $_SESSION['error_message']['city'] = '';
            if (!$this->customer_model->address->city->validation($_POST['city'])) {
                $_SESSION['error_message']['city'] = '住所は正しく入力してください。';
                $ret = true;
            }

            //ビル・マンション名のバリデーション
            $_SESSION['error_message']['address_other'] = '';
            if (!$this->customer_model->address->address_other->validation($_POST['address_other'])) {
                $_SESSION['error_message']['address_other'] = 'ビル・マンション名は正しく入力してください。';
                $ret = true;
            }

            //電話番号のバリデーション
            $_SESSION['error_message']['phone_number'] = '';
            if (!$this->customer_model->phone_number->validation($_POST['phone_number_1'], $_POST['phone_number_2'], $_POST['phone_number_3'])) {
                $_SESSION['error_message']['phone_number'] = '電話番号は正しく入力してください。';
                $ret = true;
            }

            //メールアドレスのバリデーション
            $_SESSION['error_message']['mail'] = '';
            if (!$this->customer_model->mail->mail_enter->validation($_POST['mail'])) {
                $_SESSION['error_message']['mail'] = 'メールアドレスは正しく入力してください。';
                $ret = true;
            }

            //メールアドレス(確認用)のバリデーション
            $_SESSION['error_message']['mail_confirm'] = '';
            if (!$this->customer_model->mail->mail_enter->validation($_POST['mail'], $_POST['mail_confirm'])) {
                $_SESSION['error_message']['mail_confirm'] = 'メールアドレス(確認用)は正しく入力してください。';
                $ret = true;
            }

            //興味あるカテゴリーのバリデーション
            $_SESSION['error_message']['interest_category'] = '';
            if (!$this->customer_model->interest_category->validation($_POST['interest_category'])) {
                $_SESSION['error_message']['interest_category'] = '興味あるカテゴリーは正しく入力してください。';
                $ret = true;
            }

            //お問い合わせ内容のバリデーション
            $_SESSION['error_message']['contact_content'] = '';
            if (!$this->customer_model->contact_content->validation($_POST['contact_content'])) {
                $_SESSION['error_message']['contact_content'] = 'お問い合わせ内容は正しく入力してください。';
                $ret = true;
            }

            if ($ret) {
                include(__DIR__ . '/../Template/top_template.php');
                return;
            }

            include(__DIR__ . '/../Template/confirm_template.php');
            unset($_SESSION['error_message']);
            return;
        }

        include(__DIR__ . '/../Template/top_template.php');
    }

    function confirm()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if (isset($_SESSION['post_data'])) {
                $this->customer_service->addCustomer($_SESSION['post_data']);
            }
            include(__DIR__ . '/../Template/confirm_complete.php');
            unset($_SESSION['post_data']);
        }
    }
}
