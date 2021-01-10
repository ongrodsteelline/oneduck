@php
    {{
        /* @var $product \App\Modules\Woocommerce\Models\Product */
    }}
@endphp
<tr class="js-tr__wrap">
    <td class="table__img" data-toggle="modal" data-target="#Modal__img">
        <div>
            <img src="{{ $product->image['url'] }}" alt="">
            <span class="js-info info_error" data-toggle="tooltip" data-placement="right"
                  title="Проверьте кратность"></span>
            <span class="js-info info_success" data-toggle="tooltip" data-placement="right"
                  title="Успешно добавлено"></span>
        </div>
    </td>
    <td class="table__name">
        {{ $product->name }}
        <p><span>Бренд:</span> {{ $product->brand->name }}</p>
        <div>
            <div>Бренд:
                <p>{{ $product->brand->name }}</p>
            </div>
            <div>Арт.:
                <p>{{ $product->sku }}</p>
            </div>
            <div>Кратность:
                <p></p>
            </div>
            <div>Ед. изм.: <p>{{ $product->unit }}</p></div>
            <div class="table__scale {{ $product->getStockClass() }}">
                Наличие:
                <div></div>
            </div>
        </div>
    </td>
    <td class="table__article">{{ $product->sku }}</td>
    <td class="table__brend">{{ $product->brand->name }}</td>
    <td class="table__multiplicity js-multiplicity"></td>
    <td class="table__izmer">{{ $product->unit }}</td>
    <td class="table__scale {{ $product->getStockClass() }}">
        <div></div>
    </td>
    <td class="table__PPC">{{ $product->rrp }}</td>
    <td class="table__cena">
        <span>{{ $product->regularPrice }}</span>
    </td>
    <td class="table__basket">
        <span>0 р.</span>
        <div class="stepper stepper--style-1 js-spinner">
            <input autofocus type="number" min="0" step="1" value="0"
                   class="stepper__input js-stepper__input">
            <div class="stepper__controls">
                <button type="button" spinner-button="up">+</button>
                <button type="button" spinner-button="down">−</button>
            </div>
        </div>
    </td>
    <td class="table__mob js-table__mob show">
        <table>
            <tr>
                <td><span>Артикул:</span>
                    <p>{{ $product->sku }}</p></td>
                <td><span>Кратность:</span>
                    <p></p></td>
                <td><span>Ед.изм:</span>
                    <p>{{ $product->unit }}</p></td>
                <td><span>РРЦ:</span>
                    <p>{{ $product->rrp }}</p></td>
                <td class="table__scale {{ $product->getStockClass() }}">
                    <span>Наличие:</span>
                    <div></div>
                </td>
            </tr>
        </table>
        <span class="js-scroll__hands"><i class="ic-hands"></i></span>
    </td>
</tr>