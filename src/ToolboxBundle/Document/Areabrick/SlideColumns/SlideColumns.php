<?php

namespace ToolboxBundle\Document\Areabrick\SlideColumns;

use ToolboxBundle\Document\Areabrick\AbstractAreabrick;
use Pimcore\Model\Document\Tag\Area\Info;
use ToolboxBundle\Registry\CalculatorRegistryInterface;

class SlideColumns extends AbstractAreabrick
{
    /**
     * @var CalculatorRegistryInterface
     */
    private $calculatorRegistry;

    /**
     * @param CalculatorRegistryInterface $calculatorRegistry
     */
    public function __construct(CalculatorRegistryInterface $calculatorRegistry)
    {
        $this->calculatorRegistry = $calculatorRegistry;
    }

    /**
     * @param Info $info
     *
     * @throws \Exception
     */
    public function action(Info $info)
    {
        parent::action($info);

        /** @var \Pimcore\Model\Document\Tag\Checkbox $equalHeightElement */
        $equalHeightElement = $this->getDocumentTag($info->getDocument(), 'checkbox', 'equal_height');
        $equalHeight = $equalHeightElement->isChecked() && !$info->getView()->get('editmode');

        /** @var Info $brick */
        $brick = $info->getView()->get('brick');
        $id = $brick->getId() . '-' . $brick->getIndex();

        $slidesPerView = (int)$this->getDocumentTag($info->getDocument(), 'select', 'slides_per_view')->getData();
        $slideElements = $this->getDocumentTag($info->getDocument(), 'block', 'slideCols', ['default' => $slidesPerView]);

        $theme = $this->configManager->getConfig('theme');
        $calculator = $this->calculatorRegistry->getSlideColumnCalculator($theme['calculators']['slide_calculator']);

        $slideColumnConfig = $this->getConfigManager()->getAreaParameterConfig('slideColumns');
        $slidesPerViewClass = $calculator->calculateSlideColumnClasses($slidesPerView, $slideColumnConfig);
        $breakpoints = $this->calculateSlideColumnBreakpoints($slidesPerView);

        $info->getView()->getParameters()->add([
            'id'                   => $id,
            'slideElements'        => $slideElements,
            'slidesPerView'        => $slidesPerView,
            'slidesPerViewClasses' => $slidesPerViewClass,
            'breakpoints'          => $breakpoints,
            'equalHeight'          => $equalHeight
        ]);

    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'Slide Columns';
    }

    /**
     * @return string
     */
    public function getDescription()
    {
        return 'Toolbox Slide Columns';
    }

    /**
     * @param int $columnType
     *
     * @return array
     * @throws \Exception
     */
    private function calculateSlideColumnBreakpoints($columnType)
    {
        $columnType = (int)$columnType;
        $configInfo = $this->getConfigManager()->getAreaParameterConfig('slideColumns');

        $breakpoints = [];

        if (!empty($configInfo)) {
            if (isset($configInfo['breakpoints']) && isset($configInfo['breakpoints'][$columnType])) {
                $breakpoints = $configInfo['breakpoints'][$columnType];
            }
        }

        return $breakpoints;
    }
}
