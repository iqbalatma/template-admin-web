@php use App\Enums\Role; @endphp
<x-dashboard.layout>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-content">
                    <div class="card-body">
                        <div class="d-grid gap-2 d-md-flex justify-content-between">
                            <h5 class="card-title mb-4">{{ $cardTitle }}</h5>
                            <a href="{{route('management.master.roles.create')}}" class="btn btn-primary icon icon-left">
                                <i data-feather="plus-square"></i> Create
                            </a>
                        </div>
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
                                        @if($role->is_mutable && $role->name !== Role::SUPERADMIN->value)
                                            <a href="{{ route('management.master.roles.edit', $role->id) }}"
                                               class="btn btn-success icon icon-left">
                                                <i data-feather="edit"></i> Edit
                                            </a>
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
