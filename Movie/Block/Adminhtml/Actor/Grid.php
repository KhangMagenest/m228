<?php

namespace Magenest\Movie\Block\Adminhtml\Actor;

use Magento\Backend\Block\Widget\Grid as WidgetGrid;

class Grid extends \Magento\Backend\Block\Widget\Grid\Extended
{
    protected $_actorCollection;

    public function __construct(
        \Magento\Backend\Block\Template\Context $context,
        \Magento\Backend\Helper\Data $backendHelper,
        \Magenest\Movie\Model\ResourceModel\Actor\Collection $actorCollection,
        array $data = []
    )
    {
        $this->_actorCollection = $actorCollection;
        parent::__construct($context, $backendHelper, $data);
        $this->setEmptyText(__('No Actors Found'));
    }

    /**
     * Initialize the subscription collection
     *
     * @return WidgetGrid
     */
    protected function _prepareCollection()
    {
        $this->setCollection($this->_actorCollection);
        return parent::_prepareCollection();
    }

    /**
     * Prepare grid columns
     *
     * @return $this
     */
    protected function _prepareColumns()
    {
        $this->addColumn(
            'actor_id',
            [

                'header' => __('Actor ID'),
                'index' => 'actor_id',
            ]
        );
        $this->addColumn(
            'name',
            [
                'header' => __('Actor Name'),
                'index' => 'name',
            ]
        );

        return $this;
    }
}