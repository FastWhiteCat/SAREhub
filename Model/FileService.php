<?php

namespace Fwc\SAREhub\Model;

use Magento\Framework\Filesystem\Io\File;

/**
 * Class FileService
 */
class FileService
{
    /**
     * @var File
     */
    protected $file;

    /**
     * FileService constructor.
     *
     * @param File $file
     */
    public function __construct(File $file)
    {
        $this->file = $file;
    }

    /**
     * Copy files
     *
     * @param array  $fileNames
     * @param string $sourcePath
     * @param string $destinationPath
     */
    public function copyFiles(array $fileNames, string $sourcePath, string $destinationPath)
    {
        foreach ($fileNames as $fileName) {
            $this->file->cp(
                $sourcePath . DIRECTORY_SEPARATOR . $fileName,
                $destinationPath . DIRECTORY_SEPARATOR . $fileName
            );
        }
    }

    /**
     * Remove filenames from location
     * 
     * @param array  $fileNames
     * @param string $path
     */
    public function removeFiles(array $fileNames, string $path)
    {
        foreach ($fileNames as $fileName) {
            $this->file->rm($path . DIRECTORY_SEPARATOR . $fileName);
        }
    }

    /**
     * Check if files are the same
     *
     * @param string $fileOne
     * @param string $fileTwo
     *
     * @return bool
     */
    public function compareFiles(string $fileOne, string $fileTwo)
    {
        if (filetype($fileOne) !== filetype($fileTwo)) {
            return false;
        }
        if (filesize($fileOne) !== filesize($fileTwo)) {
            return false;
        }

        if (!$fp1 = fopen($fileOne, 'rb')) {
            return false;
        }

        if (!$fp2 = fopen($fileTwo, 'rb')) {
            fclose($fp1);

            return false;
        }

        $same = true;

        while (!feof($fp1) and !feof($fp2))
            if (fread($fp1, 4096) !== fread($fp2, 4096)) {
                $same = false;
                break;
            }

        if (feof($fp1) !== feof($fp2)) {
            $same = false;
        }

        fclose($fp1);
        fclose($fp2);

        return $same;
    }
}
