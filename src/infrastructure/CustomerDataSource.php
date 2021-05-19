<?php
require_once(__DIR__ . '/../model/customerModel.php');

class CustomerDataSource implements CustomerRepository
{
    private $db_info;

    //DB接続用メソッド
    public function connect_pdo()
    {
        $this->db_info = array(
            'database' => 'contact_db',
            'host'     => 'db',
            'username' => 'root',
            'password' => 'secret',
            'charset' => 'utf8'
        );

        $dsn      = 'mysql:dbname=' . $this->db_info['database'] . ';host=' . $this->db_info['host'] . ';charset=' . $this->db_info['charset'];
        $user     = $this->db_info['username'];
        $password = $this->db_info['password'];
        $option   = array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, PDO::ATTR_EMULATE_PREPARES => false);
        $pdo = new PDO($dsn, $user, $password, $option);

        try {
            $pdo = new PDO($dsn, $user, $password, $option);
        } catch (Exception $e) {
            echo 'db_connect_error' . $e->getMesseage;
            exit();
        }

        return $pdo;
    }

    public function addCustomer($post_data)
    {
        $sql =  <<< EOF
INSERT INTO
    customer (
        full_name,
        kana,
        sex,
        age,
        blood_type,
        job,
        zip_code_1,
        zip_code_2,
        prefecture,
        city,
        address_other,
        phone_number,
        mail,
        interest_category,
        contact_content,
        first_register,
        created,
        latest_register,
        modified,
        delete_flg
        )
VALUES (
    :full_name,
    :kana,
    :sex,
    :age,
    :blood_type,
    :job,
    :zip_code_1,
    :zip_code_2,
    :prefecture,
    :city,
    :address_other,
    :phone_number,
    :mail,
    :interest_category,
    :contact_content,
    :first_register,
    :created,
    :latest_register,
    :modified,
    :delete_flg
);
EOF;
        //sql実行
        try {
            $pdo  = $this->connect_pdo($this->db_info);
            $stmh = $pdo->prepare($sql);
            $stmh->bindParam(':full_name', $post_data['full_name'], PDO::PARAM_STR);
            $stmh->bindParam(':kana', $post_data['kana'], PDO::PARAM_STR);
            $stmh->bindParam(':sex', $post_data['sex'], PDO::PARAM_INT);
            $stmh->bindParam(':age', $post_data['age'], PDO::PARAM_INT);
            $stmh->bindParam(':blood_type', $post_data['blood_type'], PDO::PARAM_INT);
            $stmh->bindParam(':job', $post_data['job'], PDO::PARAM_INT);
            $stmh->bindParam(':zip_code_1', $post_data['zip_code_1'], PDO::PARAM_STR);
            $stmh->bindParam(':zip_code_2', $post_data['zip_code_2'], PDO::PARAM_STR);
            $stmh->bindParam(':prefecture', $post_data['prefecture'], PDO::PARAM_INT);
            $stmh->bindParam(':city', $post_data['city'], PDO::PARAM_STR);
            $stmh->bindParam(':address_other', $post_data['address_other'], PDO::PARAM_STR);
            $stmh->bindParam(':phone_number', $post_data['phone_number'], PDO::PARAM_STR);
            $stmh->bindParam(':mail', $post_data['mail'], PDO::PARAM_STR);
            $stmh->bindParam(':interest_category', serialize($post_data['interest_category']), PDO::PARAM_STR);
            $stmh->bindParam(':contact_content', $post_data['contact_content'], PDO::PARAM_STR);
            $stmh->bindParam(':first_register', $post_data['first_register'], PDO::PARAM_STR);
            $stmh->bindParam(':created', date('Y-m-d'), PDO::PARAM_STR);
            $stmh->bindParam(':latest_register', $post_data['latest_register'], PDO::PARAM_STR);
            $stmh->bindParam(':modified', date('Y-m-d'), PDO::PARAM_STR);
            $stmh->bindParam(':delete_flg', $post_data['delete_flg'], PDO::PARAM_STR);
            $stmh->execute();
        } catch (PDOException $Exception) {
            die('エラー：' . $Exception->getMessage());
        }
    }

    public function findCustomer($customer_id)
    {
        //処理
    }

    public function modifiedCustomer($customer_id)
    {
        //処理
    }

    public function deleteCustomer($customer_id)
    {
        //処理
    }
}
