<?php if($paginator->hasPages()): ?>
    <nav>
        <ul class="pagination">
            
            <?php if($paginator->onFirstPage()): ?>
                <a href="<?php echo e($paginator->previousPageUrl()); ?>"><button type="button" class="btn btn-default btn-sm prev">
                        <i class="fas fa-chevron-left"></i>
                    </button></a>
            <?php else: ?>
                <a href="<?php echo e($paginator->previousPageUrl()); ?>"><button type="button" class="btn btn-default btn-sm prev">
                    <i class="fas fa-chevron-left"></i>
                </button></a>
            <?php endif; ?>

            

            
            <?php if($paginator->hasMorePages()): ?>
                <a href="<?php echo e($paginator->nextPageUrl()); ?>"><button type="button" class="btn btn-default btn-sm next">
                    <i class="fas fa-chevron-right"></i>
                </button></a>
            <?php else: ?>
                <a href="<?php echo e($paginator->nextPageUrl()); ?>"><button type="button" class="btn btn-default btn-sm next">
                        <i class="fas fa-chevron-right"></i>
                    </button></a>
            <?php endif; ?>
        </ul>
    </nav>
<?php endif; ?>
<?php /**PATH /var/www/html/resources/views/vendor/pagination/bootstrap-4.blade.php ENDPATH**/ ?>