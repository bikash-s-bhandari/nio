<div id="main">
    <ol class="breadcrumb">
        <?php
        foreach ($breadcum as $key => $value):
            if ($value == ''):
                echo '<li class="active">' . ucfirst($key) . '</li>';
            else:
                echo '<li><a href="' . base_url() . 'admin/' . $value . '">' . ucfirst($key) . '</a></li>';
            endif;

        endforeach;
        ?>

    </ol>

</div>

