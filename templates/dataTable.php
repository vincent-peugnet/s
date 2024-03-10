<table>
    <thead>
        <tr>
            <?php foreach ($data as $key => $value) { ?>
                <th>
                    <?= $key ?>
                </th>
            <?php } ?>
        </tr>
    </thead>
    <tbody>
        <tr>
            <?php foreach ($data as $value) { ?>
                <td>
                    <?= $value ?>
                </td>
            <?php } ?>
        </tr>
    </tbody>
</table>
