@extends('admin.layout.MasterAdmin')

@section('Content')
<section class="content">
    <div class="body_scroll">
        <div class="block-header">
            <div class="row">
                <div class="col-lg-7 col-md-6 col-sm-12">
                    <h2>لیست نظرات</h2>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href={{route('admin.home')}}><i class="zmdi zmdi-home"></i> خانه</a></li>
                        <li class="breadcrumb-item active">لیست نظرات</li>
                    </ul>
                    <button class="btn btn-primary btn-icon mobile_menu" type="button"><i class="zmdi zmdi-sort-amount-desc"></i></button>
                </div>
                <div class="col-lg-5 col-md-6 col-sm-12">
                    <button class="btn btn-primary btn-icon float-right right_icon_toggle_btn" type="button"><i class="zmdi zmdi-arrow-right"></i></button>
                </div>
            </div>
        </div>

        <div class="container-fluid">
            <!-- Hover Rows -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12">
                    <div class="card">
                        <div class="body">
                            @if(count($comments)===0)
                            <p>هیچ رکوردی وجود ندارد</p>
                            @else
                            <p>برای تایید نظر روی وضعیت آن کلیک کنید</p>
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>نوشته توسط</th>
                                            <th>متن</th>
                                            <th>تاریخ</th>
                                            <th>امتیاز</th>
                                            <th>وضعیت</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($comments as $comment)
                                        <tr>
                                            <td scope="row">{{$comment->id}}</td>
                                            <td>{{$comment->user->name}}</td>
                                            <td>{{$comment->body}}</td>
                                            <td>{{Hekmatinasser\Verta\Verta::instance($comment->created_at)->format('Y/n/j')}}</td>
                                            <td>
                                                @if($comment->rating)
                                                <div class="rating">
                                                    <div class="stars">
                                                        @switch($comment->rating)
                                                        @case(1)
                                                        <span class="zmdi zmdi-star col-amber"></span>
                                                        <span class="zmdi zmdi-star-outline"></span>
                                                        <span class="zmdi zmdi-star-outline"></span>
                                                        <span class="zmdi zmdi-star-outline"></span>
                                                        <span class="zmdi zmdi-star-outline"></span>
                                                        @break @break
                                                        @case(2)
                                                        <span class="zmdi zmdi-star col-amber"></span>
                                                        <span class="zmdi zmdi-star col-amber"></span>
                                                        <span class="zmdi zmdi-star-outline"></span>
                                                        <span class="zmdi zmdi-star-outline"></span>
                                                        <span class="zmdi zmdi-star-outline"></span>
                                                        @break

                                                        @case(3)
                                                        <span class="zmdi zmdi-star col-amber"></span>
                                                        <span class="zmdi zmdi-star col-amber"></span>
                                                        <span class="zmdi zmdi-star col-amber"></span>
                                                        <span class="zmdi zmdi-star-outline"></span>
                                                        <span class="zmdi zmdi-star-outline"></span>
                                                        @break
                                                        @case(4)
                                                        <span class="zmdi zmdi-star col-amber"></span>
                                                        <span class="zmdi zmdi-star col-amber"></span>
                                                        <span class="zmdi zmdi-star col-amber"></span>
                                                        <span class="zmdi zmdi-star col-amber"></span>
                                                        <span class="zmdi zmdi-star-outline"></span>
                                                        @break
                                                        @case(5)
                                                        <span class="zmdi zmdi-star col-amber"></span>
                                                        <span class="zmdi zmdi-star col-amber"></span>
                                                        <span class="zmdi zmdi-star col-amber"></span>
                                                        <span class="zmdi zmdi-star col-amber"></span>
                                                        <span class="zmdi zmdi-star col-amber"></span>
                                                        @break
                                                        @endswitch
                                                    </div>
                                                </div>
                                                @endif
                                            </td>
                                            <td>
                                                @if($comment->approved)
                                                <span class='badge badge-success'>تایید شده </span>
                                                @else
                                                <a onclick="loadbtn(event)" href="{{route('admin.comments.edit',$comment->id)}}" class='btn btn-raised waves-effect btn-warning'>درانتظار تایید </a>
                                                @endif
                                            </td>
                                            <td class="text-center js-sweetalert">
                                                <button class="btn btn-raised btn-danger waves-effect" data-type="confirm" data-form-id="del-comment-{{$comment->id}}"><i class="zmdi zmdi-delete"></i></button>
                                                <form action="{{route('admin.comments.destroy',$comment->id)}}" id="del-comment-{{$comment->id}}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                </form>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                {{ $comments->links() }}
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
@endsection