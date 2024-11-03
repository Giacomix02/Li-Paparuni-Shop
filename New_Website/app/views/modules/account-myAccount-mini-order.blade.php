<tr>
    <td>#{!! $IdOrdine !!}</td>
    <td>{!! $DataOrdine !!}</td>
    <td>
        <div >
            <label>{!! $StatoOrdine !!}</label>
        </div>
    </td>
    <td>
        <div class="dash__table-total">

            <span>{!! $Totale !!}€</span>
            <div class="dash__link dash__link--brand">

                <a href="<?=ROOT?>AccountManageOrder/{!! $IdOrdine !!}">MANAGE</a></div>
        </div>
    </td>
</tr>