<?php

namespace Kardi\MediaBundle\Service;

class File
{
    public function unlinkFile($filename, $directory, $searchSubdirectories = false)
    {
        if (file_exists($directory . DIRECTORY_SEPARATOR . $filename)) {
            unlink($directory . DIRECTORY_SEPARATOR . $filename);
        }

        if ($searchSubdirectories) {
            $directoryIterator = new \RecursiveDirectoryIterator($directory);

            $subdirectories = $directoryIterator->getChildren();

            foreach ($subdirectories as $subdirectory) {
                if (!$subdirectory->isDir() || in_array($subdirectory->getBasename(), ['.', '..'])) {
                    continue;
                }

                if (file_exists($subdirectory->getPathname() . DIRECTORY_SEPARATOR . $filename)){
                    unlink($subdirectory->getPathname() . DIRECTORY_SEPARATOR . $filename);
                }
            }
        }
    }
}
