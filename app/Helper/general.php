<?php
define('Pagination_count', 15);
function getfolder()
{
    return app()->getLocale()==='ar'?'css-rtl':'css';
}

function uploadImage($folder , $image)
{
     $image->store('/',$folder);
    $fileName=$image->hashName();
      return $fileName; // Return the file name if needed */


     /*  if (!$image) {
        return null; // Return null if no file is provided
    }

    $filePath = $image->store($folder, 'public');
    return asset('storage/' . $filePath); */
}

