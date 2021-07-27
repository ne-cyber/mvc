<h1>Отдел:</h1>
<form action='' method = 'post'>
<input type='text' name='otdl'>
<button name='' type='submit'>Сохранить</button>
<input type = hidden name='action' value='add'>
</form>


<table>

    <?php

    foreach ($data['otdeli'] as $row)
    {
    ?>
        <tr>
        <form action="" method = 'post'>
            <td> <?php echo $row['otdel'] ?> </td>
            <td>
            <button name='id' type='submit' value= <?php echo $row['id'] ?>  >удл</button>
            </td>
            <input type = hidden name='action' value='delete'>
            </form>

        </tr>
    <?php
    }
    ?>
</table>