<li>
    <div class="list__content">

        @if($Nome==$casaEditrice)
            <input type="checkbox" checked onclick="location.href='<?=ROOT?>products?category={!! $category !!}&search={!! $search !!}&casaEditrice={!! $Nome !!}&orderBy={!! $orderBy !!}  ';">
        @else
            <input type="checkbox" onclick="location.href='<?=ROOT?>products?category={!! $category !!}&search={!! $search !!}&casaEditrice={!! $Nome !!}&orderBy={!! $orderBy !!}  ';">
        @endif
        <span>{!! $Nome !!}</span>
    </div>
</li>