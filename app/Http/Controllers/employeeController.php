<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Employee;
use App\card;

use File;

use DB;

class employeeController extends Controller
{
    /**
     * Display a listing of the employee resources.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
    	$res = [];
    	foreach(Employee::all() as $employee) {
    		//echo $employee;
    		//$employee->{"card_numbers"} = $employee->card();
    		//echo 
    		$oneEmployee = [];
    		$oneEmployee = (object)$oneEmployee;
    		$oneEmployee->employee_number = $employee->employee_number;
    		$oneEmployee->employee_name = $employee->employee_name;
    		$oneEmployee->gender = $employee->gender;
    		$cardsOneemployee = [];
    		foreach($employee->card as $cardnum) {
    			array_push($cardsOneemployee,$cardnum->cardNumber); 
    		}
    		$oneEmployee->card_numbers = $cardsOneemployee;
    		array_push($res, $oneEmployee);
    	}
    	return $res;
    }

    /**
     * Store a listing of the employee resources.
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function batchAdd(Request $request)
    {
        $contents = File::get($request -> file('file'));
        $cards = $this->csvToJson($contents);
        DB::beginTransaction();
        
        try{
            foreach($cards as $card){
	            $employeeName = $card->employeeName;
	         	$employeeNumber = $card->employeeNumber;
	            $gender = $card->gender;
	            $cardNumber = $card->cardNumber;
	 			if(Employee::where("employee_number",$employeeNumber)->count()==0){
	                $employee = new Employee;
	                $employee->employee_number = $employeeNumber;
	                $employee->employee_name = $employeeName;
	                $employee->gender = $gender;
	                $employee->save();
	            }else{
	            	$employee = Employee::where("employee_number",$employeeNumber)->first();
	            }
	            $card = new card;
	            $card->cardNumber = $cardNumber;
	            $card->Employee_id = $employee->id;
	            $card->save();

	            DB::commit();
        	}
        } catch (\Exception $e){
        	DB::rollback();
        	return response()->json(["status" => "Error: Data in your CSV file and/or database have conflicts"]);
        }
        return response()->json(["status" => "succeed"]);

    }

    private function csvToJson($allText) {
        //split content based on new line
        $allTextLines = explode(PHP_EOL, $allText);
        $header = explode(',',$allTextLines[0]);
        $lines = [];
        
        for($i = 1; $i < sizeof($allTextLines); $i++) {
            //split content based on comma
            $data = explode(',', $allTextLines[$i]);
            if(sizeof($data) == sizeof($header)) {
                $temp = [];
                for($j = 0; $j<sizeof($header);$j++) {
                    $temp[$header[$j]] = $data[$j];
                }
                array_push($lines, (object)$temp);
            }
        }
        return $lines;
    }
}
