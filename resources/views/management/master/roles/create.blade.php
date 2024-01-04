<x-dashboard.layout>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-content">
                    <div class="card-body">
                        <h5 class="card-title mb-4">All Data Roles</h5>
                        <form id="roles.store" action="{{route('management.master.roles.store')}}" method="POST">
                            @csrf
                            <div class="row g-4">
                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="first-name-column">First Name</label>
                                        <input type="text" id="first-name-column" class="form-control mt-4"
                                               placeholder="First Name" name="fname-column">
                                    </div>
                                </div>
                            </div>
                            <div class="permission mt-4">
                                @foreach ($permissions as $key => $permissionGroup)
                                    <h5>{{ucwords($key)}}</h5>
                                    <hr>
                                    @foreach($permissionGroup as $subKey => $permission)
                                        <div class="form-check form-switch form-check-inline">
                                            <input name="permissions[]" class="form-check-input" type="checkbox"
                                                   value="{{ $permission->name }}" @if($permission->is_active) checked
                                                   @endif id="permission{{ $permission->id }}">
                                            <label class="form-check-label"
                                                   for="permission{{ $permission->id }}">{{ $permission->description }}</label>
                                        </div>
                                    @endforeach
                                    <br>
                                    <br>
                                @endforeach
                            </div>
                        </form>
                    </div>
                </div>
                <div class="card-footer">
                    <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                        <a href="{{ route('management.master.roles.index') }}" class="btn btn-danger me-md-2"
                           type="button">
                            <i data-feather="corner-down-left"></i> Back
                        </a>
                        <button type="submit" form="roles.store" class="btn btn-success icon icon-left">
                            <i data-feather="save"></i> Save
                        </button>


                    </div>
                </div>
            </div>
        </div>
    </div>
</x-dashboard.layout>
