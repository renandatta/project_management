<div class="card mb-3">
    <div class="card-body">
        <x-alert type="error" id="alert_project" />
        <form id="project_form">
            @csrf
            @if(!empty($project))
                <x-input type="hidden" name="id" :value="$project->id" />
            @endif
            <div class="row">
                <div class="col-md-6">
                    <x-form-group id="client_id" caption="Client">
                        <x-select
                            name="client_id"
                            :value="$project->client_id ?? ''"
                            :options="$list_clients"
                            class="select2"
                            caption="-Select Client-"
                        />
                    </x-form-group>
                    <x-form-group id="name" caption="Name">
                        <x-input name="name" :value="$project->name ?? ''" />
                    </x-form-group>
                    <x-form-group id="description" caption="Description">
                        <x-textarea name="description" :value="$project->description ?? ''" />
                    </x-form-group>
                    <x-form-group id="date_start" caption="Date Start">
                        <x-input name="date_start" :value="format_date($project->date_start ?? '')" class="datepicker" />
                    </x-form-group>
                    <button class="btn btn-primary" type="submit">Save</button>
                    <button class="btn btn-light ml-2" type="button" onclick="init_project()">Cancel</button>
                    @if(!empty($project))
                        <button class="btn btn-danger float-right" type="button" onclick="delete_project()">Delete</button>
                    @endif
                </div>
            </div>
        </form>
    </div>
</div>

<script>
    init_form_element();

    $project_form = $('#project_form');
    $project_form.submit((e) => {
        e.preventDefault();
        let data = new FormData($project_form.get(0));
        $.ajax({
            url: "{{ route('projects.save') }}",
            type: 'post',
            data: data,
            cache: false,
            processData: false,
            contentType: false,
            success: function() {
                init_project();
            },
        }).fail((xhr) => {
            let error = JSON.parse(xhr.responseText);
            if (error.errors) {
                display_error('alert_project', error.errors);
            } else {
                console.log(xhr.responseText);
            }
        });
    });

    delete_project = () => {
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Yes'
        }).then((result) => {
            if (result.value === true) {
                let data = {_token: '{{ csrf_token() }}', id};
                $.post("{{ route('projects.delete') }}", data, () => {
                    init_project();
                }).fail((xhr) => {
                    let error = JSON.parse(xhr.responseText);
                    if (error.errors) {
                        display_error('alert_project', error.errors);
                    } else {
                        console.log(xhr.responseText);
                    }
                });
            }
        })
    }
</script>
