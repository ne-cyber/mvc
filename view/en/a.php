<form action="" method="post">
    <table>

        <tr> <td>email:</td> <td> <input type="email" name="email"> </td></tr>
        <tr> <td>Имя пользователя:</td> <td><input type="text" name="name"> </td></tr>
        <tr> <td> Адрес пользователя:</td> <td> <input type="text" name="adress"> </td></tr>
        <tr> <td> Телефон:</td> <td><input type="text" name="telefon"> </td></tr>
        <tr> <td> Комментарии:</td> <td><input type="text" name="coment"></td></tr>
        <tr> <td> Отдел:</td>  <td> <select name = 'otdl'>


                    <?php
                    foreach ($data['otdeli'] as $row)
                        echo "<option value='".$row['id']."'>".$row['otdel']."</option>";
                    ?>
                </select>
            </td></tr>

    </table>

    <input type="submit" name="doGo" value="сохранить">
</form>