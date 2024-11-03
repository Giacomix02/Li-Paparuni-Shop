<div class="manage-o__description order-detail-card-product">
    <div class="description__container">
        <div class="description-title">{{ $Nome }}</div>
    </div>
    <div class="description__info-wrap">
        <div>
            <span class="manage-o__text-2 u-c-silver">Quantità: <span
                        class="manage-o__text-2 u-c-secondary">{{$Quantita}}</span>
            </span>
        </div>
        <div>
            <span class="manage-o__text-2 u-c-silver">Totale: <span
                        class="manage-o__text-2 u-c-secondary">€{{$Prezzo * $Quantita}}</span>
            </span>
        </div>
    </div>
</div>