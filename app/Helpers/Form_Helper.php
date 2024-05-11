<?php

// display_error() fonksiyonu, belirtilen bir alanın doğrulama (validation) hatasını gösterir.
// Parametreler:
// $validate: CodeIgniter'ın form doğrulama sınıfı (Validation) örneği.
// $field: Hatanın kontrol edileceği alan adı.
function display_error($validate, $field)
{
    // Eğer belirtilen alan için bir hata varsa:
    if ($validate->hasError($field)) {
        // Hatanın metnini döndürür.
        return $validate->getError($field);
    } else {
        // Eğer hata yoksa, false döndürür.
        return false;
    }
}

?>
