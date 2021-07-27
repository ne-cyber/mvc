<table>
    <tr>
        <th>id</th>
        <th>name</th>
    </tr>

    <?php foreach($data['data'] as $v)
            echo "<tr> <th>" . $v['idName'] . "</th> <th> ". $v['vcName'] ."</th></tr>";

     ?>
</table>

<?php


?>