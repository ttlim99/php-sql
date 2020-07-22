<?php

require('../mysqli_connect.php'); 
$q = "SELECT CONCAT(first_name, ' ', last_name) AS name from people ORDER BY last_name";

$r = @mysqli_query($dbc, $q); 

if ($r) {
    echo '<table align="left" cellspacing="1" cellpadding="3" width="100%">
        <tr><td align="left"><b>Name</b></td>
    ';

    while ($row = mysqli_fetch_array($r, MYSQLI_ASSOC)) {
        echo '<tr><td align="left">' . $row['name'] . '</td></tr>';
    }
    
    echo '</table>';
    
    mysqli_free_result($r);
} else {
    echo mysqli_error($dbc);
}





?>