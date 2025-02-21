<?php 
	ini_set('display_errors', 1);
	error_reporting(E_ALL);

	function log_error(Exception $e)
	{
        echo "
            <div style='width: 350px; background-color: #ff3741; z-index: 100; border-radius: 10px; border: 1px solid black; margin-top: 10px; position: absolute; right: 0; top: 0; font-size: 9pt; font-family: Arial; align-self: flex-start; cursor: pointer;' onclick='navigator.clipboard.writeText('".$e->getMessage()."');'>
                <!-- Header -->
        		<ul style='display: flex; flex-direction: row; justify-content: space-between; list-style: none; padding: 10px; height: 20px; background-color: #ff555d; margin-top: 0; border-radius: 10px 10px 0 0; border-bottom: 1px solid black; font-weight: bold; align-items: center;'> 
        			<li>".$e->getFile()."</li> <!-- PHP file -->
        			<li>Line: ".$e->getLine()."</li> <!-- PHP line -->
        		</ul>
        		<!-- Message -->
        		<div style='padding: 0 10px;' >
        			<p>".$e->getMessage()."</p>
        		</div>
        	</div>
        ";
	}

    register_shutdown_function(function() {
        $error = error_get_last();
        if ($error) {
            echo "
                <div style='width: 350px; background-color: #ff3741; z-index: 100; border-radius: 10px; border: 1px solid black; margin-top: 10px; position: absolute; right: 0; top: 0; font-size: 9pt; font-family: Arial; align-self: flex-start; cursor: pointer;' onclick='navigator.clipboard.writeText('".$error["message"]."');'>
                    <!-- Header -->
                    <ul style='display: flex; flex-direction: row; justify-content: space-between; list-style: none; padding: 10px; height: 20px; background-color: #ff555d; margin-top: 0; border-radius: 10px 10px 0 0; border-bottom: 1px solid black; font-weight: bold;  align-items: center;''> 
                        <li>".$error["file"]."</li> <!-- PHP file -->
                        <li>Line: ".$error["line"]."</li> <!-- PHP line -->
                    </ul>
                    <!-- Message -->
                    <div style='padding: 0 10px;' >
                        <p>".$error["message"]."</p>
                    </div>
                </div>
            ";
		}
	});
 ?>