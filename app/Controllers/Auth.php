<?php

namespace App\Controllers;

use App\Libraries\Hash;

class Auth extends BaseController
{
    public function __construct()
    {
        helper(["url","form"]);
    }
    
    public function index()
    {
        echo "Manas ÇETİN";
        return view('Panel/Login_v');
    }

    public function check()
    {
        // Doğrulama kurallarını tanımlayıp kullanıcı girişlerini doğrula
        $validation = $this->validate([
            'email' => [
                'rules'     => 'required|valid_email|is_unique[users.email]',
                'errors'    =>  [
                    'required' => 'Email boş bırakılamaz!',
                    'valid_email' => 'Geçerli Bir Mail Giriniz!',
                    'is_not_unique' => 'Bu Mail Adresi Kayıtlı Değil!',
                ]
            ],
            'password'=> [
                'rules' => 'required|min_length[5]|max_length[12]',
                'errors'=> [
                    'required'=> 'Parolayı Boş Bırakamazsınız!',
                    'min_length'=> 'Şifreniz 5 Karakterden Az Olamaz!',
                    'max_length'=> 'Şifreniz En Fazla 12 Karakter Büyüklüğünde Olabilir!',
                ]
            ]
        ]);
    
        // Eğer doğrulama başarısız olursa
        if($validation)
        {
            // Doğrulama hatalarını kullanıcıya göstermek için giriş sayfasını tekrar yükle
            return view('Panel/Login_v' , ['validation' => $this->validator]);
        }
        // Eğer doğrulama başarılıysa
        else
        {
            // Kullanıcı tarafından gönderilen email ve şifreyi al
            $email = $this->request->getPost('email');
            
            $password = $this->request->getPost('password');
    
            // Kullanıcı modelini yükle
            $usersmodel = new \App\Models\UsersModel();
    
            // Veritabanında bu email'e sahip kullanıcıyı bul
            $user_info = $usersmodel->where('email','=', $email)->first();
            
            // $password değişkeni kullanıcı tarafından girilen parolayı temsil eder.
            // $user_info['password'] değişkeni veritabanında saklanan kullanıcının parolasını temsil eder.
            $check_password = Hash::check($password,$user_info['password']);

            // Hash sınıfındaki check fonksiyonunu kullanarak girilen parolanın doğruluğunu kontrol eder.
            // Eğer girilen parola veritabanındaki parola ile eşleşmiyorsa, $check_password değeri false olacaktır.
            if($check_password){
                // Eğer parola doğru değilse, kullanıcıya "Şifre Hatalı" mesajı gösterilir.
                session()->setFlashdata('fail','Şifre Hatalı');
                // Kullanıcı giriş yapmaya çalıştığında tekrar giriş yapabileceği bir form gösterilir.
                // withInput() fonksiyonu, kullanıcının girdiği verileri form alanlarında göstermek için kullanılır.
                return redirect()->to('/')->withInput();
            }
            else{
                $user_id = $user_info['id'];
                session()->set('loggedUser' , $user_id);
                return redirect()->to('/dashboard');
            }


        }
    }
    



} 


