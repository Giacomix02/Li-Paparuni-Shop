<div class="m-order__get">
    <div class="manage-o__header u-s-m-b-30">
        <div class="dash-l-r">
            <div class="card-info-order">
                <div class="manage-o__text-2 u-c-secondary">Ordine #{!! $IdOrdine !!}</div>
                <div class="manage-o__text u-c-silver">Effettuato il:<br>{!! $DataOrdine !!}</div>
            </div>
        </div>
    </div>
    <div class="manage-o__description second-row-card-info-order">
        <div>
            @if($StatoOrdine == "Consegnato")
                <span class="badge-stato-ordine badge--delivered">{!! $StatoOrdine !!}</span>
            @elseif($StatoOrdine == "In Consegna")
                <span class="badge-stato-ordine badge--shipped">{!! $StatoOrdine !!}</span>
            @elseif($StatoOrdine == "In Preparazione" || $StatoOrdine == "In Attesa")
                <span class="badge-stato-ordine badge--processing">{!! $StatoOrdine !!}</span>
            @endif
        </div>


        <a class="bottone-ordine-info-list btn--e-transparent-brand-b-2" href="<?=ROOT?>AccountManageOrder/{!! $IdOrdine !!}">DETTAGLI</a>


        <div>
            <span class="manage-o__text-2 u-c-silver">Totale:

                <span class="manage-o__text-2 u-c-secondary">{!! $Totale !!}€</span>
            </span>
        </div>

    </div>
</div>