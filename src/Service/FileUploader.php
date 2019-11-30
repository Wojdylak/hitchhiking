<?php


namespace App\Service;


use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class FileUploader
{
    private $targetDirectory;

    public function __construct($targetDirectory)
    {
        $this->targetDirectory = $targetDirectory;
    }

    /**
     * @param UploadedFile $file
     * @return bool|string
     */
    public function upload(UploadedFile $file)
    {
        $filename = md5(uniqid()) . '.' . $file->guessClientExtension();
        try {
            $file->move(
                $this->getTargetDirectory(),
                $filename
            );
        } catch (FileException $e) {
            return false;
        }

        return $filename;
    }

    /**
     * @param string $filename
     */
    public function remove(string $filename)
    {
        if (!is_null($filename)){
            $filesystem = new Filesystem();
            $filesystem->remove(
                $this->getTargetDirectory() . $filename
            );
        }
    }

    /**
     * @return mixed
     */
    public function getTargetDirectory()
    {
        return $this->targetDirectory;
    }
}