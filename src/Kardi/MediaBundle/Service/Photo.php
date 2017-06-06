<?php

namespace Kardi\MediaBundle\Service;


class Photo
{
    /**
     * @param stream resource $data
     * @param string $filename
     * @return bool
     */
    public function createPhotoFromBase($data, string $filename)
    {
        try {
            list($type, $data) = explode(';', $data);
            list(, $data) = explode(',', $data);
            $data = base64_decode($data);

            $fullFilename = $_SERVER['DOCUMENT_ROOT'] . $filename;

            if (file_exists($fullFilename)) {
                unlink($fullFilename);
            }
            
            file_put_contents($fullFilename, $data);
        } catch (\Exception $e) {
            return false;
        }

        return true;
    }
}
