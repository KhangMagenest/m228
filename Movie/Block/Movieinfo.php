<?php

namespace Magenest\Movie\Block;

use Magento\Framework\View\Element\Template;

class Movieinfo extends Template
{
    private $_collectionFactory;

    public function __construct(
        Template\Context $context,
        \Magenest\Movie\Model\ResourceModel\MovieActor\CollectionFactory $collectionFactory,
        array $data = [])
    {
        parent::__construct($context, $data);
        $this->_collectionFactory = $collectionFactory;
    }

    public function getMovieInfo() {
        $collection = $this->_collectionFactory->create();
        $collection->getSelect()->join(
            ['magenest_actor'=>$collection->getTable('magenest_actor')],
            'main_table.actor_id = magenest_actor.actor_id',
            ['actor_name'=>'magenest_actor.name']);
        $collection->getSelect()->join(
            ['magenest_movie'=>$collection->getTable('magenest_movie')],
            'main_table.movie_id = magenest_movie.movie_id',
            ['director_id'=>'magenest_movie.director_id', 'movie_name'=>'magenest_movie.name', ]);
        $collection->getSelect()->join(
            ['magenest_director'=>$collection->getTable('magenest_director')],
            'magenest_movie.director_id = magenest_director.director_id',
            ['director_name'=>'magenest_director.name']);
        return $collection;
    }

}