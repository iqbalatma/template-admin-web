<x-dashboard.layout>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-content">
                    <div class="card-body">
                        <h5 class="card-title mb-4">Add new data role</h5>
                        <form id="roles.store" action="{{route('management.master.roles.store')}}" method="POST">
                            @csrf
                            <div class="row g-4">
                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="name">Role Name</label>
                                        <input type="text" id="name" class="form-control mt-4"
                                               placeholder="Role name" name="name">
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
                                                   value="{{ $permission->id }}" @if($permission->is_active) checked
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
                        <x-atoms.button-back :url="route('management.master.roles.index')" />
                        <x-atoms.button-save form="roles.store" />
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-dashboard.layout>
