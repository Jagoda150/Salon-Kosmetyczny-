<?php $__env->startSection('title', 'Twoje Wizyty'); ?>

<?php $__env->startSection('content'); ?>
    <div class="container">
        <h1>Twoje Wizyty</h1>
        <?php if(session('success')): ?>
            <div class="alert alert-success">
                <?php echo e(session('success')); ?>

            </div>
        <?php endif; ?>
        <?php if($appointments->isEmpty()): ?>
            <p>Brak zaplanowanych wizyt.</p>
        <?php else: ?>
            <table class="table">
                <thead>
                    <tr>
                        <th>Data</th>
                        <th>Godzina</th>
                        <th>Usługa</th>
                        <th>Klient</th>
                        <th>Akcje</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__currentLoopData = $appointments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $appointment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td><?php echo e(\Carbon\Carbon::parse($appointment->appointment_date)->format('Y-m-d')); ?></td>
                            <td><?php echo e(\Carbon\Carbon::parse($appointment->appointment_date)->format('H:i')); ?></td>
                            <td><?php echo e($appointment->service->name); ?></td>
                            <td><?php echo e($appointment->user->name); ?></td>
                            <td>
                                <form action="<?php echo e(route('employee.appointments.destroy', $appointment->id)); ?>" method="POST" onsubmit="return confirm('Czy na pewno chcesz usunąć tę wizytę?');">
                                    <?php echo csrf_field(); ?>
                                    <?php echo method_field('DELETE'); ?>
                                    <button type="submit" class="btn btn-danger btn-sm">Usuń</button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
            </table>
        <?php endif; ?>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\KosmetycznySalon_21296\resources\views/employee/appointments/index.blade.php ENDPATH**/ ?>