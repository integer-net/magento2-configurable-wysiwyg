<?php

declare(strict_types=1);

 /**
 * integer_net Magento Module
 *
 * @category   IntegerNet\ConfigurableWysiwyg\Model\Config\Source
 * @package    Toolbar
 * @copyright  Copyright (c) 2020 integer_net GmbH (http://www.integer-net.de/)
 * @author     Andreas von Studnitz <avs@integer-net.de>
 */

namespace IntegerNet\ConfigurableWysiwyg\Model\Config\Source;

class Toolbar implements \Magento\Framework\Option\ArrayInterface
{
    public function toOptionArray()
    {
        return [
            ['value' => 'undo', 'label' => __('Undo')],
            ['value' => 'redo', 'label' => __('Redo')],
            ['value' => 'formatselect', 'label' => __('Format Select')],
            ['value' => 'bold', 'label' => __('Bold')],
            ['value' => 'italic', 'label' => __('Italic')],
            ['value' => 'underline', 'label' => __('Underline')],
            ['value' => 'alignleft', 'label' => __('Align Left')],
            ['value' => 'aligncenter', 'label' => __('Align Center')],
            ['value' => 'alignright', 'label' => __('Align Right')],
            ['value' => 'bullist', 'label' => __('Bullet List')],
            ['value' => 'numlist', 'label' => __('Numbered List')],
            ['value' => 'link', 'label' => __('Link')],
            ['value' => 'table', 'label' => __('Table')],
            ['value' => 'charmap', 'label' => __('Character Map')],
        ];
    }
}
