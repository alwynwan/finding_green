<?php 
    if ($activePage != 'Search') {
        echo('<li><a class="nav-link" href="search.php">Search</a></li>');
    }
        
    else {
        echo('<li><a class="nav-link active" href="search.php">Search</a></li>');
    }

    
    if($activePage != 'Categories') {
        echo('<li><a class="nav-link" href="categories.php">Categories</a></li>');
    }
    else {
        echo('<li><a class="nav-link active" href="categories.php">Categories</a></li>');
    }


    if($activePage != 'Discover') {
        echo('<li><a class="nav-link" href="discover.php">Discover</a></li>');
    }
    else {
        echo('<li><a class="nav-link active" href="discover.php">Discover</a></li>');
    }

?>