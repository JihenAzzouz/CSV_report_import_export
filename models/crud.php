<?php
 require_once('data_mapper.php');
 require ('models/expense.php');

//prepare and excute queries with dataMapper instance
 function sqlQuery($sql,$stmt){
    	$s=$stmt->prepareStmt($sql);
    	$stmt->excute($s);
    	return $s;
    }


 function show($sql,$stmt){
		
		$rows= sqlQuery($sql,$stmt)->fetchAll(PDO::FETCH_ASSOC);
		//counter to print data row numbers
		$i=1;
		echo '<table class="table table-striped table-hover">
				<thead>
					<tr>
						<th>Num</th>
						<th>Category</th>
						<th>Total Cost</th>			
					</tr>
				</thead>
				<tbody>';
		foreach ($rows as $row) {
			//create new expense and simply use its getters
			$f = new Expense($row['category'],$row['expenses']);	
			echo "<tr><td>".$i."</td><td>" .$f->getCategory(). "</td><td>" .floatval($f->getExpense())."</td></tr>";
			$i++;
			
		}
        //show the total number of rows |can be used later for pagenation
        echo "</tbody></table>
             <div class='clearfix'>
				<div class='hint-text'>Showing <b>".($i-1)."</b> out of <b>".($i-1)."</b> entries</div>
			</div>";
    
    
	}
	
	
    function export($sql,$stmt){
    	
        header('Content-type: application/excel');
        $filename = 'report.xls';
        header('Content-Disposition: attachment; filename='.$filename);
        // clean output buffer
        ob_end_clean();
        $rows= sqlQuery($sql,$stmt)->fetchAll(PDO::FETCH_ASSOC);   
		$data ='<html xmlns:x="urn:schemas-microsoft-com:office:excel">
                 <head>
                   <xml>
                        <x:ExcelWorkbook>
                            <x:ExcelWorksheets>
                                <x:ExcelWorksheet>
                                    <x:Name>Summary Report Sheet</x:Name>
                                        <x:WorksheetOptions>
                                            <x:Print>
                                            <x:ValidPrinterInfo/>
                                        </x:Print>
                                    </x:WorksheetOptions>
                                </x:ExcelWorksheet>
                            </x:ExcelWorksheets>
                        </x:ExcelWorkbook>
                    </xml>
                </head><body><table>	
           	    <thead>
					<tr>
						<th>Category</th>
						<th>Total Cost</th>			
					</tr>
				</thead>';
        if (count($rows) > 0) {
            foreach ($rows as $row) {
            	$f = new Expense($row['category'],$row['expenses']);
           	    $data.='<tr><td>'.$f->getCategory().'</td><td>'.floatval($f->getExpense()).'</td></tr>';
           	   
            }
       }

    $data.='</table></body></html>';
    echo $data;
    exit;

}
   


?>