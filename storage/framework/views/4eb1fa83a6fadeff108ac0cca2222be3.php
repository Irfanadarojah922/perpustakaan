
<?php $__env->startSection("title", "Keanggotaan"); ?>
<?php $__env->startSection("header", "Keanggotaan"); ?>


<?php $__env->startPush("css-libs"); ?>
    <style>
    </style>
<?php $__env->stopPush(); ?>    
<?php $__env->startSection("content"); ?>

<div class="header">
    <div class="left">
        <h1> <?php echo $__env->yieldContent("header"); ?> </h1>
        <ul class="breadcrumb">
            <li><a href="#">
                    Dashboard
                </a></li>
            /
            
        </ul>
    </div>
    <a href="#" class="report">
        <i class='bx bx-cloud-download'></i>
        <span>Download CSV</span>
    </a>
</div>  



 


    

        

    </div> 
<?php $__env->stopSection(); ?>
<?php echo $__env->make("layout.app", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\perpustakaan-master\resources\views/keanggotaan/keanggotaan.blade.php ENDPATH**/ ?>