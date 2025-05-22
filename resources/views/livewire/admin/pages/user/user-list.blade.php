@section('title', 'لیست کاربران')
<section class="content">
    <div class="body_scroll">
        <div class="block-header">
            <div class="row">
                <div class="col-lg-7 col-md-6 col-sm-12">
                    <h2>لیست کاربران</h2>
                    </br>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href={{ route('admin.home') }}><i class="zmdi zmdi-home"></i>
                                خانه</a></li>
                        <li class="breadcrumb-item">تنظیمات</li>
                        <li class="breadcrumb-item active">لیست کاربران</li>
                    </ul>
                    <button class="btn btn-primary btn-icon mobile_menu" type="button"><i
                                class="zmdi zmdi-sort-amount-desc"></i></button>
                </div>
                <div class="col-lg-5 col-md-6 col-sm-12">
                    <button class="btn btn-primary btn-icon float-right right_icon_toggle_btn" type="button"><i
                                class="zmdi zmdi-arrow-right"></i></button>
                </div>
            </div>
        </div>

        <div class="container-fluid">
            <!-- Hover Rows -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12">
                    <div class="card">
                        <div class="header">
                            <h2>
                                <strong>جست و جو</strong>
                            </h2>
                        </div>
                        <div class="body">
                            <div class="row clearfix">
                                <div class="form-group col-lg-3 col-md-4 col-sm-6">
                                    <input type="text"
                                           class="form-control @error('search') is-invalid @enderror"
                                           wire:model.live.debounce.500ms="search"
                                           placeholder="نام کاربری ، ایمیل">
                                    @error('search')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group col-lg-3 col-md-4 col-sm-6">
                                    <select wire:model.live="roleId"
                                            class="form-control @error('roleId') is-invalid @enderror"
                                    >
                                        <option value="">انتخاب نقش</option>
                                        @foreach($roles as $role)
                                            <option value={{$role->id}}>{{$role->display_name}}</option>
                                        @endforeach
                                    </select>
                                    @error('roleId')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="header">
                            <h2><strong>لیست کاربران</strong></h2>
                        </div>
                        <div class="body">
                            @if (!count($users) === 0)
                                <p>هیچ رکوردی وجود ندارد</p>
                            @else
                                <div class="body">
                                    @if (count($users) === 0)
                                        <p>هیچ رکوردی وجود ندارد</p>
                                    @else
                                        <div class="table-responsive">
                                            <table class="table table-hover c_table theme-color">
                                                <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>کد</th>
                                                    <th>نام کاربر</th>
                                                    <th>نقش</th>
                                                    <th>ایمیل</th>
                                                    <th class="text-center js-sweetalert">عملیات</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @foreach ($users as $key => $user)
                                                    <tr wire:key="{{ $user->id }}">
                                                        <td>{{ $users->firstItem() + $key }}</td>

                                                        <td>{{ $user->id }}</td>
                                                        <td>
                                                            <span class="text-muted">{{ $user->name }} </span>
                                                        </td>
                                                        <td><span class="text-muted">{{ $user->role->display_name }}</span>
                                                        </td>
                                                        <td><span class="text-muted">{{ $user->email }}</span></td>
                                                        <td class="text-center js-sweetalert">
                                                            <a href="{{ route('admin.edit-user', $user->id) }}"
                                                               wire:navigate
                                                               class="btn btn-raised btn-info waves-effect">
                                                                <i class="zmdi zmdi-edit"></i>
                                                            </a>
                                                            {{-- <button class="btn btn-raised btn-danger waves-effect"
                                                    data-type="confirm"
                                                    data-form-id="del-user-{{ $user->id }}">حذف</button>
                                                <form action="{{ route('admin.users.destroy', $user->id) }}"
                                                    id="del-user-{{ $user->id }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                </form> --}}
                                                        </td>
                                                    </tr>
                                                @endforeach
                                                </tbody>
                                            </table>
                                            {{ $users->onEachSide(1)->links() }}
                                        </div>
                                    @endif
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            <!-- #END# Hover Rows -->
        </div>
    </div>
</section>
