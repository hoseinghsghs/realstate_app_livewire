@if($properties->total() > 0)
<div class="short_wraping">
    <strong>تعداد نتایج:<span class="mx-1">{{$properties->total()}}</span></strong>
</div>
<div class="row justify-content-center">
    @each('home.partials.single-property', $properties, 'property')

</div>
{{ $properties->links('home.partials.pagination') }}
@else
<div class="short_wraping">
    <strong>هیچ ملکی یافت نشد</strong>
</div>
@endif