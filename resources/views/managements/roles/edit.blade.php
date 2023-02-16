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
                        <form id="roles.update" action="{{ route('roles.update', $role->id) }}" method="POST">
                            @csrf
                            @method("PUT")
                            <div class="permission mt-4">
                                @foreach ($permissions as $permission)
                                <div class="form-check form-switch form-check-inline">
                                    <input name="permissions[]" class="form-check-input" type="checkbox" value="{{ $permission->name }}" @if($permission->is_active) checked @endif id="permission{{ $permission->id }}">
                                    <label class="form-check-label" for="permission{{ $permission->id }}">{{ $permission->description }}</label>
                                </div>
                                @endforeach
                            </div>
                        </form>
                    </div>
                </div>
                <div class="card-footer">
                    <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                        <a href="{{ route('roles.index') }}" class="btn btn-danger me-md-2" type="button">Cancel</a>
                        <button type="submit" form="roles.update" class="btn btn-success me-md-2" type="button">Update</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-dashboard.layout>