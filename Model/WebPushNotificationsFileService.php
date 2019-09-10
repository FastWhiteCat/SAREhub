<?php

namespace Fwc\SAREhub\Model;

use Magento\Framework\App\Filesystem\DirectoryList;
use Magento\Framework\Exception\FileSystemException;
use Magento\Framework\Filesystem;
use Magento\Framework\Filesystem\Io\File;
use Magento\Framework\Module\Dir\Reader;

/**
 * Class WebPushNotificationsFileService
 */
class WebPushNotificationsFileService extends FileService
{
    const WEB_PUSH_NOTIFICATIONS_FILES_PATH = '/lib/WebPushNotifications';
    const MODULE_NAME                       = 'Fwc_SAREhub';

    /**
     * @var Reader
     */
    protected $moduleReader;

    /**
     * @var Filesystem
     */
    protected $filesystem;

    /**
     * @var DirectoryList
     */
    protected $directoryList;

    /**
     * @var array
     */
    protected $fileNames = [
        'manifest.json',
        'sw.js'
    ];

    /**
     * WebPushNotificationsFileService constructor.
     *
     * @param File          $file
     * @param Reader        $moduleReader
     * @param Filesystem    $filesystem
     * @param DirectoryList $directoryList
     */
    public function __construct(
        File $file,
        Reader $moduleReader,
        Filesystem $filesystem,
        DirectoryList $directoryList
    ) {
        parent::__construct($file);
        $this->moduleReader  = $moduleReader;
        $this->filesystem    = $filesystem;
        $this->directoryList = $directoryList;
    }

    /**
     * Copy files responsible for web push notifications
     * into magento pub directory
     *
     * @throws FileSystemException
     */
    public function addWebPushFiles()
    {
        parent::copyFiles($this->fileNames, $this->getNotificationFilesDirPath(), $this->getPubDirPath());
    }

    /**
     * Remove files responsible for web push notifications
     * from magento pub directory
     *
     * @throws FileSystemException
     */
    public function removeWebPushFiles()
    {
        parent::removeFiles($this->fileNames, $this->getPubDirPath());
    }

    /**
     * Compare files responsible for web push notifications
     * if they are not overridden in magento pub dir
     *
     * @throws FileSystemException
     */
    public function compareWebPushFiles()
    {
        $notificationDirPath = $this->getNotificationFilesDirPath();
        $pubDirPath          = $this->getPubDirPath();

        foreach ($this->fileNames as $fileName) {
            $sourceFile = $notificationDirPath . DIRECTORY_SEPARATOR . $fileName;
            $pubFile = $pubDirPath . DIRECTORY_SEPARATOR . $fileName;

            if (!parent::compareFiles($sourceFile, $pubFile)) {
                return false;
            }
        }

        return true;
    }

    /**
     * @throws FileSystemException
     */
    public function webPushFilesExistsInPub()
    {
        $pubDir = $this->getPubDirPath();

        foreach ($this->fileNames as $fileName) {
            if ($this->file->fileExists($pubDir . DIRECTORY_SEPARATOR . $fileName)) {
                return true;
            }
        }

        return false;
    }

    /**
     * @return string
     */
    public function getNotificationFilesDirPath()
    {
        return $this->moduleReader->getModuleDir('', self::MODULE_NAME) . self::WEB_PUSH_NOTIFICATIONS_FILES_PATH;
    }

    /**
     * @return string
     * @throws FileSystemException
     */
    public function getPubDirPath()
    {
        return $this->directoryList->getPath(DirectoryList::PUB);
    }
}
