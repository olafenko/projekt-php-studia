<?php

class ImageUploader {


    //funkcja odpowiedzialna za uploadowanie obrazka, przyjmuje tablice $file z informacjami o pliku
    function uploadImage($file,&$uploadErrors){

        //max wielkosc pliku  = 5 mb
        $FILE_MAX_SIZE = 5000000;

        //dozwolone typy pliku
        $allowedTypes = [
            'image/png' => 'png',
            'image/jpeg' => 'jpeg',
        ];


        //folder przechowyjacy obrazy
        $target_dir  =  __DIR__ . "/../public/uploads/";

        //jezeli folder nie istnieje to go stworzy
        if(!is_dir($target_dir)){
            mkdir($target_dir,0755,true);
        }

        //sprawdza errory
        if($file['error'] !== UPLOAD_ERR_OK){

            $uploadErrors[] = "Błąd uploadowania pliku.";
            return;
        }

        //sprawdza czy plik ma dopuszczalny rozmiar
        if($file['size'] > $FILE_MAX_SIZE){

            $uploadErrors[] = "Plik jest zbyt duży! Maksymalna wielkosc to 5 mb.";
            return;
        }

        //sprawdzanie typu pliku
        $finfo = new finfo(FILEINFO_MIME_TYPE);
        $mime = $finfo->file($file['tmp_name']);
        if(!isset($allowedTypes[$mime])){

            $uploadErrors[] = "Plik nie jest obsługiwany! Dozwolone pliki to .jpg, .jpeg, .png";
            return;
        }

        //nadanie plikowi unikalnej nazwy
        $unique_filename = sha1_file($file['tmp_name']) . "." . $allowedTypes[$mime];

        //finalna sciezka do zapisu
        $final_path = $target_dir .  $unique_filename;


        if(!move_uploaded_file($file['tmp_name'],$final_path)){
            $uploadErrors[] = "Nie udało się uploadować pliku.";
            return;
        }

        //po udanych poprzednich operacjach, zwraca ostateczna sciezke uploadowanego pliku
        return '/SerwisOgloszeniowy/public/uploads/' . $unique_filename;

    }

}



