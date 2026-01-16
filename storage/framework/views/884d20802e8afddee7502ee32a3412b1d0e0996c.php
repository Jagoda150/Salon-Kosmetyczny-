<?php $__env->startSection('title', 'Panel Administratora - recenzje'); ?>

<!-- Bootstrap CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<!-- Bootstrap JS Bundle -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<?php $__env->startSection('content'); ?>

<!-- Tabela recenzji -->
<div class="container mt-4">
    <table class="table table-bordered">
        <head>
            <tr>
                <th>ID</th>
                <th>Użytkownik</th>
                <th>Usługa</th>
                <th>Data wizyty</th>
                <th>Ocena</th>
                <th>Komentarz</th>
                <th>Dodano</th>
                <th>Akcje</th>
            </tr>
        </head>
        <body>
            <?php $__currentLoopData = $reviews; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $review): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr>
                <td><?php echo e($review->id); ?></td>
                <td><?php echo e($review->user_name); ?></td>
                <td><?php echo e($review->service_name); ?></td>
                <td><?php echo e($review->appointment_date); ?></td>
                <td><?php echo e($review->rating); ?></td>
                <td><?php echo e($review->comment); ?></td>
                <td><?php echo e($review->created_at); ?></td>
                <td>
                    <form action="<?php echo e(route('admin.reviews.destroy', $review->id)); ?>" method="POST" onsubmit="return confirm('Czy na pewno chcesz usunąć tę recenzję?');">
                        <?php echo csrf_field(); ?>
                        <?php echo method_field('DELETE'); ?>
                        <button type="submit" class="btn btn-danger">Usuń</button>
                    </form>
                </td>
            </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </body>
    </table>
</div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\KosmetycznySalon_21296\resources\views/admin/reviews/index.blade.php ENDPATH**/ ?>