<script>
    document.addEventListener('DOMContentLoaded', function () {
        const toggleButton = document.getElementById('toggle-dark-mode');
        const fontSizeButton = document.getElementById('toggle-font-size');
        const body = document.body;
        const buttons = document.querySelectorAll('button, a.btn');
        if (localStorage.getItem('darkMode') === 'enabled') {
            body.classList.add('dark-mode');
        }

        toggleButton.addEventListener('click', function () {
            if (body.classList.contains('dark-mode')) {
                body.classList.remove('dark-mode');
                localStorage.setItem('darkMode', 'disabled');
            } else {
                body.classList.add('dark-mode');
                localStorage.setItem('darkMode', 'enabled');
            }
        });

        fontSizeButton.addEventListener('click', function () {
            const tableHeaders = document.querySelectorAll('th');
            const tableData = document.querySelectorAll('td');
            const headings = document.querySelectorAll('h1');
            const table = document.querySelector('table');
            if (body.style.fontSize === '200%') {
                body.style.fontSize = '';
                buttons.forEach(button => button.style.fontSize = '');
                tableHeaders.forEach(th => th.style.fontSize = '');
                tableData.forEach(td => td.style.fontSize = '');
                headings.forEach(h1 => h1.style.fontSize = '');
                if (table) table.style.fontSize = '';
            } else {
                body.style.fontSize = '200%';
                buttons.forEach(button => button.style.fontSize = '28px');
                tableHeaders.forEach(th => th.style.fontSize = '150%');
                tableData.forEach(td => td.style.fontSize = '150%');
                headings.forEach(h1 => h1.style.fontSize = '150%');
            }
        });
    });
</script>

<style>
body.dark-mode {
        background-color: #121212;
        color:rgb(0, 0, 0);
    }

    .dark-mode .dashboard {
        background-color: #333333;
    }

    .dark-mode button {
        background-color:rgb(255, 93, 93);
        color: #fff;
    }
    
</style>

<?php $__env->startSection('title', 'Twoje Wizyty'); ?>

<?php $__env->startSection('content'); ?>
<div class="position-fixed bottom-0 end-0 m-3">
    <button id="toggle-dark-mode" class="btn btn-primary mb-2">Tryb nocny</button>
    <button id="toggle-font-size" class="btn btn-secondary">Zwiększ czcionkę</button>
</div>

<div class="container">
    <h1>Twoje Wizyty</h1>
    
    <div class="mb-3">
        <a href="<?php echo e(route('client.appointments.create')); ?>" class="btn btn-primary">Zarezerwuj wizytę</a>
    </div>

    <?php if($appointments->isEmpty()): ?>
        <p>Nie masz zaplanowanych wizyt.</p>
    <?php else: ?>
        <table class="table">
            <thead>
                <tr>
                    <th>Data</th>
                    <th>Godzina</th>
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
                        <td><?php echo e($appointment->service->name); ?></td>
                        <td><?php echo e($appointment->employee ? $appointment->employee->name : 'Nie przypisano pracownika'); ?></td>
                        <td>
                            <form action="<?php echo e(route('client.appointments.destroy', $appointment->id)); ?>" method="POST" onsubmit="return confirm('Czy na pewno chcesz usunąć tę wizytę?');">
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

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\salonf_ostateczny-main\resources\views/client/appointments/index.blade.php ENDPATH**/ ?>