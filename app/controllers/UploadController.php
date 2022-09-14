<?php

declare(strict_types=1);

namespace App\Controllers;

use App\createDB;
use App\View;

class UploadController
{
    public function upload(): View
    {
        $countFiles = count($_FILES['transactions']['name']);

        for ($i = 0; $i < $countFiles; ++$i) {
            move_uploaded_file(
                $_FILES['transactions']['tmp_name'][$i],
                STORAGE_PATH . '/' . $_FILES['transactions']['name'][$i]
            );
        }

        foreach (scandir(STORAGE_PATH) as $file) {
            if (is_dir($file)) {
                continue;
            }

            $files[] = $file;
        }

        $count = count($files);

        (new createDB)->create($count, $files);

        for ($i = 0; $i < $count; ++$i) {
            unlink(STORAGE_PATH . '/' . $files[$i]);
        }


        return (new ViewController)->make('/transactions');
    }
}
