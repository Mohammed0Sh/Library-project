<?php

namespace App\traits;

trait helper
{

    public function getTypeOfFile($file)
    {
        $extension = $file -> getClientOriginalExtension();
        if ($extension == 'jpg' || $extension == 'png' || $extension == 'JPG' || $extension == 'PNG')
        {
            return 'img';
        }
        else if ($extension == 'pdf' ||$extension == 'PDF' )
        {
            return 'pdf';
        }
        else
        {
            return 'not supported';
        }
    }

}
