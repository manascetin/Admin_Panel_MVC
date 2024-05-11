<?php namespace App\Libraries;

// App\Libraries namespace'i altında Hash sınıfı tanımlanmıştır.

class Hash {
    // Hash sınıfı başlangıcı
    
    // check() fonksiyonu, girilen parolanın veritabanındaki parola ile eşleşip eşleşmediğini kontrol eder.
    public static function check($girilen_parola, $db_parola) {
        // password_verify() fonksiyonu, bir parolanın bir hash ile eşleşip eşleşmediğini kontrol eder.
        if (password_verify($girilen_parola, $db_parola)) {
            // Eğer girilen parola ve veritabanındaki parola eşleşiyorsa, true değeri döndürülür.
            return true;
        }    
        else {
            // Eğer girilen parola ve veritabanındaki parola eşleşmiyorsa, false değeri döndürülür.
            return false;
        }
    }
    // check() fonksiyonu sonu
}
// Hash sınıfı sonu
?>
