<li>
    <div class="list__content">

        @if($Categoria==$category)
            <input type="checkbox" checked onclick="location.href='<?=ROOT?>products?category={!! $Categoria !!}&search={!! $search !!}&casaEditrice={!! $casaEditrice !!}&orderBy={!! $orderBy !!}  ';">
        @else
            <input type="checkbox" onclick="location.href='<?=ROOT?>products?category={!! $Categoria !!}&search={!! $search !!}&casaEditrice={!! $casaEditrice !!}&orderBy={!! $orderBy !!}  ';">
        @endif
        <span>{!! $Categoria !!}</span>
    </div>
</li>