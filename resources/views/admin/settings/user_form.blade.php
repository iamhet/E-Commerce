<div class="pd-20 card-box mt-30 mb-30 userlist">
    {!! Form::open(['route' => 'admin.addUser', 'method' => 'POST', 'files' => true, 'id' => 'userForm']) !!}
    @csrf
    {!! Form::hidden('id', isset($user->id) ? $user->id : '') !!}
    <div class="row form-group">
        <label class="col-sm-12 col-md-2 col-form-label" style="font-size: 1.3rem;">User Name</label>
        <div class="col-sm-12 col-md-6">
            {!! Form::text('name', isset($user->name) ? $user->name : '', [
            'placeholder' => 'Enter User Name',
            'class' => 'form-control ',
            ]) !!}
        </div>
    </div>
    <div class="row form-group">
        <label class="col-sm-12 col-md-2 col-form-label" style="font-size: 1.3rem;">Email</label>
        <div class="col-sm-12 col-md-6">
            {!! Form::input('email', 'email', isset($user->email) ? $user->email : '', [
            'placeholder' => 'Enter Email',
            'class' => 'form-control ',
            ]) !!}
            <small class="form-hint">We'll never share your email with anyone else.</small>
        </div>
    </div>
    @if (!isset($user) && empty($user))
    <div class="row form-group">
        <label class="col-sm-12 col-md-2 col-form-label" style="font-size: 1.3rem;">Password</label>
        <div class="col-sm-12 col-md-6">
            {!! Form::input('password', 'password', isset($user->password) ? $user->password : '', [
            'placeholder' => 'Enter Password',
            'class' => 'form-control ',
            ]) !!}
            <small class="form-hint">
                Your password must be 8-20 characters long, contain letters and numbers, and must not contain spaces,
                special characters, or emoji.
            </small>
        </div>
    </div>
    @endif
    <div class="row form-group">
        <label class="col-sm-12 col-md-2 col-form-label" style="font-size: 1.3rem;">Phone Number</label>
        <div class="col-sm-12 col-md-6">
            {!! Form::text('phonenumber', isset($user->phonenumber) ? $user->phonenumber : '', [
            'placeholder' => 'Enter Phone Number',
            'class' => 'form-control ',
            ]) !!}
        </div>
    </div>
    <div class="row form-group">
        <label class="col-sm-12 col-md-2 col-form-label" style="font-size: 1.3rem;">Role</label>
        <div class="col-sm-12 col-md-6">
            <select class="form-control" name="role" id='role'>
                <option value="">Nothing to select</option>
                @foreach ($role as $item)
                @if (isset($userRole) && !empty($userRole))
                @foreach ($userRole as $key => $value)
                <option value="{{ $item->id }}" {{ $value==$item->id ? 'selected' : '' }}>
                    {{ $item->name }}
                </option>
                @endforeach
                @else
                <option value="{{ $item->id }}">
                    {{ $item->name }}
                </option>
                @endif
                @endforeach
            </select>
        </div>
    </div>
    <div class="row form-group">
        <div class="col-md-2">
            <label class=" col-form-label" style="font-size: 1.3rem;">Permission</label>
        </div>
        <div class="col-md-10 permission_badges">
            @if (isset($userPermission) && !empty($userPermission))
            @foreach ($userPermission as $item => $value)
            <span class="mt-2" data-role="tagsinput">{{ $value->name }}</span>
            @endforeach
            @endif
        </div>
        <div class="col-md-12">
            <a href="#" class="additionalPermission" data-bs-toggle="modal" data-bs-target="#modal-permission">Give
                additional Permission</a>
        </div>
    </div>

    <div class="modal modal-blur fade " id="modal-permission" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title permissionModalTitle">Additional
                        Permission
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="row form-group mb-3 mt-3 row">
                    <div class="col-md-12 m-3">
                        @foreach ($permission as $item => $value)
                        <label class="form-check ">
                            <input class="form-check-input permission" type="checkbox" name="permission[]"
                                id="permission_{{$value->id}}" value="{{ $value->name }}" @if (isset($userPermission) &&
                                !empty($userPermission)) @foreach ($userPermission as $key=> $val)
                            @if ($value->name == $val->name)
                            checked
                            @endif
                            @endforeach
                            @endif
                            >
                            <span class="form-check-label">{{ $value->name }}</span>
                        </label>
                        @endforeach
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Set Permission</button>
                </div>
            </div>
        </div>
    </div>

    <div class="row form-group ">
        <div class="col-md-12">
            <label class="form-check">
                <input class="form-check-input" type="checkbox" name="administrator" value="1" {{
                    isset($user->administrator) && $user->administrator == 1 ? 'checked' : '' }}>
                <span class="form-check-label">Administrator</span>
            </label>
        </div>
    </div>

    <div class="form-group row">
        <label class="col-sm-12 col-md-2 col-form-label" style="font-size: 1.3rem;">Profile
            Image</label>
        <div class="col-sm-12 col-md-6 ml-3">
            @if (isset($user->profileImage) && !empty($user->profileImage))
            <div class="row Userimage">
                <div class="col-md-6">
                    <img id="preview-light_logo"
                        src="{{ isset($user->profileImage) ? asset('UserImages/' . $user->id . '/' . $user->profileImage) : '' }}"
                        alt=" preview image" style="max-height: 250px;">
                </div>
                <div class="col-md-1">
                    <div data-toggle="tooltip" data-image="light_logo">
                        <button type="button" data-id={{ $user->id }}
                            class="btn-close delete_image"></button>
                    </div>
                </div>
            </div>
            <div class="fileupload">
                {!! Form::file('profileImage', ['class' => 'custom-file-input', 'id' => 'profileImage']) !!}
                <label class="custom-file-label">Choose file</label>
                <img id="preview-image" src="" class="my-3" alt="preview image" style="max-height: 250px;">
            </div>
            @else
            {!! Form::file('profileImage', ['class' => 'custom-file-input', 'id' => 'profileImage']) !!}
            <label class="custom-file-label">Choose file</label>
            <img id="preview-image" src="" class="my-3" alt="preview image" style="max-height: 250px;">
            @endif
        </div>
    </div>

    <div class="row form-group">
        <label class="col-sm-12 col-md-2 col-form-label" style="font-size: 1.3rem;">Facebook Link</label>
        <div class="col-sm-12 col-md-6">
            {!! Form::text('facebookLink', isset($user->facebookLink) ? $user->facebookLink : '', [
            'placeholder' => 'Enter Facebook Link',
            'class' => 'form-control ',
            ]) !!}
        </div>
    </div>

    <div class="row form-group">
        <label class="col-sm-12 col-md-2 col-form-label" style="font-size: 1.3rem;">Instagram Link</label>
        <div class="col-sm-12 col-md-6">
            {!! Form::text('instagramLink', isset($user->instagramLink) ? $user->instagramLink : '', [
            'placeholder' => 'Enter Instagram Link',
            'class' => 'form-control ',
            ]) !!}
        </div>
    </div>

    <div class="row form-group">
        <label class="col-sm-12 col-md-2 col-form-label" style="font-size: 1.3rem;">Twitter Link</label>
        <div class="col-sm-12 col-md-6">
            {!! Form::text('twitterLink', isset($user->twitterLink) ? $user->twitterLink : '', [
            'placeholder' => 'Enter Twitter Link',
            'class' => 'form-control ',
            ]) !!}
        </div>
    </div>

    <div class="row form-group">
        <label class="col-sm-12 col-md-2 col-form-label" style="font-size: 1.3rem;">LinkedIn Link</label>
        <div class="col-sm-12 col-md-6">
            {!! Form::text('linkedInLink', isset($user->linkedInLink) ? $user->linkedInLink : '', [
            'placeholder' => 'Enter LinkedIn Link',
            'class' => 'form-control ',
            ]) !!}
        </div>
    </div>

    <div class="row form-group">
        <label class="col-sm-12 col-md-2 col-form-label" style="font-size: 1.3rem;">Skype Link</label>
        <div class="col-sm-12 col-md-6">
            {!! Form::text('skypeLink', isset($user->skypeLink) ? $user->skypeLink : '', [
            'placeholder' => 'Enter Skype Link',
            'class' => 'form-control ',
            ]) !!}
        </div>
    </div>

    <div class="row">
        <div class="col-md-2"></div>
        <div class="col-md-2">
            {!! Form::submit('SUBMIT', ['type'=>'button','class' => 'mt-5 btn btn-info btn-sm
            btn-block
            mb-4']) !!}
        </div>
    </div>

    {!! Form::close() !!}
    @if (isset($user) && !empty($user))
    <div class="col-md-5 mt-2">
        <a href='#' data-bs-toggle="modal" data-bs-target="#modal-password">change password</a>
    </div>
    @endif
</div>


<div class="modal modal-blur fade" id="modal-password" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title permissionModalTitle">Update Password</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            {!! Form::open([
            'route' => 'admin.changePassword',
            'method' => 'POST',
            'id' => 'password_change_form',
            ]) !!}
            <div class="modal-body">


                @csrf
                {!! Form::hidden('userid', isset($user->id) ? $user->id : '') !!}
                <div class="mb-3">
                    <label class="form-label">Old Password</label>
                    {!! Form::input('password', 'oldPassword', '', [
                    'placeholder' => 'Enter Old Password',
                    'class' => 'form-control ',
                    ]) !!}
                </div>
                <div class="mb-3">
                    <label class="form-label">New Password</label>
                    {!! Form::input('password', 'newPassword', '', [
                    'placeholder' => 'Enter New Password',
                    'id' => 'newPassword',
                    'class' => 'form-control ',
                    ]) !!}
                </div>
                <div class="mb-3">
                    <label class="form-label">Confirm Password</label>
                    {!! Form::input('password', 'confirmPassword', '', [
                    'placeholder' => 'Enter Confirm Password',
                    'class' => 'form-control ',
                    ]) !!}
                </div>
            </div>
            <div class="modal-footer">
                <a href="#" class="btn btn-link link-secondary" data-bs-dismiss="modal">
                    Cancel
                </a>
                <button type="submit" class="btn btn-info btn-block">UPDATE PASSWORD</button>
            </div>
        </div>
        {!! Form::close() !!}
    </div>
</div>

<script type="text/javascript">
    $('#password_change_form').validate({
        rules: {
            oldPassword: {
                required: true,
                remote: {
                    url: "{{ route('admin.passwordexist') }}",
                    type: 'post',
                    data: {
                        id: $('input[name=userid]').val(),
                        oldPassword: function() {
                            return $('input[name=oldPassword]').val();
                        },
                    }
                }
            },
            newPassword: {
                required: true,
                minlength: 8,
            },
            confirmPassword: {
                required: true,
                minlength: 8,
                equalTo: '#newPassword',
            }
        },
        messages: {
            oldPassword: {
                required: "This field is required",
                remote: "Old Password don't match",
            },
            newPassword: {
                required: "This field is required",
            },
            confirmPassword: {
                required: "This field is required",
                equalTo: 'Please Enter the same password as above',
            }
        },
        highlight: function(element) {
            $('.error').addClass('text-danger');
            $(element).addClass('is-invalid');
        },
        unhighlight: function(element) {
            $(element).removeClass('is-invalid');
        },
        submitHandler: function(form) {
            var url = $('#password_change_form').attr('action');
            var data = {
                csrf: $('meta[name="csrf-token"]').attr('content'),
                id: $('input[name=userid]').val(),
                password: $('input[name=newPassword]').val(),
            };
            $.ajax({
                type: "post",
                url: url,
                data: data,
                dataType: "json",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(data) {
                    if (data.success) {
                        $('#modal-password').modal('hide');
                        $('input[name=oldPassword]').val('');
                        $('input[name=newPassword]').val('');
                        $('input[name=confirmPassword]').val('');
                        alert_float('success', data.message);
                    }
                }
            });
            return false;
        },
    });
    $('#userForm').validate({
        rules: {
            email: {
                required: true,
                remote: {
                    url: "{{ route('admin.emailexist') }}",
                    type: 'post',
                    data: {
                        email: function() {
                            return $('input[name=email]').val();
                        },
                        id: function() {
                            return $('input[name=id]').val();
                        }
                    }
                }
            },
            name: {
                required: true,
                minlength: 8,
            },
        },
        messages: {
            email: {
                required: "This field is required",
                remote: 'This email already exist.',
            },
            name: {
                required: "This field is required",
            },
        },
        highlight: function(element) {
            $('.error').addClass('text-danger');
            $(element).addClass('is-invalid');
        },
        unhighlight: function(element) {
            $(element).removeClass('is-invalid');
        },
        submitHandler: function(form) {
            var data = new FormData(form);
            console.log($('input[name="permission[]"]').val());
            var url = $(form).attr('action');
            $.ajax({
                type: "post",
                url: url,
                data: data,
                dataType: "json",
                cache: false,
                contentType: false,
                processData: false,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(data) {
                    window.location.href = "{{ route('admin.userlist') }}";
                }
            });
            return false;
        },
    });
    $(document).ready(function(e) {
        $('.fileupload').hide();
        $('#preview-image').hide();
        $('#profileImage').change(function() {
            let reader = new FileReader();
            reader.onload = (e) => {
                $('#preview-image').attr('src', e.target.result);
            }
            reader.readAsDataURL(this.files[0]);
            $('#preview-image').show();

        });
        $(document).on('change', '.permission', function() {
            var permission = [];
            var content = '';
            $.each($('#userForm').serializeArray(), function(arrayIndex, elementValue) {
                if (elementValue.name == 'permission[]') {
                    permission.push(elementValue.value);
                    content += `
                    <span class=" mt-2 ">` + elementValue
                        .value + `</span>
                    `;
                }
            });
            $('.permission_badges').empty();
            $('.permission_badges').append(content);
        });
        $(document).on('click', '.delete_image', function() {
            var id = {
                id: $(this).data('id'),
                csrf: $('meta[name="csrf-token"]').attr('content')
            };
            $.ajax({
                type: "post",
                url: "{{ route('admin.deleteUserImage') }}",
                data: id,
                dataType: "json",
                success: function(data) {
                    if (data.success) {
                        $('.fileupload').show();
                        $('.Userimage').hide();
                    }
                }
            });
        });
        $(document).on('click','.additionalPermission', function() {
            var role = {role : $('#role').val()};
            $.ajax({
                type: "post",
                url: "{{route('admin.getRolePermission')}}",
                data: role,
                dataType: "json",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function (response) {
                    $('#modal-permission').modal('show');
                    $.each(response.permissions, function (arrayIndex, elementValue) {  
                        $('#permission_'+elementValue+'').attr('checked',true);
                        $('#permission_'+elementValue+'').attr('disabled',true);
                        $('#modal-permission').modal('show');
                    });
                }
            });
        });
    });
</script>