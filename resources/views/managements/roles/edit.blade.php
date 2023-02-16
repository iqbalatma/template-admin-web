<x-dashboard.layout title="{{ $title }}" subTitle="Subtitle">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-content">
                    <div class="card-body">
                        <h5 class="card-title mb-4">All Data Roles</h5>

                        <ul class="list-group list-group-flush">
                            <li class="list-group-item">Role : {{ $role->formatted_name }}</li>
                            <li class="list-group-item">Last Updated : {{ $role->updated_at }}</li>
                        </ul>


                        <div class="permission mt-4">
                            @foreach ($permissions as $permission)
                            <div class="form-check form-switch form-check-inline">
                                <input class="form-check-input" type="checkbox" @if($permission->is_active) checked @endif id="permission{{ $permission->id }}">
                                <label class="form-check-label" for="permission{{ $permission->id }}">{{ $permission->description }}</label>
                            </div>
                            @endforeach
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</x-dashboard.layout>