
<?php $__env->startSection("title", "Sirkulasi"); ?>
<?php $__env->startSection("header", "Sirkulasi"); ?>


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

    <div class="bottom-data">
        <div class="orders">
            <div class="header">
                <i class='bx bx-receipt'></i>
                <h3>Recent Orders</h3>
                <i class='bx bx-filter'></i>
                <i class='bx bx-search'></i>
            </div>
            <table>
                <thead>
                    <tr>
                        <th>User</th>
                        <th>Order Date</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>
                            <img src="images/profile-1.jpg">
                            <p>John Doe</p>
                        </td>
                        <td>14-08-2023</td>
                        <td><span class="status completed">Completed</span></td>
                    </tr>
                    <tr>
                        <td>
                            <img src="images/profile-1.jpg">
                            <p>John Doe</p>
                        </td>
                        <td>14-08-2023</td>
                        <td><span class="status pending">Pending</span></td>
                    </tr>
                    <tr>
                        <td>
                            <img src="images/profile-1.jpg">
                            <p>John Doe</p>
                        </td>
                        <td>14-08-2023</td>
                        <td><span class="status process">Processing</span></td>
                    </tr>
                </tbody>
            </table>
        </div> 
         <!-- End of Orders-->


    </div> 
<?php $__env->stopSection(); ?>
<?php echo $__env->make("layout.app", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\perpustakaan-master\resources\views/sirkulasi/sirkulasi.blade.php ENDPATH**/ ?>