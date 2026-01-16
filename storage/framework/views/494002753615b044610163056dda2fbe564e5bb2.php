<?php $__env->startSection('content'); ?>
<div class="container">
    <h1>Dodaj recenzję</h1>
    <form action="<?php echo e(route('reviews.store')); ?>" method="POST">
    <?php echo csrf_field(); ?>
    <div class="mb-3">
        <label for="appointment_id" class="form-label">Wybierz wizytę</label>
            <select name="appointment_id" id="appointment_id" class="form-control" required>
        <option value="" disabled selected>-- Wybierz wizytę --</option>
        <?php $__currentLoopData = $appointments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $appointment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <option value="<?php echo e($appointment->id); ?>">
                <?php echo e($appointment->appointment_date); ?> - <?php echo e($appointment->service_name); ?>

            </option>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </select>

    </div>
    <div class="mb-3">
        <label for="rating" class="form-label">Ocena (1-5)</label>
        <input type="number" name="rating" id="rating" class="form-control" min="1" max="5" required>
    </div>
    <div class="mb-3">
        <label for="comment" class="form-label">Komentarz</label>
        <textarea name="comment" id="comment" class="form-control" rows="4"></textarea>
    </div>
    <button type="submit" class="btn btn-primary">Dodaj recenzję</button>
</form>

</div>

<?php if(session('error')): ?>
    <div class="alert alert-danger">
        <?php echo e(session('error')); ?>

    </div>
<?php endif; ?>

<?php if(session('success')): ?>
    <div class="alert alert-success">
        <?php echo e(session('success')); ?>

    </div>
<?php endif; ?>


<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\KosmetycznySalon_21296\resources\views/reviews.blade.php ENDPATH**/ ?>