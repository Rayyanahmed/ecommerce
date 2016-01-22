<div class="col-md-3">
    <p class="lead">Shop Name</p>
    <div class="list-group">
    	<?php
    		$query = "SELECT * FROM categories";
    		$send_query = mysqli_query($connection, $query);

    		while ($row = mysqli_fetch_assoc($send_query)) {
    			 echo "<a href='#' class='list-group-item'>" . $row['cat_title'] . "</a>";
    		}

    	 ?>
    </div>
</div>