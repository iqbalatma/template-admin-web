<x-dashboard.layout>
    <div class="row">
        <div class="col-12 col-lg-8">
            <div class="card">
                <div class="card-body">
                    <form action="{{route('management.profiles.update')}}" enctype="multipart/form-data" method="POST">
                        @csrf
                        @method('PATCH')
                        <div class="form-group">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" name="name" id="name" class="form-control" placeholder="Enter your name"
                                   required value="{{$user->name}}">
                        </div>
                        <div class="form-group">
                            <label for="email" class="form-label">Email</label>
                            <input type="text" name="email" id="email" class="form-control"
                                   placeholder="Enter your email"
                                   value="{{$user->email}}" readonly disabled>
                        </div>
                        <div class="form-group">
                            <label for="phone" class="form-label">Phone</label>
                            <input type="text" name="phone" id="phone" class="form-control"
                                   placeholder="Enter your phone number"
                                   value="{{$user->phone}}">
                        </div>
                        <div class="form-group">
                            <label for="phone" class="form-label">Address</label>
                            <textarea type="text" name="phone" id="phone" class="form-control"
                                      placeholder="Enter your address" rows="4">{{$user->phone}}</textarea>
                        </div>


                        <div class="form-group">
                            <label for="birthday" class="form-label">Birthday</label>
                            <input type="date" name="birthday" id="birthday" class="form-control"
                                   placeholder="Your Birthday">
                        </div>
                        <div class="form-group">
                            <label for="gender" class="form-label">Gender</label>
                            <select name="gender" id="gender" class="form-control">
                                <option value="male">Male</option>
                                <option value="female">Female</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="profile_image" class="form-label">Profile</label>
                            <div class="row">
                                <div class="col-md-2">
                                    @if($user->profile_image)
                                        <img
                                            src="{{ \Illuminate\Support\Facades\URL::to("/images/" . str_replace("/", "_", $user->profile_image)) }}"
                                            class="img-thumbnail" alt="avatar" width="100px">
                                    @else
                                        <img
                                            src="{{asset('default/profile.jpg')}}"
                                            class="img-thumbnail" alt="avatar" width="100px">
                                    @endif

                                </div>
                                <div class="col-md-10">
                                    <input class="form-control" type="file" id="profile_image" name="profile_image"
                                           accept="image/*">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <x-atoms.button-save />
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-12 col-lg-4">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-center align-items-center text-center flex-column">
                        <div class="avatar avatar-2xl">
                            @if($user->profile_image)
                                <img
                                    src="{{ \Illuminate\Support\Facades\URL::to("/images/" . str_replace("/", "_", $user->profile_image)) }}"
                                    class="img-thumbnail" alt="avatar" width="100px">
                            @else
                                <img
                                    src="{{asset('default/profile.jpg')}}"
                                    class="img-thumbnail" alt="avatar" width="100px">
                            @endif
                        </div>

                        <h3 class="mt-3">{{ucwords($user->name)}}</h3>
                        <p class="text-small">
                            @foreach(auth()->user()->getRoleNames() as $key => $role)
                                {{ ucwords($role) }},
                            @endforeach
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>

</x-dashboard.layout>
