<?php

$sql = "SELECT * FROM category ORDER BY cat_id ASC";
$query = mysqli_query($connect, $sql);


?>

<nav>
    <div id="menu" class="collapse navbar-collapse">
        <ul>
        <?php while($row = mysqli_fetch_assoc($query)){ ?>
            <li class="menu-item"><a href="index.php?page_layout=category&cat_name=<?php echo $row['cat_name']; ?>&cat_id=<?php echo $row['cat_id']; ?>"><?php echo $row['cat_name']; ?></a></li>  
        <?php } ?>      
        </ul>        
    </div>
</nav>