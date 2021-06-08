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

    <header>
        <h1 class="text-center">お問い合わせ</h1>
    </header>
    <main class="wrap index">
        <div class="container">
            <form action="/" method="POST">
                <section class="contact_sheet">
                    <table>
                        <!-- お名前 -->
                        <tr class="name_area">
                            <th>お名前<span class="required">*</span></th>
                            <td>
                                <input name="full_name" type="text" class="form-control" value="<?= h($_SESSION['post_data']['full_name']); ?>">
                                <!-- エラーメッセージ -->
                                <span class="alert"><?= $_SESSION['error_message']['full_name']; ?></span>
                            </td>
                        </tr>
                        <!-- フリガナ -->
                        <tr class="kana_area">
                            <th>フリガナ<span class="required">*</span></th>
                            <td>
                                <input name="kana" type="text" class="form-control" value="<?= h($_SESSION['post_data']['kana']); ?>">
                                <!-- エラーメッセージ -->
                                <span class="alert"><?= $_SESSION['error_message']['kana']; ?></span>
                            </td>
                        </tr>
                        <!-- 性別 -->
                        <tr class="sex_area">
                            <th>性別<span class="required">*</span></th>
                            <td>
                                <div>
                                    <?php
                                    foreach (Construction::SEX()->valueOf() as $key => $value) :
                                    ?>
                                        <input name="sex" type="radio" value="<?= $key; ?>" <?= $_SESSION['post_data']['sex_check' . $value]; ?>><?= $value; ?>
                                    <?php endforeach; ?>
                                </div>
                                <!-- エラーメッセージ -->
                                <span class="alert"><?= $_SESSION['error_message']['sex']; ?></span>
                            </td>
                        </tr>
                        <!-- 年齢 -->
                        <tr class="age_area">
                            <th>年齢<span class="required">*</span></th>
                            <td>
                                <select name="age" class="age form-control">
                                    <?php
                                    foreach (Construction::AGE()->valueOf() as $key => $value) :
                                    ?>
                                        <option value="<?= $key; ?>" <?= $_SESSION['post_data']['age_check' . $value]; ?>><?= $value; ?></option>
                                    <?php endforeach; ?>
                                </select>
                                <!-- エラーメッセージ -->
                                <span class="alert"><?= $_SESSION['error_message']['age']; ?></span>
                            </td>
                        </tr>
                        <!-- 血液型 -->
                        <tr class="blood_type_area">
                            <th>血液型<span class="required">*</span></th>
                            <td>
                                <div>
                                    <?php
                                    foreach (Construction::BLOOD_TYPE()->valueOf() as $key => $value) :
                                    ?>
                                        <input name="blood_type" type="radio" value="<?= $key; ?>" <?= $_SESSION['post_data']['blood_type_check' . $value]; ?>><?= $value; ?>
                                    <?php endforeach; ?>
                                </div>
                                <!-- エラーメッセージ -->
                                <span class="alert"><?= $_SESSION['error_message']['blood_type']; ?></span>
                            </td>
                        </tr>
                        <!-- 職業 -->
                        <tr class="job_area">
                            <th>職業<span class="required">*</span></th>
                            <td>
                                <select name="job" class="job form-control">
                                    <?php
                                    foreach (Construction::JOB()->valueOf() as $key => $value) :
                                    ?>
                                        <option value="<?= $key; ?>" <?= $_SESSION['post_data']['job_check' . $value]; ?>><?= $value; ?></option>
                                    <?php endforeach; ?>
                                </select>
                                <!-- エラーメッセージ -->
                                <span class="alert"><?= $_SESSION['error_message']['job']; ?></span>
                            </td>
                        </tr>
                    </table>
                    <table>
                        <!-- 郵便番号 -->
                        <tr class="zip_code_area">
                            <th>郵便番号<span class="required">*</span></th>
                            <td>
                                <div>
                                    <input name="zip_code_1" type="text" class="zip_code_1 form-control" value="<?= h($_SESSION['post_data']['zip_code_1']); ?>">
                                    <p>-</p>
                                    <input name="zip_code_2" type="text" class="zip_code_2 form-control" value="<?= h($_SESSION['post_data']['zip_code_2']); ?>">
                                </div>
                                <!-- エラーメッセージ -->
                                <span class="alert"><?= $_SESSION['error_message']['zip_code']; ?></span>
                            </td>
                        </tr>
                        <!-- 都道府県 -->
                        <tr class="prefecture_area">
                            <th>都道府県<span class="required">*</span></th>
                            <td>
                                <select name="prefecture" class="prefecture form-control">
                                    <?php
                                    foreach (Construction::PREFECTURE()->valueOf() as $key => $value) :
                                    ?>
                                        <option value="<?= $key; ?>" <?= $_SESSION['post_data']['prefecture_check' . $value]; ?>><?= $value; ?></option>
                                    <?php endforeach; ?>
                                </select>
                                <!-- エラーメッセージ -->
                                <span class="alert"><?= $_SESSION['error_message']['prefecture']; ?></span>
                            </td>
                        </tr>
                        <!-- 住所 -->
                        <tr class="address_area">
                            <th>住所<span class="required">*</span></th>
                            <td>
                                <input name="city" type="text" class="form-control" value="<?= h($_SESSION['post_data']['city']); ?>">
                                <!-- エラーメッセージ -->
                                <span class="alert"><?= $_SESSION['error_message']['city']; ?></span>
                            </td>
                        </tr>
                        <!-- ビル・マンション名 -->
                        <tr class="address_other_area">
                            <th>ビル・マンション名</th>
                            <td>
                                <input name="address_other" type="text" class="form-control" value="<?= h($_SESSION['post_data']['address_other']); ?>">
                                <!-- エラーメッセージ -->
                                <span class="alert"><?= $_SESSION['error_message']['address_other']; ?></span>
                            </td>
                        </tr>
                        <!-- 電話番号 -->
                        <tr class="phone_number_area">
                            <th>電話番号<span class="required">*</span></th>
                            <td>
                                <div>
                                    <input name="phone_number_1" type="text" class="phone_number_1 form-control" value="<?= h($_SESSION['post_data']['phone_number_1']); ?>">
                                    <p>-</p>
                                    <input name="phone_number_2" type="text" class="phone_number_2 form-control" value="<?= h($_SESSION['post_data']['phone_number_2']); ?>">
                                    <p>-</p>
                                    <input name="phone_number_3" type="text" class="phone_number_3 form-control" value="<?= h($_SESSION['post_data']['phone_number_3']); ?>">
                                </div>
                                <!-- エラーメッセージ -->
                                <span class="alert"><?= $_SESSION['error_message']['phone_number']; ?></span>
                            </td>
                        </tr>
                        <!-- メールアドレス -->
                        <tr class="mail_area">
                            <th>メールアドレス<span class="required">*</span></th>
                            <td>
                                <input name="mail" type="text" class="form-control" value="<?= h($_SESSION['post_data']['mail']); ?>">
                                <!-- エラーメッセージ -->
                                <span class="alert"><?= $_SESSION['error_message']['mail']; ?></span>
                            </td>
                        </tr>
                        <!-- メールアドレス(確認用) -->
                        <tr class="mail_confirm_area">
                            <th>メールアドレス<br>(確認用)<span class="required">*</span></th>
                            <td>
                                <input name="mail_confirm" type="text" class="form-control" value="<?= h($_SESSION['post_data']['mail_confirm']); ?>">
                                <!-- エラーメッセージ -->
                                <span class="alert"><?= $_SESSION['error_message']['mail_confirm']; ?></span>
                            </td>
                        </tr>
                        <!-- 興味あるカテゴリー -->
                        <tr class="interest_category_area">
                            <th>興味あるカテゴリー<br>(複数選択可)</th>
                            <td>
                                <div>
                                    <?php
                                    foreach (Construction::CATEGORY()->valueOf() as $key => $value) :
                                    ?>
                                        <input type="checkbox" name="interest_category[]" value="<?= $key; ?>" <?= $_SESSION['post_data']['interest_category_check' . $value]; ?>><?= $value; ?>
                                    <?php endforeach; ?>
                                </div>
                                <!-- エラーメッセージ -->
                                <span class="alert"><?= $_SESSION['error_message']['interest_category']; ?></span>
                            </td>
                        </tr>
                    </table>
                </section>
                <section class="contact_sheet_content">
                    <table>
                        <!-- お問い合わせ -->
                        <tr class="contact_content_area">
                            <th>お問い合わせ内容<span class="required">*</span></th>
                            <td>
                                <textarea name="contact_content" class="form-control" cols="50" rows="10"><?= h($_SESSION['post_data']['contact_content']); ?></textarea>
                                <!-- エラーメッセージ -->
                                <span class="alert"><?= $_SESSION['error_message']['contact_content']; ?></span>
                            </td>
                        </tr>
                    </table>
                </section>
                <section class="submit_btn_area text-center">
                    <button type="submit" class="submit_btn form-control btn btn-primary">入力内容を確認する</button>
                </section>
            </form>
        </div>
    </main>
</body>

</html>