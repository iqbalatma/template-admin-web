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
                                    <th scope="col">{{ ucwords(trans('managements/permissions.table.permissionRule')) }}</th>
                                    <th scope="col">{{ ucwords(trans("managements/permissions.table.description")) }}</th>
                                    <th scope="col">{{ucwords("feature")}}</th>
                                    <th scope="col">{{ ucwords(trans("managements/permissions.table.lastUpdated")) }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($permissions as $key => $permission)
                                <tr>
                                    <th scope="row">{{ $permissions->firstItem()+$key }}</th>
                                    <td>{{ $permission->name }}</td>
                                    <td>{{ $permission->description }}</td>
                                    <td>{{ $permission->feature }}</td>
                                    <td>{{ $permission->updated_at }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>

                        {{ $permissions->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-dashboard.layout>
