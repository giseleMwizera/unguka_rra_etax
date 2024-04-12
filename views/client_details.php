<?php

?>
<html>

<?php
$requestId = $_GET[ 'requestId' ];

global $db_mysql;
$query = "SELECT * FROM etaxpayers e JOIN currency c ON e.Currency = c.CurrencyID where RequestId = '".$requestId."';";
$result = mysqli_query( $db_mysql, $query );

if ( mysqli_num_rows( $result ) > 0 ) {
    while ( $row = mysqli_fetch_array( $result ) ) {
        ?>
        <tag class="header" />
        <div class = 'bg-white' style = 'width: 35rem; padding: 20px;'>
            <div class = 'card-body'>
                <div class="d-flex">
                    <div class="p-2">
                        <h4 class ='card-title font-weight-bold mb-4'> User Details</h4>
                    </div>
                    <div class="ml-auto p-2">
                        <div style="width: 50px; height: 50px;">
                            <?xml version="1.0" encoding="UTF-8"?>
                            <svg xmlns="http://www.w3.org/2000/svg" id="Layer_1" data-name="Layer 1" viewBox="0 0 24 24">
                            <path d="m17.046,10.153c.191.198.186.515-.014.707l-4.58,4.414c-.483.483-1.12.726-1.759.726s-1.282-.244-1.771-.732l-1.932-1.795c-.202-.188-.214-.505-.025-.707.188-.201.505-.213.707-.025l1.944,1.808c.597.599,1.55.598,2.135.013l4.587-4.421c.198-.189.515-.187.707.014Zm4.954-5.653c0,.276-.224.5-.5.5h-1.501l-.025,14.501c0,2.48-2.019,4.499-4.5,4.499h-7c-2.481,0-4.5-2.019-4.5-4.5l.025-14.5h-1.499c-.276,0-.5-.224-.5-.5s.224-.5.5-.5h4.028c.25-2.247,2.16-4,4.472-4h2c2.312,0,4.223,1.753,4.472,4h4.028c.276,0,.5.224.5.5Zm-14.464-.5h8.928c-.243-1.694-1.704-3-3.464-3h-2c-1.76,0-3.221,1.306-3.464,3Zm11.463,1H4.999l-.025,14.501c0,1.929,1.57,3.499,3.5,3.499h7c1.93,0,3.5-1.57,3.5-3.5l.025-14.5Z"/>
                            </svg>

                        </div>

                    </div>
                </div>
                <div class ='card-text mb-3'><div class="w-25 d-inline-block text-secondary">Tin:</div><div class="d-inline-block"><?= $row['Tin']?></div></div>
                <div class ='card-text mb-3'><div class="w-25 d-inline-block text-secondary">Names:</div><div class="d-inline-block"><?= $row['Names']?></div></div>
                <div class ='card-text mb-3'><div class="w-25 d-inline-block text-secondary">Account:</div><div class="d-inline-block"><?= $row['Account']?></div></div>
                <div class ='card-text mb-3'><div class="w-25 d-inline-block text-secondary">Telephone:</div><div class="d-inline-block"><?= $row['Phone']?></div></div>
                <div class ='card-text mb-3'><div class="w-25 d-inline-block text-secondary">Nid:</div><div class="d-inline-block"><?= $row['Nid']?></div></div>
                <div class ='card-text mb-3'><div class="w-25 d-inline-block text-secondary">Email:</div><div class="d-inline-block"><?= $row['Email']?></div></div>
                <div class ='card-text mb-3'><div class="w-25 d-inline-block text-secondary">Originator:</div><div class="d-inline-block"><?= $row['originator']?></div></div>
                <div class ='card-text mb-3'><div class="w-25 d-inline-block text-secondary">Currency:</div><div class="d-inline-block"><?= $row['Description']?></div></div>
            </div>
        </div>

        <?php
    }
} else {
    ?>
        <p>User not found</p>
    <?php
}

?>


</html>