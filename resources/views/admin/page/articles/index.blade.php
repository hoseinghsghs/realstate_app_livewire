@extends('admin.layout.MasterAdmin')

@section('Content')
<section class="content">
    <div class="body_scroll">
        <div class="block-header">
            <div class="row">
                <div class="col-lg-7 col-md-6 col-sm-12">
                    <h2>لیست مقالات</h2>
                    </br>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href={{route('admin.home')}}><i class="zmdi zmdi-home"></i>
                                خانه</a></li>
                        <li class="breadcrumb-item"><a href="javascript:void(0);">پست</a></li>
                        <li class="breadcrumb-item active">لیست مقالات</li>
                    </ul>
                    </br>
                    <a onclick="loadbtn(event)" href="{{route('admin.articles.create')}}"
                        class="btn btn-raised btn-info waves-effect">
                        اضافه کردن مقاله </a>
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
                        <div class="body">
                            @if(count($articles)===0)
                            <p>هیچ رکوردی وجود ندارد</p>
                            @else
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>عنوان</th>
                                            <th>نوشته توسط</th>
                                            <th>تاریخ</th>
                                            <th class="text-center">عملیات</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($articles as $key => $article)
                                        <tr>
                                            <td scope="row">{{$key+1}}</td>
                                            <td>{{$article->title}}</td>
                                            <td>{{$article->user->name}}</td>
                                            <td>{{Hekmatinasser\Verta\Verta::instance($article->created_at)->format('Y/n/j')}}
                                            </td>
                                            <td class="text-center js-sweetalert">
                                                <a href="{{route('admin.articles.edit',$article->id)}}"
                                                    class="btn btn-raised btn-info waves-effect"
                                                    onclick="loadbtn(event)">
                                                    ویرایش
                                                </a>
                                                <button class="btn btn-raised btn-danger waves-effect"
                                                    data-type="confirm"
                                                    data-form-id="del-article-{{$article->id}}">حذف</button>
                                                <form action="{{route('admin.articles.destroy',$article->id)}}"
                                                    id="del-article-{{$article->id}}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                </form>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                {{ $articles->links() }}
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