<?php

declare(strict_types=1);

/**
 * integer_net Magento Module
 *
 * @category   IntegerNet\ConfigurableWysiwyg\Plugin
 * @package    WysiwygConfigProviderPlugin
 * @copyright  Copyright (c) 2020 integer_net GmbH (http://www.integer-net.de/)
 * @author     Andreas von Studnitz <avs@integer-net.de>
 */

namespace IntegerNet\ConfigurableWysiwyg\Plugin;

use Magento\Cms\Model\Wysiwyg\CompositeConfigProvider;
use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Framework\Data\Wysiwyg\ConfigProviderInterface;

class WysiwygConfigProviderPlugin
{
    /**
     * @var array
     */
    private $additionalSettings;
    /**
     * @var ScopeConfigInterface
     */
    private $scopeConfig;
    /**
     * @var CompositeConfigProvider
     */
    private $compositeConfigProvider;

    public function __construct(
        array $additionalSettings,
        ScopeConfigInterface $scopeConfig,
        CompositeConfigProvider $compositeConfigProvider
    ) {
        $this->additionalSettings = $additionalSettings;
        $this->scopeConfig = $scopeConfig;
        $this->compositeConfigProvider = $compositeConfigProvider;
    }

    public function afterGetConfig(
        ConfigProviderInterface $subject,
        \Magento\Framework\DataObject $result
    ) {
        $toolbar = implode(' ', explode(',', $this->scopeConfig->getValue('admin/wysiwyg/toolbar')));

        $result->setData(
            'tinymce4',
            [
                'toolbar' => $toolbar,
                'plugins' => $result->getData('tinymce4')['plugins'],
                'content_css' => $result->getData('tinymce4')['content_css'],
            ]
        );

        //$result->setData('settings', $this->additionalSettings);
        $result->setData('add_variables', $this->scopeConfig->isSetFlag('cms/wysiwyg/add_variable'));
        $result->setData('add_widgets', $this->scopeConfig->isSetFlag('cms/wysiwyg/add_widget'));
        $result->setData('add_images', $this->scopeConfig->isSetFlag('cms/wysiwyg/add_image'));

        $plugins = $result->getData('plugins');
        foreach ($plugins as $key => $plugin) {
            if ($plugin['name'] == 'magentovariable' && !$this->scopeConfig->isSetFlag('cms/wysiwyg/add_variable')) {
                unset($plugins[$key]);
            }
            if ($plugin['name'] == 'magentowidget' && !$this->scopeConfig->isSetFlag('cms/wysiwyg/add_widget')) {
                unset($plugins[$key]);
            }
            if ($plugin['name'] == 'image' && !$this->scopeConfig->isSetFlag('cms/wysiwyg/add_image')) {
                unset($plugins[$key]);
                $result->unsetData('files_browser_window_width');
                $result->unsetData('files_browser_window_height');
                $result->unsetData('files_browser_window_url');
            }
        }

        $result->setData('plugins', array_values($plugins));

        return $result;
    }
}
