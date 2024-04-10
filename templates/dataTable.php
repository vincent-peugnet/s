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
            <?php foreach ($data as $key => $value) { ?>
                <?php
                    if ($key === 'effet' && !empty($value)) {
                        $class = 'effet ' . implode(' ', explode('/', strtolower($value)));
                    } else {
                        $class = '';
                    }
                ?>
                <td class="<?= $class ?>">
                    <?= $value ?>
                </td>
            <?php } ?>
        </tr>
    </tbody>
</table>
