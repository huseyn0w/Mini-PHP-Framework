<?php defined('EXTERNAL_ACCESS') or die('EXTERNAL ACCESS DENIED!'); 

$totalPageCount = $data['totalPageCount'];
$activePage = $data['activePage'];

?>

<nav aria-label="...">
  <ul class="pagination justify-content-center">
    <?php if($activePage > 1): ?>
    <li class="page-item">
      <a class="page-link" href="<?php echo HOME_DIR ?>/tasks/page/<?php echo $activePage - 1 ?>" tabindex="-1">Previous</a>
    </li>
  <?php endif; ?>
  <?php for($i = 1; $i<=$totalPageCount; $i++):
    $activeClass = '';
    if($i == $activePage): ?>
    <li class="page-item active">
      <span class="page-link"><?php echo $i ?> <span class="sr-only">(current)</span></span>
    </li>
    <?php else: ?>
    <li class="page-item">
      <a class="page-link" href="<?php echo HOME_DIR ?>/tasks/page/<?php echo $i ?>"><?php echo $i ?></a>
    </li>
    <?php endif; ?>
    
  <?php endfor; ?>
  <?php if($activePage < $totalPageCount): ?>
    <li class="page-item">
      <a class="page-link" href="<?php echo HOME_DIR ?>/tasks/page/<?php echo $activePage+1 ?>">Next</a>
    </li>
  <?php endif; ?>
  </ul>
</nav>


