<?php
namespace Magento\Movie\Block;

class Index extends \Magento\Framework\View\Element\Template
{

	protected $_movieFactory;
	protected $_resource;
	public function __construct(
		\Magento\Framework\View\Element\Template\Context $context,
		\Magento\Movie\Model\MovieFactory $movieFactory,
		\Magento\Framework\App\ResourceConnection $Resource
	){
		$this->_movieFactory = $movieFactory;
		$this->_resource = $Resource;
		parent::__construct($context);
	}

	public function getTitle()
	{
		return __('Movie List');
	}
	public function getMovieCollection(){
		
        $page=($this->getRequest()->getParam('p'))? $this->getRequest()->getParam('p') : 1;
  
        $pageSize=($this->getRequest()->getParam('limit'))? $this->getRequest()->getParam('limit') : 1;

		$collection       = $this->_movieFactory->create()->getCollection();

		$directorTable    = $this->_resource->getTableName('magenest_director');
		$actorTable       = $this->_resource->getTableName('magenest_actor');
		$movie_actorTable = $this->_resource->getTableName('magenest_movie_actor');

		$movie_directorCondition = 'main_table.director_id = director.director_id';
		$movie_actiorCondition   = 'main_table.movie_id = movie_actior.movie_id';
		$actor_movieCondition    = 'actor.actor_id = movie_actior.actor_id';

		$collection->getSelect()
						->join(
							['director' => $directorTable],
							$movie_directorCondition,
							[
								'director_name' => 'director.name'
							]
						)
						->join(
							['movie_actior' => $movie_actorTable],
							$movie_actiorCondition,
							[]
						)
						->join(
							['actor' => $actorTable],
							$actor_movieCondition,
							[
								'actor_name' => new \Zend_Db_Expr('group_concat(actor.name)')
							]
						)
						->group('main_table.movie_id');
						// echo $collection->getSelect()->__toString();die;
        
        $collection->setPageSize($pageSize);
        $collection->setCurPage($page);
		return $collection;
		
	}
	protected function _prepareLayout()
	{
		parent::_prepareLayout();
		// $this->pageConfig->getTitle()->set(__('News'));


		if ($this->getMovieCollection()) {
		    $pager = $this->getLayout()->createBlock(
		        'Magento\Theme\Block\Html\Pager',
		        'movie.index.pager'
		    )->setAvailableLimit(array(1=>1,2=>2,3=>3,4=>4))->setShowPerPage(true)->setCollection(
		        $this->getMovieCollection()
		    );
		    $this->setChild('pager', $pager);
		    $this->getMovieCollection()->load();
		}
		return $this;
	}
	public function getPagerHtml()
	{
	    return $this->getChildHtml('pager');
	}
}