<div class="col-md-12 text-center">
    <?php if($prevPage>0 && $number_of_page>2):?>   
    <a href="?page=<?=$prevPage?>" class="btn btn-outline-dark"><</a>
    <?php endif;?>   
<?php for($i = 1 ;$i<=$number_of_page;$i++):?>
    <a class="btn <?= $page == $i ? "btn-dark" : "btn-outline-dark" ?>" href="?page=<?=$i?>"><?=$i?></a>
<?php endfor;?>
<?php if($nextPage<=$number_of_page && $number_of_page>2):?>   
    <a href="?page=<?=$nextPage?>" class="btn btn-outline-dark">></a>
    <?php endif;?>
</div>