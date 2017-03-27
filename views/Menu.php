<?php foreach ($Menu as $value) { ?>

    <?php if (count($value['subs'])) { ?>
        <li class="sub-menu">
            <a href="<?php echo $value['url'] ?>" data-ma-action="submenu-toggle"><i class="<?php echo $value['class_icon'] ?>"></i> <?php echo $value['nama'] ?></a>
            <ul>
                <?php RenderChild($value['subs']); ?>
            </ul>
        </li>
    <?php } else { ?>
        <li class="">
            <a href="<?php echo $value['url'] ?>" ><i class="<?php echo $value['class_icon'] ?>"></i> <?php echo $value['nama'] ?></a>
        </li>
    <?php } ?>


<?php } ?>
<?php

function RenderChild($child) {
    foreach ($child as $value) {
        ?>
        <?php if (count($value['subs'])) { ?>
            <li class="sub-menu">
                <a href="<?php echo $value['url'] ?>" data-ma-action="submenu-toggle"><i class="<?php echo $value['class_icon'] ?>"></i> <?php echo $value['nama'] ?></a>
                <ul>
                    <?php RenderChild($value['subs']); ?>
                </ul>
            </li>
        <?php } else { ?>
            <li class="">
                <a href="<?php echo $value['url'] ?>" ><i class="<?php echo $value['class_icon'] ?>"></i> <?php echo $value['nama'] ?></a>
            </li>
        <?php } ?>
        <?php
    }
}
?>
