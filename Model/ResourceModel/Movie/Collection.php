<?php
namespace Magento\Movie\Model\ResourceModel\Movie;

class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{
	protected $_idFieldName = 'movie_id';

	/**
	 * Define resource model
	 *
	 * @return void
	 */
	protected function _construct()
	{
		$this->_init('Magento\Movie\Model\Movie', 'Magento\Movie\Model\ResourceModel\Movie');
	}

}