<?php $__env->startSection('title', 'Panel Pracownika'); ?>

<?php $__env->startSection('content'); ?>
    <div class="container">
        <h1>Panel Pracownika</h1>
        <p>Witaj, <?php echo e($employee->name); ?>!</p>
        <a href="<?php echo e(route('employee.appointments')); ?>" class="btn btn-primary">Zobacz swoje wizyty</a>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\salonf_ostateczny-main\resources\views/employee/dashboard.blade.php ENDPATH**/ ?>