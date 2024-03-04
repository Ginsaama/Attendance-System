<?php $__env->startSection('content'); ?>
    <form id="employeeForm" class="mb-4">
        <?php echo csrf_field(); ?>
        <div class="mb-3">
            <label for="employeeSelect" class="form-label mt-5">Select Employee:</label>
            <select name="employee_id" id="employeeSelect" class="form-select">
                <option value="" selected disabled>Select your Employee</option>
                <?php $__currentLoopData = $employees; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $employee): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($employee->id); ?>"><?php echo e($employee->name); ?></option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
        </div>
        <div class="d-flex">
            <button type="button" id="submitForm" class="btn btn-primary mr-5">Submit</button>
            <button type="button" class="btn btn-primary ml-4" id="pdf" style="margin-left: 15px;">PDF</button>
        </div>

    </form>

    <div id="employeeDetails"></div>
    <script>
        $(document).ready(function() {
            var selectedEmployee;
            // AJAX request when the form is submitted
            $('#submitForm').click(function() {
                var selectedEmployee = $('#employeeSelect').val();
                $.ajax({
                    type: 'GET',
                    url: '/employee/' + selectedEmployee,
                    success: function(data) {
                        $('#employeeDetails').html(data);
                    },
                    error: function(error) {
                        console.error('Error fetching employee details:', error);
                    }
                });
            });
            // PDF Stuff
            $("#pdf").click(function() {
                console.log('Clicked')
                var selectedEmployee = $('#employeeSelect').val();
                if (!selectedEmployee) {
                    alert('Please select an employee before generating the PDF.');
                    return;
                }
                var url = '/employee/pdf/' + selectedEmployee;
                window.open(url, '_blank');
            });

        });
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/comargo/Desktop/Laravel/attendance_tracker/resources/views/Employees.blade.php ENDPATH**/ ?>