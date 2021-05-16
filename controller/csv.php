<?php

	include("src/functions.php");
	require("models/data_mapper.php");
    require("models/crud.php");
	//importing the file and insering its data in the database 
    function import($file,$stmt)
    {
        //clear previous files in temp file to make sure we have nothing linked in our http
        clearFiles();
       //check the extension of our file if its .txt or .csv to be accepted 
        
        if (checkExt($file)){
            if (($handle = fopen($file, "r")) !== FALSE) {  
            	//we need to clear previous data in our table from other previous reports
                sqlQuery("TRUNCATE TABLE expense",$stmt); 	     
                while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
                    $value ="'". implode("','", $data)."'" ;	
                    //then we insert our data by row
                    sqlQuery("INSERT INTO expense(category,price,amount) VALUES (".$value.")",$stmt); 
               }
            }

        fclose($handle);
        // import data from our database and print it in a html table
        show("SELECT category, price*amount AS expenses FROM expense GROUP BY category",$stmt); 

        }
        else   
         {
            echo '<div class="alert">
               <span class="closebtn" id="close" onclick="this.parentNode.parentNode.removeChild(this.parentNode); return false;">X</span>
               <strong>Danger!</strong> Check your entered file ! only CSV or TXT files are accepted.</div>';
            echo "<script>var closebtn = document.getElementsByClassName('closebtn');closebtn.addEventListener('click',function(){this.parentElement.style.display = 'none';});</script>";
            
        }
    }
 
    
    
   function export_report($stmt,$file){ 
  
            export("SELECT category, price*amount AS expenses FROM expense GROUP BY category",$stmt);
   
   }
      

?>


