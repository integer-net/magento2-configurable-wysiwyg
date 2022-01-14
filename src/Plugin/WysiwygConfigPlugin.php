<?php

declare(strict_types=1);

/**
 * integer_net Magento Module
 *
 * @category   IntegerNet\ConfigurableWysiwyg\Plugin
 * @package    WysiwygConfigPlugin
 * @copyright  Copyright (c) 2022 integer_net GmbH (http://www.integer-net.de/)
 * @author     Andreas von Studnitz <avs@integer-net.de>
 */

namespace IntegerNet\ConfigurableWysiwyg\Plugin;

use Magento\Cms\Model\Wysiwyg\Config;
use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Framework\Data\Wysiwyg\ConfigProviderInterface;

class WysiwygConfigPlugin
{
    /**
     * @var ScopeConfigInterface
     */
    private $scopeConfig;

    public function __construct(
        ScopeConfigInterface $scopeConfig
    ) {
        $this->scopeConfig = $scopeConfig;
    }

    public function beforeGetConfig(
        \Magento\Cms\Model\Wysiwyg\Config $subject,
        $data = []
    ) {
        if (isset($data['add_variables'])) {
            $data['add_variables'] = $this->scopeConfig->isSetFlag('cms/wysiwyg/add_variable');
        }
        if (isset($data['add_widgets'])) {
            $data['add_widgets'] = $this->scopeConfig->isSetFlag('cms/wysiwyg/add_widget');
        }
        if (isset($data['add_images'])) {
            $data['add_images'] = $this->scopeConfig->isSetFlag('cms/wysiwyg/add_image');
        }

        return [$data];
    }
}
