<?php

//tablica z errorami
$errors = [];

//folder przechowyjacy obrazy
$target_dir  =  __DIR__ . "/../public/uploads";

//sciezka uploadowanego pliku
$target_file = $target_dir . basename($_FILES['fileToUpload']['name']);

//typ uploadowanego pliku
$image_file_type = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

//flaga monitorujaca przebieg uploadowania, jezeli cos jest po drodze nie tak to zmienia na 0;
$uploadOk = 1;


//waliduje dopuszczalna wielkosc pliku
if($_FILES['fileToUpload']['size'] > 500000){

    $errors[] = "Plik zbyt duży!";
    $uploadOk = 0;
}

//sprawdza czy plik jest obrazem i ma odpowiedni format
if($image_file_type !=="jpg" && $image_file_type !=="png" && $image_file_type !=="jpeg"){

    $errors[] = "Format pliku musi być JPG,PNG lub JPEG.";
    $uploadOk = 0;
}

if($uploadOk !== 1){
    $errors[] = "Nie udało się załadować pliku!";
} else {
    if(move_uploaded_file($_FILES['fileToUpload']['tmp_name'],$target_dir)){

        

    };
}


