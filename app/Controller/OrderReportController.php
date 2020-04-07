<?php
	class OrderReportController extends AppController{

		// Create a simple helper to diedump (debug) array;
		public function dd($data){
			debug($data);
			exit;
		}

	    /*

	    Question 5 Complete: I'm not sure If i did the right thing here but I did my best to understand it.
		I use the data from Order and Portion Table to answer this question
		I multiple the ingredient value to order value to quantity to some the exact value/price of the ingredient value
		if the Dishes has the same ingredient, what i did is I added the value/price of the ingredient on the previous ingredient value

	    */
		public function index(){

			$this->setFlash('Multidimensional Array.');

			$this->loadModel('Order');
			$orders = $this->Order->find('all',array('conditions'=>array('Order.valid'=>1),'recursive'=>2));
			// debug($orders);exit;

			$this->loadModel('Portion');
			$portions = $this->Portion->find('all',array('conditions'=>array('Portion.valid'=>1),'recursive'=>2));
			// debug($portions);exit;


			// To Do - write your own array in this format
			$order_reports = [];
			foreach($orders as $index => $order){

				// get all items of order
				$order_items = [];
				$item_quantity = [];
				foreach($order['OrderDetail'] as $order_details){
					$order_items[] = $order_details['item_id'];
					$item_quantity[$order_details['item_id']] = $order_details['quantity'];
				}


				// Find portion / parts / ingrediants of the order
				$get_ingredient = [];
				$ctr = 1;
				$sample = [];
				foreach($portions as $portion){
					if(in_array($portion['Item']['id'], $order_items)){
						foreach($portion['PortionDetail'] as $portion_index => $portion_detail){

							$duplicate_ingredient = 0;
							$ingredient_value = 0;

							// Check if ingredient is duplicate / already on the array
							if(!empty($get_ingredient[$portion_detail['Part']['name']])){

								// Add the previous/existing ingredient value
								$ingredient_value = ((float) $portion_detail['value'] * (float) $item_quantity[$portion['Item']['id']]) + $get_ingredient[$portion_detail['Part']['name']];
							} else {
								$ingredient_value = ((float) $portion_detail['value'] * (float) $item_quantity[$portion['Item']['id']]);
							}

							$get_ingredient[$portion_detail['Part']['name']] = $ingredient_value;

						}
					}
				}

				$order_reports[$order['Order']['name']] = $get_ingredient;
			}
			// $this->dd($order_reports);


			$this->set('order_reports',$order_reports);

			$this->set('title',__('Orders Report'));
		}

		public function Question(){

			$this->setFlash('Multidimensional Array.');

			$this->loadModel('Order');
			$orders = $this->Order->find('all',array('conditions'=>array('Order.valid'=>1),'recursive'=>2));

			// debug($orders);exit;

			$this->set('orders',$orders);

			$this->loadModel('Portion');
			$portions = $this->Portion->find('all',array('conditions'=>array('Portion.valid'=>1),'recursive'=>2));

			// debug($portions);exit;

			$this->set('portions',$portions);

			$this->set('title',__('Question - Orders Report'));
		}

	}
