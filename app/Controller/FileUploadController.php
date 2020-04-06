<?php
App::import('Vendor', 'php-excel-reader/excel_reader2');

class FileUploadController extends AppController {

	public function index() {
		$this->set('title', __('File Upload Answer'));

		$request = $this->request->data;
		// var_dump($request);

		// Get File Extesntion
		$extension = pathinfo($request['FileUpload']['file']['name'], PATHINFO_EXTENSION);

		// Validate file if it has correct correct file format
		if(in_array($extension, ['csv', 'xls', 'xlsx'])){
			// Check if user is uploading a file
			if(!empty($request['FileUpload']['file'])){

				$file = $request['FileUpload']['file']['tmp_name'];
				// var_dump($extension);
				$data = new Spreadsheet_Excel_Reader($file, true);
				$temp = $data->dumptoarray(); // This will arrange the data of the excel file
				// var_dump($temp);
				$get_file_data = [];


				// Rearrange data
				foreach($temp as $index => $file_data){
					// var_dump($file_data);
					// exit;
					if($index >= 2){

						$get_file_data[]['FileUpload'] = [
							'name' => $file_data[1],
							'email' => $file_data[2],
						];
					}
				}

				// Save all data
				if($this->FileUpload->saveAll($get_file_data)){
					$this->setFlash('The File is successfully uploaded');
				}
			}
		} else {

			// Show Validation message
			$this->setFlash('Invalid File Format! must be (.csv, .xls, .xlsx)');
		}


		$file_uploads = $this->FileUpload->find('all');

		$this->set(compact('file_uploads'));
	}
}
