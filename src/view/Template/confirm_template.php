<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <title>練習</title>
</head>

<body>
    <link rel="stylesheet" href="../webroot/css/style.css" type="text/css" media="screen">
    <link rel="stylesheet" href="../webroot/css/bootstrap.min.css" type="text/css" media="screen">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Kosugi+Maru" type="text/css" media="screen">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="../webroot/js/bootstrap.min.js"></script>

    <header class="confirm_header">
        <h1 class="text-center">お問い合わせ内容の確認</h1>
    </header>
    <main class="wrap confirm container">
        <form action="/confirm" method="POST">
            <section class="contact_sheet">
                <p class="text-center">以下の内容でよろしければ「送信する」ボタンを押してください。</p>
                <p class="text-center">修正する場合は「戻る」ボタンを押して入力画面へお戻りください。</p>
            </section>
            <section class="contact_sheet">
                <h2 class="text-center">お問い合わせ内容</h2>
                <table>
                    <tr class="name_area">
                        <th>お名前</th>
                        <td><?= h($_SESSION['post_data']['full_name']); ?></td>
                    </tr>
                    <tr class="kana_area">
                        <th>フリガナ</th>
                        <td><?= h($_SESSION['post_data']['kana']); ?></td>
                    </tr>
                    <tr class="sex_area">
                        <th>性別</th>
                        <td><?= h($_SESSION['post_data']['sex_text']); ?></td>
                    </tr>
                    <tr class="age_area">
                        <th>年齢</th>
                        <td><?= h($_SESSION['post_data']['age_text']); ?></td>
                    </tr>
                    <tr class="blood_type_area">
                        <th>血液型</th>
                        <td><?= h($_SESSION['post_data']['blood_type_text']); ?></td>
                    </tr>
                    <tr class="job_area">
                        <th>職業</th>
                        <td><?= h($_SESSION['post_data']['job_text']); ?></td>
                    </tr>
                    <tr class="post_code_area">
                        <th>郵便番号</th>
                        <td><?= h($_SESSION['post_data']['zip_code']); ?></td>
                    </tr>
                    <tr class="address_area">
                        <th>住所</th>
                        <td><?= h($_SESSION['post_data']['prefecture_text'] . $_SESSION['post_data']['city']); ?></td>
                    </tr>
                    <tr class="address_other_area">
                        <th>ビル・マンション名</th>
                        <td><?= h($_SESSION['post_data']['address_other']); ?></td>
                    </tr>
                    <tr class="phone_number_area">
                        <th>電話番号</th>
                        <td><?= h($_SESSION['post_data']['phone_number']); ?></td>
                    </tr>
                    <tr class="mail_area">
                        <th>メールアドレス</th>
                        <td><?= h($_SESSION['post_data']['mail']); ?></td>
                    </tr>
                    <tr class="interest_category_area">
                        <th>興味あるカテゴリー</th>
                        <td>
                            <?php
                            //興味あるカテゴリーを表示用に設定
                            foreach ($_SESSION['post_data']['interest_category_text'] as $value) {
                                echo $value . ' ';
                            }
                            ?>
                        </td>
                    </tr>
                    <tr class="contact_content_area">
                        <th>お問い合わせ</th>
                        <td><?= nl2br(h($_SESSION['post_data']['contact_content'])); ?></td>
                    </tr>
                </table>
            </section>
            <section class="submit_btn_area text-center">
                <button type="button" onclick="location.href='/'" class="form-control btn btn-danger">戻る</button>
                <button type="submit" name="submit_confirm" class="form-control btn btn-primary">登録する</button>
            </section>
        </form>
    </main>
</body>

</html>