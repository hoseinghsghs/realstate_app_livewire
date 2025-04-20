@section('title', 'لیست علاقه مندی ها')


<section class="gray pt-5 pb-5">
    <div class="container-fluid">

        <div class="row">

            @include('home.pages.UserProfile.right')

            <div class="col-lg-9 col-md-8 col-sm-12">
                <div class="dashboard-body">

                    <div class="dashboard-wraper">

                        <!-- Bookmark Property -->
                        <div class="frm_submit_block">
                            <h4>املاک ذخیره شده</h4>
                        </div>

                        <table class="property-table-wrap responsive-table bkmark">

                            <tbody>
                                <tr>
                                    <th><i class="fa fa-file-text"></i> ملک ها</th>
                                    <th></th>
                                </tr>
                                @if (!count($wishlist))
                                    <h3><strong>لیست علاقه مندی های شما خالی است</strong></h3>
                                @endif

                                @foreach ($wishlist as $wished)
                                    @if ($wished->property->checkUserWishlist(auth()->id()))
                                        <!-- Item #1 -->
                                        <tr id="{{ $wished->property->id }}">
                                            <td class="dashboard_propert_wrapper">
                                                <img src="{{ '/storage/preview/' . $wished->property->img }}"
                                                    alt="">
                                                <div class="title">
                                                    <h4><a
                                                            href="{{ route('properties.show', [$wished->property->id]) }}">{{ $wished->property->title }}</a>
                                                    </h4>
                                                    <span> {{ $wished->property->province }},
                                                        {{ $wished->property->city }},
                                                        {{ $wished->property->district }} </span>
                                                    <span
                                                        class="table-property-price">{{ $wished->property->type }}</span>
                                                </div>
                                            </td>
                                            <td class="action">
                                                <a wire:click="removeFromWishlist({{ $wished->property->id }})"
                                                    class="delete" style="cursor: pointer;"><i class="ti-close"></i>
                                                    حذف</a>
                                            </td>
                                        </tr>
                                    @endif
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>
