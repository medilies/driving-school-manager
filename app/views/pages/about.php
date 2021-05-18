<?php ob_start();?>

<div id="about">

    <div id="cover" class="mb1"></div>
    <div class="p1" id="flex1">

        <iframe width="560" height="315" src="https://www.youtube.com/embed/mXYSyxBlszE" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>

        <div id="text">
            Lorem ipsum dolor sit amet consectetur adipisicing elit. Minus fuga laboriosam,cupiditate est, dicta quo culpa ex maiores sapiente, nisi expedita reiciendis nostrum ipsam unde repellat quasi eligendi incidunt necessitatibus? Lorem ipsum dolor sit amet consectetur adipisicing elit. Minus fuga laboriosam,cupiditate est, dicta quo culpa ex maiores sapiente, nisi expedita reiciendis nostrum ipsam unde repellat quasi eligendi incidunt necessitatibus? Lorem ipsum dolor sit amet consectetur adipisicing elit. Minus fuga laboriosam,cupiditate est, dicta quo culpa ex maiores sapiente, nisi expedita reiciendis nostrum ipsam unde repellat quasi eligendi incidunt necessitatibus?
        </div>
    </div>
</div>

<?php $content = ob_get_clean();?>
<?php require_once PROJECT_ROOT . '/app/views/inc/layout.php';?>
