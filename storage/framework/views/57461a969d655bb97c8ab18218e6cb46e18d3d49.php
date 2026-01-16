<style>
    .dashboard {
        padding: 20px;
        background-color: #fff;
        border-radius: 8px;
        box-shadow: 0 2px 4px rgba(154, 7, 203, 0.1);
    }

    .dashboard h1 {
        color: #333333;
        margin-bottom: 20px;
    }

    .dashboard .stats {
        display: flex;
        justify-content: space-around;
    }

    .dashboard .stats .stat {
        text-align: center;
        padding: 20px;
        border: 1px solid #ddd;
        border-radius: 5px;
        background-color: rgb(255, 0, 0);
    }

    body.dark-mode {
        background-color: #121212;
        color:rgb(0, 0, 0);
    }

    .dark-mode .dashboard {
        background-color: #333333;
                color: #ffffff;
    }

    button {
        margin: 10px;
        padding: 10px 20px;
    }

    .dark-mode button {
        color: #ffffff;
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const toggleButton = document.getElementById('toggle-dark-mode');
        const fontSizeButton = document.getElementById('toggle-font-size');
        const body = document.body;
        const buttons = document.querySelectorAll('button');

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
            if (body.style.fontSize === '200%') {
                body.style.fontSize = '';
                buttons.forEach(button => button.style.fontSize = '');
            } else {
                body.style.fontSize = '200%';
                buttons.forEach(button => button.style.fontSize = '28px');
            }
        });
    });
</script>



<?php $__env->startSection('title', 'Panel Administratora'); ?>

<?php $__env->startSection('content'); ?>
<div class="container">
    <header class="d-flex justify-content-between align-items-center mb-4">
        <h1>Panel Administratora</h1>
        <div>
            <button id="toggle-dark-mode" class="btn btn-primary">Tryb nocny</button>
            <button id="toggle-font-size" class="btn btn-secondary">Zwiększ czcionkę</button>
        </div>
    </header>
    <p>Witaj w panelu administratora!</p>
    <ul>
        <li><a href="<?php echo e(route('admin.appointments')); ?>">Wszystkie wizyty</a></li>
    </ul>

    <a href="<?php echo e(route('admin.add-employee')); ?>" class="btn btn-primary">Dodaj Pracownika</a>
</div>

<table class="table">
    <thead>
        <tr>
            <th>Imię i nazwisko</th>
            <th>Email</th>
            <th>Telefon</th>
            <th>Akcje</th>
        </tr>
    </thead>
    <tbody>
        <?php $__currentLoopData = $employees; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $employee): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <tr>
            <td><?php echo e($employee->name); ?></td>
            <td><?php echo e($employee->email); ?></td>
            <td><?php echo e($employee->phone); ?></td>
            <td>
                <form action="<?php echo e(route('admin.employees.destroy', $employee->id)); ?>" method="POST" style="display:inline;">
                    <?php echo csrf_field(); ?>
                    <?php echo method_field('DELETE'); ?>
                    <button type="submit" class="btn btn-danger btn-sm">Usuń</button>
                </form>
            </td>
        </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </tbody>
</table>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\salonf_ostateczny-main\resources\views/admin/dashboard.blade.php ENDPATH**/ ?>