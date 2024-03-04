<?php $__env->startSection('content'); ?>
    
    <h1 class="mt-2">Absent Module</h1>

    
    <form action="<?php echo e(route('Absent.update')); ?>" method="POST" enctype="multipart/form-data" id="form2">
        <?php echo csrf_field(); ?>
        <div class="main-container mt-5">
            <table class="table table-borderless table align-middle table-responsive">
                <thead>
                    <th class="w-25">Merchandiser</th>
                    <th>Name</th>
                    <th class="w-25">Date</th>
                    <th>Remarks</th>
                </thead>
                <tbody>
                    <?php $__currentLoopData = $absents; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $absentMerchandiser): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td><?php echo e($absentMerchandiser->call_sign); ?>

                                <input type="hidden" name="merchandisers_id[]"
                                    value="<?php echo e($absentMerchandiser->merchandisers_id); ?>">
                            </td>
                            <td><?php echo e($absentMerchandiser->name); ?></td>
                            <td><span class="date-column"> <?php echo e($absentMerchandiser->date); ?>

                                </span>
                                <input type="hidden" name="schedule_dates[]" value="<?php echo e($absentMerchandiser->date); ?>">
                            </td>
                            <td>
                                <div class="input-group">
                                    <input type="text" class="form-control remarks" name="absent-offset[]"
                                        style="width: 25rem;" list="input" id="Input">
                                    <datalist id="input">
                                        <option value="With Excuse">
                                        <option value="Without Excuse">
                                        <option value="Offset">
                                    </datalist>
                                    <input type="date" class="form-control date-input"
                                        style="width: 25rem; display: none;" id="">
                                </div>
                            </td>
                            
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php if($absents->isEmpty()): ?>
                        <tr>
                            <td colspan="4">No absent merchandisers found.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
            <button type="submit" class="btn btn-primary mt-2" id="button">Submit</button>
        </div>
    </form>
    <div id="loadingOverlay" class="loading-overlay" style="display: none;">
        <div class="loading-spinner"></div>
    </div>


    <script>
        $(document).ready(function() {
            // Assuming you have included the jQuery library
            $('.date-column').each(function() {
                var dateString = $(this).text();
                var formattedDate = new Date(dateString).toLocaleDateString('en-US', {
                    month: 'long',
                    day: 'numeric',
                    year: 'numeric'
                });
                $(this).text(formattedDate);
            });

            $('.remarks').on('input', function() {
                // Get the selected option value
                var selectedOption = $(this).val();

                // Toggle the visibility of the date input based on the selected option
                var dateInput = $(this).closest('.input-group').find('.date-input');
                if (selectedOption === 'Offset') {
                    dateInput.show();
                    $('.date-input').on('change', function() {
                        // Get the selected date value
                        var selectedDate = $(this).val();
                        // Update the corresponding text input value in the input-group
                        $(this).closest('.input-group').find('.remarks').val(selectedOption +
                            " at " + selectedDate);
                        dateInput.hide();
                    });
                } else {
                    dateInput.hide();
                }
            });
            // Use this in case I dont want to use form in Laravel
            // $(".assign-button").click(function(e) {
            //     var $id = $(this).attr("id");
            //     var $merchandiser_id = $(this).attr("merchandiser_id");
            //     console.log($merchandiser_id);
            // });
        });
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/comargo/Desktop/Laravel/attendance_tracker/resources/views/absent.blade.php ENDPATH**/ ?>