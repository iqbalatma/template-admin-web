@php use App\Enums\Role; @endphp
<x-dashboard.layout>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-content">
                    <div class="card-body">
                        <h5 class="card-title mb-4">{{ $cardTitle }}</h5>
                        <table class="table table-striped">
                            <thead>
                            <tr>
                                <th scope="col">No</th>
                                <th scope="col">{{ ucwords(trans('managements/roles.table.role')) }}</th>
                                <th scope="col">{{ ucwords(trans('general.lastUpdated')) }}</th>
                                <th scope="col">{{ ucwords(trans('general.action')) }}</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($roles as $key => $role)
                                <tr>
                                    <th scope="row">{{ $key+1 }}</th>
                                    <td>{{ $role->formattedName }}</td>
                                    <td>{{ $role->updated_at }}</td>
                                    <td>
                                        <a href="{{ route('management.master.roles.edit', $role->id) }}"
                                           class="btn btn-success">Edit</a>
                                        @if($role->is_mutable && $role->name !== Role::SUPERADMIN->value)
                                            <a href="{{ route('management.master.roles.edit', $role->id) }}"
                                               class="btn btn-success">Edit</a>
                                        @else
                                            Data Is No Mutable
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-dashboard.layout>
