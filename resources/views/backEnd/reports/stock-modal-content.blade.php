<div>
    <p><strong>Product Name:</strong> {{ $stock->name }}</p>
    <p><strong>Available Quantity:</strong> {{ $stock->stock }} piece{{ $stock->stock > 1 ? 's' : '' }}</p>
    <p><strong>Last Updated:</strong> {{ $stock->updated_at->format('d F, Y | h:i a') }}</p>

    <!-- Add a form or other elements to adjust stock -->
    <form class="mt-2" id="stock-form">
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="new_quantity">Adjust Quantity</label>
                    <input type="number" class="form-control" id="new_quantity" name="new_quantity" required>
                    <span class="text-danger" id="new_quantity_error"></span>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="adjustment_type">Adjustment Type</label>
                    <select class="form-control" id="adjustment_type" name="adjustment_type" required>
                        <option value="in">Stock In</option>
                        <option value="out">Stock Out</option>
                    </select>
                    <span class="text-danger" id="adjustment_type_error"></span>
                </div>
            </div>
        </div>
    </form>
</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    $('.save-stock').click(function(e) {
        e.preventDefault();

        $('#new_quantity_error').text('');
        $('#adjustment_type_error').text('');

        Swal.fire({
            title: 'Are you sure?',
            text: `You are about to adjust the stock`,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Yes, adjust it!',
            cancelButtonText: 'No, cancel!',
        }).then((result) => {
            if (result.isConfirmed) {
                let formData = {
                    new_quantity: $('#new_quantity').val(),
                    adjustment_type: $('#adjustment_type').val(),
                    _token: '{{ csrf_token() }}'
                };

                $.ajax({
                    url: "{{ route('stock.adjust', $stock->id) }}",
                    method: 'POST',
                    data: formData,
                    success: function(response) {
                        if (response.success) {
                            location.reload();
                        } else {
                            if (response.errors) {
                                if (response.errors.new_quantity) {
                                    $('#new_quantity_error').text(response.errors.new_quantity[0]);
                                }
                                if (response.errors.adjustment_type) {
                                    $('#adjustment_type_error').text(response.errors.adjustment_type[0]);
                                }
                            } else {
                                alert('Error adjusting stock: ' + response.message);
                            }
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error('AJAX Error: ', error);
                        if (xhr.responseJSON && xhr.responseJSON.errors) {
                            $.each(xhr.responseJSON.errors, function(key, messages) {
                                $('#' + key + '_error').text(messages[0]);
                            });
                        } else {
                            $('#new_quantity_error').text('An unexpected error occurred. Please try again.');
                        }
                    }
                });
            }
        });
    });
</script>
