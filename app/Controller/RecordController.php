<?php
	class RecordController extends AppController{

		// Add Cakephp Pagination
		public $paginate = array(
			'limit' => 10,
			'order' => array('Record.id' => 'Desc'),
		);

		public function index(){
			ini_set('memory_limit','256M');
			set_time_limit(0);

			$this->setFlash('Listing Record page too slow, try to optimize it.');

			// $this->paginate['Record']['conditions']

			// $records = $this->Record->find('all');
			// var_dump('sad');

			// $this->set('records',$records);
			// var_dump($this->paginate());
			$this->set('records', $this->paginate());


			$this->set('title',__('List Record'));
		}


// 		public function update(){
// 			ini_set('memory_limit','256M');

// 			$records = array();
// 			for($i=1; $i<= 1000; $i++){
// 				$record = array(
// 					'Record'=>array(
// 						'name'=>"Record $i"
// 					)
// 				);

// 				for($j=1;$j<=rand(4,8);$j++){
// 					@$record['RecordItem'][] = array(
// 						'name'=>"Record Item $j"
// 					);
// 				}

// 				$this->Record->saveAssociated($record);
// 			}



// 		}
	}
