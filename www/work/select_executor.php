<?php 
	$query = "SELECT * FROM executor";
	$res = mysql_query($query);
	while($row = mysql_fetch_array($res)) {
		$title = $row['title'];
		echo '<option>'.$title.'</option>';		
	};
			
?>