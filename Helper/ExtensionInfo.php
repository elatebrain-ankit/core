<?php
/**
 * ElateBrain
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the elatebrain.com license which is available at https://www.elatebrain.com/LICENSE.txt
 *
 * DISCLAIMER
 *
 * Do not edit or add to this file if you wish to upgrade this extension to newer version in the future.
 * If you wish to customize this extension for your needs, please refer to https://magento.com for more information.
 *
 * @category    Elatebrain
 * @package     Elatebrain_Core
 * @version     1.0.1
 * @copyright   Copyright (c) 2019 Elatebrain (https://www.elatebrain.com/)
 * @license     https://www.elatebrain.com/LICENSE.txt
 */

namespace Elatebrain\Core\Helper;
/**
 *
 */
class ExtensionInfo extends \Magento\Framework\App\Helper\AbstractHelper
{
    /**
     *
     */
    const EXTENSION_FEED_URL = "https://www.elatebrain.com/feed/extension-feed.json";

    /**
     * @return mixed
     */
    public function getExtensionFeed()
    {
        $curl = curl_init(self::EXTENSION_FEED_URL);

        curl_setopt($curl, CURLOPT_HEADER, 0);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_FOLLOWLOCATION, true);

        $response = curl_exec($curl);

        $extensionFeed = json_decode($response, true);

        return $extensionFeed;
    }

    /**
     * @return array
     */
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