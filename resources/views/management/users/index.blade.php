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
                                    <th scope="col">{{ ucwords(trans('managements/users.table.name')) }}</th>
                                    <th scope="col">{{ ucwords(trans('general.lastUpdated')) }}</th>
                                    <th scope="col">{{ ucwords(trans('general.action')) }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($users as $key => $user)
                                <tr>
                                    <td>{{ $users->firstItem()+$key }}</td>
                                    <td>{{ $user->name}}</td>
                                    <td>{{ $user->email}}</td>
                                    <td>
                                        <x-atoms.button-edit :url="route('management.users.edit', $user->id)"/>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        {{ $users->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-dashboard.layout>
