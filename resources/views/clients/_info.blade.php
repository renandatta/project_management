<div class="card mb-3">
    <div class="card-body">
        <x-alert type="error" id="alert_client" />
        <form id="client_form">
            @csrf
            @if(!empty($client))
                <x-input type="hidden" name="id" :value="$client->id" />
            @endif
            <div class="row">
                <div class="col-md-6">
                    <x-form-group id="name" caption="Name">
                        <x-input name="name" :value="$client->name ?? ''" />
                    </x-form-group>
                    <x-form-group id="address" caption="Address">
                        <x-textarea name="address" :value="$client->address ?? ''" />
                    </x-form-group>
                    <x-form-group id="phone" caption="Phone">
                        <x-input name="phone" :value="$client->phone ?? ''" />
                    </x-form-group>
                    <x-form-group id="contact_person" caption="Contact Person">
                        <x-input name="contact_person" :value="$client->contact_person ?? ''" />
                    </x-form-group>
                    <button class="btn btn-primary" type="submit">Save</button>
                    <button class="btn btn-light ml-2" type="button" onclick="init_client()">Cancel</button>
                    @if(!empty($client))
                        <button class="btn btn-danger float-right" type="button" onclick="delete_client()">Delete</button>
                    @endif
                </div>
            </div>
        </form>
    </div>
</div>

<script>
    $client_form = $('#client_form');
    $client_form.submit((e) => {
        e.preventDefault();
        let data = new FormData($client_form.get(0));
        $.ajax({
            url: "{{ route('clients.save') }}",
            type: 'post',
            data: data,
            cache: false,
            processData: false,
            contentType: false,
            success: function() {
                init_client();
            },
        }).fail((xhr) => {
            let error = JSON.parse(xhr.responseText);
            if (error.errors) {
                display_error('alert_client', error.errors);
            } else {
                console.log(xhr.responseText);
            }
        });
    });

    delete_client = () => {
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Yes'
        }).then((result) => {
            if (result.value === true) {
                let data = {_token: '{{ csrf_token() }}', id};
                $.post("{{ route('clients.delete') }}", data, () => {
                    init_client();
                }).fail((xhr) => {
                    let error = JSON.parse(xhr.responseText);
                    if (error.errors) {
                        display_error('alert_client', error.errors);
                    } else {
                        console.log(xhr.responseText);
                    }
                });
            }
        })
    }
</script>
