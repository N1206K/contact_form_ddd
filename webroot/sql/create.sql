--
-- テーブルの構造 `customer`
--

CREATE TABLE
IF NOT EXISTS `customer`
(
  `id` int
(11) NOT NULL COMMENT '顧客id',
  `full_name` varchar
(50) NOT NULL COMMENT 'お名前',
  `kana` varchar
(50) NOT NULL COMMENT 'フリガナ',
  `sex` int
(1) NOT NULL COMMENT '性別',
  `age` int
(1) NOT NULL COMMENT '年齢',
  `blood_type` int
(1) NOT NULL COMMENT '血液型',
  `job` varchar
(255) NOT NULL COMMENT '職業',
  `zip_code_1` varchar
(3) NOT NULL COMMENT '郵便番号(左)',
  `zip_code_2` varchar
(4) NOT NULL COMMENT '郵便番号
(右)',
  `prefecture` int
(2) NOT NULL COMMENT '都道府県',
  `city` varchar
(255) NOT NULL COMMENT '市区町村',
  `address_other` varchar
(255) NOT NULL COMMENT 'ビル・マンション名',
  `phone_number` varchar
(20) NOT NULL COMMENT '電話番号',
  `mail` varchar
(50) NOT NULL COMMENT 'メールアドレス',
  `interest_category` int
(1) NOT NULL COMMENT '興味あるカテゴリー',
  `contact_content` text NOT NULL COMMENT '備考',
  `first_register` varchar
(50) NOT NULL COMMENT '初回登録者',
  `created` datetime NOT NULL COMMENT '初回登録日時',
  `latest_register` varchar
(50) NOT NULL COMMENT '最終更新者',
  `modified` datetime NOT NULL COMMENT '最終更新日時',
  `delete_flg` int
(1) NOT NULL DEFAULT '0' COMMENT '削除フラグ'
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;