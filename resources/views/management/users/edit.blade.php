<x-dashboard.layout>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-content">
                    <div class="card-body">
                        <h5 class="card-title mb-4">Data user</h5>

                        <ul class="list-group list-group-flush">
                            <li class="list-group-item">User Name : {{ $user->name }}</li>
                            <li class="list-group-item">User Email : {{ $user->email }}</li>
                            <li class="list-group-item">Last Updated : {{ $user->updated_at }}</li>
                        </ul>

                        <form id="users.update" action="{{ route('management.users.update', $user->id) }}" method="POST">
                            @csrf
                            @method("PUT")
                            <div class="role mt-4">
                                @foreach ($roles as $role)
                                <div class="form-check form-switch form-check-inline">
                                    <input name="roles[]" class="form-check-input" type="checkbox" value="{{ $role->name }}" @if($role->is_active) checked @endif id="role{{ $role->id }}">
                                    <label class="form-check-label" for="role{{ $role->id }}">{{ $role->formattedName }}</label>
                                </div>
                                @endforeach
                            </div>
                        </form>
                    </div>
                    <div class="card-footer">
                        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                            <x-atoms.button-back :url="route('management.users.index')" />
                            <x-atoms.button-update form="users.update" />
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-dashboard.layout>
