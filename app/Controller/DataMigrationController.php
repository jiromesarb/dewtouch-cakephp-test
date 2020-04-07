<?php
App::import('Vendor', 'php-excel-reader/excel_reader2');

class DataMigrationController extends AppController{


    // Create a simple helper to diedump (debug);
    public function dd($data){
        debug($data);
        exit;
    }


    /*

    Question 6 Incomplete: Did not finished question 6 due to time limit. But I think I'm doing the right thing.
    What I did here is that I get the data from the migration_sample_1 excel file and save I'll save it to there own database
    What I finixhed here is the member DB. I successfully added the data from member DB
    I'm at the transanction DB but I think I can't make it on time.

    */
    public function index(){

        $this->setFlash('Question: Migration of data to multiple DB table');

        // $get_migration_file = new Folder(APP_DIR . DS . "webroot" . DS . "img");

		$this->loadModel('Member');
		$members = $this->Member->find('all');

		$this->loadModel('Transaction');
		$members = $this->Transaction->find('all');

		$this->loadModel('TransactionItem');
		$members = $this->TransactionItem->find('all');
        // $this->dd($members);

        $data = new Spreadsheet_Excel_Reader("migration_sample_1.xls", true);
        $temp = $data->dumptoarray(); // This will arrange the data of the excel file

        // Find last id
        $member_id = $this->Member->query("SELECT LAST_INSERT_ID()")[0][0]['LAST_INSERT_ID()'];
        $transaction_id = $this->Transaction->query("SELECT LAST_INSERT_ID()")[0][0]['LAST_INSERT_ID()'];
        $transaction_item_id = $this->TransactionItem->query("SELECT LAST_INSERT_ID()")[0][0]['LAST_INSERT_ID()'];

        $get_member = [];
        foreach($temp as $migration_index => $migration_data) {

            if($migration_index >= 2){

                // Split member no to 2 which will be type and no
                $get_member_no = explode(" ", $migration_data[4]);

                // Store member data to array
                $get_member[]['Member'] = [
                    'id' => $member_id,
                    'type' => trim($get_member_no[0]),
                    'no' => trim($get_member_no[1]),
                    'name' => $migration_data[3],
                    'company' => $migration_data[6],
                    'valid' => 1,
                    // 'created_at' => $migration_data[1],
                    // 'updated_at' => $migration_data[1],
                ];


                // Get Date
                // $this->dd($migration_data[1]);
                // $get_date = new DateTime($migration_data[1]);
                // $this->dd($get_date);

                // Store transaction data to array
                // $get_member[]['Transaction'] = [
                //     'id' => $transaction_id,
                //     'member_id' => $member_id,
                //     'member_name' => $migration_data[3],
                //     // 'member_paytype' => ,
                //     'member_company' => $migration_data[6],
                //     'date' => $migration_data[1],
                //     'year' => $migration_data[1],
                // ];
            }

            $member_id++;
        }
        // $this->dd($get_member);

        $this->Member->saveAll($get_member);
        $this->setFlash('Migration Complete!');



        /*

        Identify table columns on every DB
        cakephp_member
            -> members
                ->

        */
    }
}
