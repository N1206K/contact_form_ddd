<?php
require_once(__DIR__ . '/../../app/const.php');
require_once(__DIR__ . '/../../app/validation.php');

class FullName
{
    private $full_name;

    public function FullName($post_full_name)
    {
        $this->full_name = $post_full_name;
    }

    public function validation()
    {
        $validation = new Validation();

        if ($validation->isEmpty($this->full_name) || $validation->checkStringsMaxNum($this->full_name, 255)) {
            return false;
        }
        return true;
    }

    public function ModifiedFullName($newName)
    {
        return new FullName($newName);
    }
}

class Kana
{
    private $kana;

    public function Kana($post_kana)
    {
        $this->kana = $post_kana;
    }

    public function validation()
    {
        $validation = new Validation();
        if (
            $validation->isEmpty($this->kana) ||
            $validation->checkHalfAndFullSizeStrings($this->kana) ||
            $validation->checkStringsMaxNum($this->kana, 255)
        ) {
            return false;
        }
        return true;
    }

    public function ModifiedKana($newKana)
    {
        return new Kana($newKana);
    }
}

class Sex
{
    private $sex;

    public function Sex($post_sex)
    {
        $this->sex = $post_sex;
    }

    public function validation()
    {
        $validation = new Validation();
        if ($validation->isEmpty($this->sex) || $validation->checkDataFromOutside($this->sex, Construction::SEX()->valueOf())) {
            return false;
        }
        return true;
    }

    public function ModifiedSex($newSex)
    {
        return new Sex($newSex);
    }
}

class Age
{
    private $age;

    public function Age($post_age)
    {
        $this->age = $post_age;
    }

    public function validation()
    {
        $validation = new Validation();
        if ($validation->isEmpty($this->age) || $validation->checkDataFromOutside($this->age, Construction::AGE()->valueOf())) {
            return false;
        }
        return true;
    }

    public function ModifiedAge($newAge)
    {
        return new Age($newAge);
    }
}

class BloodType
{
    private $blood_type;

    public function bloodType($post_blood_type)
    {
        $this->blood_type = $post_blood_type;
    }

    public function validation()
    {
        $validation = new Validation();
        if ($validation->isEmpty($this->blood_type) || $validation->checkDataFromOutside($this->blood_type, Construction::BLOOD_TYPE()->valueOf())) {
            return false;
        }
        return true;
    }

    public function ModifiedBloodType($newBloodType)
    {
        return new bloodType($newBloodType);
    }
}

class Job
{
    private $job;

    public function Job($post_job)
    {
        $this->job = $post_job;
    }

    public function validation()
    {
        $validation = new Validation();
        if ($validation->isEmpty($this->job) || $validation->checkDataFromOutside($this->job, Construction::JOB()->valueOf())) {
            return false;
        }
        return true;
    }

    public function ModifiedJob($newJob)
    {
        return new Job($newJob);
    }
}

class ZipCode
{
    private $zip_code1;
    private $zip_code2;

    public function ZipCode1($post_zip_code1)
    {
        $this->zip_code1 = $post_zip_code1;
    }

    public function ZipCode2($post_zip_code2)
    {
        $this->zip_code2 = $post_zip_code2;
    }

    public function validation()
    {
        $validation = new Validation();

        //半角に変換
        $this->zip_code1 = mb_convert_kana($this->zip_code1, "n", 'UTF-8');
        $this->zip_code2 = mb_convert_kana($this->zip_code2, "n", 'UTF-8');

        if (
            $validation->isEmpty($this->zip_code1) ||
            $validation->isEmpty($this->zip_code2) ||
            $validation->checkFormat($this->zip_code1, '/^[0-9]{3}$/') ||
            $validation->checkFormat($this->zip_code2, '/^[0-9]{4}$/')
        ) {
            return false;
        }
        return true;
    }

    public function ModifiedZipCode1($newZipCode1)
    {
        return new ZipCode($newZipCode1);
    }

    public function ModifiedZipCode2($newZipCode2)
    {
        return new ZipCode($newZipCode2);
    }
}

class Prefecture
{
    private $prefecture;

    public function Prefecture($post_prefecture)
    {
        $this->prefecture = $post_prefecture;
    }

    public function validation()
    {
        $validation = new Validation();
        if ($validation->isEmpty($this->prefecture) || $validation->checkDataFromOutside($this->prefecture, Construction::PREFECTURE()->valueOf())) {
            return false;
        }
        return true;
    }

    public function ModifiedPrefecture($newPrefecture)
    {
        return new Prefecture($newPrefecture);
    }
}

class City
{
    private $city;

    public function City($post_city)
    {
        $this->city = $post_city;
    }

    public function validation()
    {
        $validation = new Validation();
        if ($validation->isEmpty($this->city) || $validation->checkStringsMaxNum($this->city, 255)) {
            return false;
        }
        return true;
    }

    public function ModifiedCity($newCity)
    {
        return new City($newCity);
    }
}

class AddressOther
{
    private $address_other;

    public function AddressOther($post_address_other)
    {
        $this->address_other = $post_address_other;
    }

    public function validation()
    {
        $validation = new Validation();
        if ($validation->checkStringsMaxNum($this->address_other, 255)) {
            return false;
        }
        return true;
    }

    public function ModifiedAddressOther($newAddressOther)
    {
        return new AddressOther($newAddressOther);
    }
}

class PhoneNumber
{
    private $phone_number_1;
    private $phone_number_2;
    private $phone_number_3;
    public $phone_number;

    public function PhoneNumber1($post_phone_number_1)
    {
        $this->phone_number_1 = $post_phone_number_1;
    }

    public function PhoneNumber2($post_phone_number_2)
    {
        $this->phone_number_2 = $post_phone_number_2;
    }

    public function PhoneNumber3($post_phone_number_3)
    {
        $this->phone_number_3 = $post_phone_number_3;
    }

    public function validation()
    {
        $validation = new Validation();

        //半角に変換
        $this->phone_number_1 =  mb_convert_kana($this->phone_number_1, "n", 'UTF-8');
        $this->phone_number_2 =  mb_convert_kana($this->phone_number_2, "n", 'UTF-8');
        $this->phone_number_3 =  mb_convert_kana($this->phone_number_3, "n", 'UTF-8');

        if (
            $validation->isEmpty($this->phone_number_1) ||
            $validation->isEmpty($this->phone_number_2) ||
            $validation->isEmpty($this->phone_number_3) ||
            $validation->checkFormat($this->phone_number_1, '/^[0-9]{2,5}$/') ||
            $validation->checkFormat($this->phone_number_2, '/^[0-9]{2,4}$/') ||
            $validation->checkFormat($this->phone_number_3, '/^[0-9]{3,4}$/')
        ) {
            return false;
        }
        return true;
    }

    public function linkingPhoneNumber()
    {
        $this->phone_number = $this->phone_number_1 . '-' . $this->phone_number_2 . '-' . $this->phone_number_3;
        return $this->phone_number;
    }

    public function ModifiedPhoneNumber1($newPhoneNumber1)
    {
        return new PhoneNumber($newPhoneNumber1);
    }

    public function ModifiedPhoneNumber2($newPhoneNumber2)
    {
        return new PhoneNumber($newPhoneNumber2);
    }

    public function ModifiedPhoneNumber3($newPhoneNumber3)
    {
        return new PhoneNumber($newPhoneNumber3);
    }
}

class MailEnter
{
    private $mail;

    public function Mail($post_mail)
    {
        $this->mail = $post_mail;
    }

    public function validation()
    {
        $validation = new Validation();

        if (
            $validation->isEmpty($this->mail) ||
            $validation->checkMailPattern($this->mail) ||
            $validation->checkStringsMaxNum($this->mail, 255)
        ) {
            return false;
        }
        return true;
    }

    public function ModifiedMail($newMail)
    {
        return new MailEnter($newMail);
    }
}

class MailReenter
{
    private $remail;

    public function Remail($post_remail)
    {
        $this->remail = $post_remail;
    }

    public function validation($mail)
    {
        $validation = new Validation();
        if (
            $validation->isEmpty($this->remail) ||
            $validation->checkStringsMaxNum($this->remail, 255) ||
            $mail != $this->remail
        ) {
            return false;
        }
        return true;
    }

    public function ModifiedRemail($newRemail)
    {
        return new MailReenter($newRemail);
    }
}

class Mail
{
    public $mail_enter;
    public $mail_reenter;

    function __construct($post_mail, $post_remail)
    {
        $this->mail_enter = new MailEnter($post_mail);
        $this->mail_reenter = new MailReenter($post_remail);
    }
}

class InterestCategory
{
    private $interest_category;

    public function InterestCategory($post_interest_category)
    {
        $this->interest_category = $post_interest_category;
    }

    public function validation()
    {
        $validation = new Validation();

        //何か選択されていれば、バリデーションチェックをする。
        if (!empty($this->interest_category)) {
            //画面外からのバリデーション
            foreach ($this->interest_category as $value) {
                if ($validation->checkDataFromOutside($value, Construction::CATEGORY()->valueOf())) {
                    return false;
                }
                return true;
            }
        }
    }

    public function maintainingValue()
    {
        foreach (Construction::CATEGORY()->valueOf() as $key => $value) {
            $checked = '';
            if (isset($this->interest_category)) {
                if (in_array($key, $this->interest_category)) {
                    //選択を維持する。
                    $checked = 'checked=checked';
                }
            }
        }

        return $checked;
    }

    public function ModifiedInterestCategory($newInterestCategory)
    {
        return new InterestCategory($newInterestCategory);
    }
}

class ContactContent
{
    private $contact_content;

    public function ContactContent($post_contact_content)
    {
        $this->contact_content = $post_contact_content;
    }

    public function validation()
    {
        $validation = new Validation();
        if ($validation->isEmpty($this->contact_content)) {
            return false;
        }
        return true;
    }

    public function ModifiedContactContent($newContactContent)
    {
        return new ContactContent($newContactContent);
    }
}


class Name
{
    public $fullname;
    public $kana;

    function __construct($post_full_name, $post_full_kana)
    {
        $this->fullname = new FullName($post_full_name);
        $this->kana = new kana($post_full_kana);
    }
}

class Address
{
    public $zip_code;
    public $prefecture;
    public $city;
    public $address_other;

    public function __construct($post_zip_code1, $post_zip_code2, $post_prefecture, $post_city, $post_address_other)
    {
        $this->zip_code = new ZipCode($post_zip_code1, $post_zip_code2);
        $this->prefecture = new Prefecture($post_prefecture);
        $this->city = new City($post_city);
        $this->address_other = new AddressOther($post_address_other);
    }
}

class CustomerId
{
    function random()
    {
        return substr(str_shuffle('1234567890abcdefghijklmnopqrstuvwxyz'), 0, 8);
    }
}


class Customer
{
    public $customer_id;
    public $name;
    public $sex;
    public $age;
    public $blood_type;
    public $job;
    public $address;
    public $phone_number;
    public $mail;
    public $interest_category;
    public $contact_content;

    public function __construct($post_data)
    {
        $this->customer_id = new CustomerId();
        $this->name = new Name($post_data['full_name'], $post_data['kana']);
        $this->sex = new Sex($post_data['sex']);
        $this->age = new Age($post_data['age']);
        $this->blood_type = new BloodType($post_data['blood_type']);
        $this->job = new Job($post_data['job']);
        $this->address = new Address($post_data['zip_code_1'], $post_data['zip_code_2'], $post_data['prefecture'], $post_data['city'], $post_data['address_other']);
        $this->phone_number = new PhoneNumber($post_data['phone_number_1'], $post_data['phone_number_2'], $post_data['phone_number_3']);
        $this->mail = new Mail($post_data['mail'], $post_data['mail_confirm']);
        $this->interest_category = new InterestCategory($post_data['interest_category']);
        $this->contact_content = new ContactContent($post_data['contact_content']);
    }

    public function buildCustomerId()
    {
        return $this->customer_id->random();
    }

    public function ModifiedFullName($newName)
    {
        return $this->name->fullname->ModifiedFullName($newName);
    }
}

interface CustomerRepository
{
    public function addCustomer($post_data);
    public function findCustomer($customer_id);
    public function modifiedCustomer($customer_id);
    public function deleteCustomer($customer_id);
}
