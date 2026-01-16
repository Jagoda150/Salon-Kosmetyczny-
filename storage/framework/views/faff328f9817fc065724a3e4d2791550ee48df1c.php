<?php $__env->startSection('title', 'Wszystkie Wizyty'); ?>

<?php $__env->startSection('content'); ?>
<div class="container">
    <h1>Wszystkie Wizyty</h1>
    <?php if(session('success')): ?>
        <div class="alert alert-success">
            <?php echo e(session('success')); ?>

        </div>
    <?php endif; ?>
    <?php if($appointments->isEmpty()): ?>
        <p>Brak wizyt do wyświetlenia.</p>
    <?php else: ?>
        <table class="table">
            <thead>
                <tr>
                    <th>Data</th>
                    <th>Godzina</th>
                    <th>Klient</th>
                    <th>Usługa</th>
                    <th>Pracownik</th>
                    <th>Akcje</th>
                </tr>
            </thead>
            <tbody>
                <?php $__currentLoopData = $appointments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $appointment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td><?php echo e(\Carbon\Carbon::parse($appointment->appointment_date)->format('Y-m-d')); ?></td>
                        <td><?php echo e(\Carbon\Carbon::parse($appointment->appointment_date)->format('H:i')); ?></td>
                        <td><?php echo e($appointment->client->name); ?></td>
                        <td><?php echo e($appointment->service->name); ?></td>
                        <td><?php echo e($appointment->employee->name); ?></td>
                        <td>
                            <form action="<?php echo e(route('appointments.destroy', $appointment->id)); ?>" method="POST" style="display: inline;">
                                <?php echo csrf_field(); ?>
                                <?php echo method_field('DELETE'); ?>
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Czy na pewno chcesz usunąć tę wizytę?')">Usuń</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
        </table>
    <?php endif; ?>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\salonf_ostateczny-main\resources\views/admin/appointments/index.blade.php ENDPATH**/ ?>