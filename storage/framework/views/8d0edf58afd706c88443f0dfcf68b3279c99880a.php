<?php $__env->startSection('title', 'Dni wolne'); ?>

<?php $__env->startSection('content'); ?>
<div class="container mt-4">
    <h1>Zarządzanie dniami wolnymi</h1>

    <form action="<?php echo e(route('admin.holidays.store')); ?>" method="POST" class="mb-4">
        <?php echo csrf_field(); ?>
        <div class="mb-3">
            <label for="holiday_date" class="form-label">Data</label>
            <input type="date" id="holiday_date" name="holiday_date" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="description" class="form-label">Opis</label>
            <input type="text" id="description" name="description" class="form-control">
        </div>
        <button type="submit" class="btn btn-primary">Dodaj dzień wolny</button>
    </form>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Data</th>
                <th>Opis</th>
                <th>Akcje</th>
            </tr>
        </thead>
        <tbody>
            <?php $__currentLoopData = $holidays; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $holiday): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr>
                <td><?php echo e($holiday->id); ?></td>
                <td><?php echo e($holiday->holiday_date); ?></td>
                <td><?php echo e($holiday->description); ?></td>
                <td>
                    <form action="<?php echo e(route('admin.holidays.destroy', $holiday->id)); ?>" method="POST" onsubmit="return confirm('Czy na pewno chcesz usunąć ten dzień wolny?');">
                        <?php echo csrf_field(); ?>
                        <?php echo method_field('DELETE'); ?>
                        <button type="submit" class="btn btn-danger btn-sm">Usuń</button>
                    </form>
                </td>
            </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </tbody>
    </table>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\salonf_ostateczny-main\resources\views/admin/holidays/index.blade.php ENDPATH**/ ?>