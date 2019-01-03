<?php
namespace Elatebrain\Core\Helper;
class ExtensionInfo extends \Magento\Framework\App\Helper\AbstractHelper
{
    const EXTENSION_FEED_URL = "http://www.elatebrain.com/feed/extension-feed.json";

    public function getExtensionFeed()
    {
        $curl = curl_init(self::EXTENSION_FEED_URL);

        curl_setopt($curl, CURLOPT_HEADER, 0);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($curl);

        $extensionFeed = json_decode($response, true);

        return $extensionFeed;
    }

    public function getExtensionArray()
    {
        $latestExtensionList = $this->getExtensionFeed();
        $extensionList = array();
        if(isset($latestExtensionList['items']) && !empty($latestExtensionList['items'])){
            foreach($latestExtensionList['items'] as $latestExtension){
                $extensionList[$latestExtension['name']] = $latestExtension;
            }
        }
        return $extensionList;
    }
}