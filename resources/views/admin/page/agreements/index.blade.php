@extends('admin.layout.MasterAdmin')

@push('styles')

@endpush

@section('Content')
<section class="content">
    <div class="body_scroll">
        <div class="block-header">
            <div class="row">
                <div class="col-lg-7 col-md-6 col-sm-12">
                    <h2>لیست قولنامه ها</h2>
                    </br>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href={{route('admin.home')}}><i class="zmdi zmdi-home"></i>
                                خانه</a></li>
                        <li class="breadcrumb-item"><a href="javascript:void(0);">قولنامه</a></li>
                        <li class="breadcrumb-item active">لیست قولنامه ها</li>
                    </ul>
                    </br>
                    <a onclick="loadbtn(event)" href="{{route('admin.agreements.create')}}"
                        class="btn btn-raised btn-info waves-effect">
                        اضافه کردن قولنامه </a>

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
                            @if(count($agreements)===0)
                            <p>هیچ رکوردی وجود ندارد</p>
                            @else
                            <div class="form-group row">
                                <label for="inputEmail3" class="col-sm-1 col-form-label">جستجو </label>
                                <div class="col-sm-11">
                                    <input id="searchInput" class="form-control col-md-3"
                                        placeholder="یک عبارت بنویسید....">
                                </div>
                            </div>
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th>شماره</th>
                                            <th>مالک</th>
                                            <th>فروشنده</th>
                                            <th>تاریخ قرارداد</th>
                                            <th class="text-center">عملیات</th>
                                        </tr>
                                    </thead>
                                    <tbody id="myTable">
                                        @foreach($agreements as $agreement)
                                        <tr>
                                            <td>{{$agreement->id}}</td>
                                            <td>{{$agreement->owner_name}}</td>
                                            <td>{{$agreement->customer_name}}</td>
                                            <td>{{$agreement->agreement_date}}</td>
                                            <td class="text-center js-sweetalert">
                                                <a href="{{route('admin.agreements.show',$agreement->id)}}"
                                                    class="btn btn-raised btn-primary waves-effect"
                                                    onclick="loadbtn(event)">
                                                    مشاهده
                                                </a>
                                                <a href="{{route('admin.agreements.edit',$agreement->id)}}"
                                                    class="btn btn-raised btn-info waves-effect"
                                                    onclick="loadbtn(event)">
                                                    ویرایش
                                                </a>
                                                <button class="btn btn-raised btn-danger waves-effect"
                                                    data-type="confirm"
                                                    data-form-id="del-agreement-{{$agreement->id}}">حذف</button>
                                                <form action="{{route('admin.agreements.destroy',$agreement->id)}}"
                                                    id="del-agreement-{{$agreement->id}}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                </form>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                {{ $agreements->links() }}
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

@push('scripts')
<script>
$(document).ready(function() {
    $("#searchInput").on("keyup", function() {
        var value = $(this).val().toLowerCase();
        $("#myTable tr").filter(function() {
            $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
        });
    });
});
</script>
@endpush