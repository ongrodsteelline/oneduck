<div class="wrap">
    <h1>Импорт</h1>
    <form action="#" method="post" enctype="multipart/form-data">
        <input type="hidden" name="action" value="cf_import_product">
        <input type="file" name="file">
        <br>
        <button type="submit" class="button action">Импортировать товары</button>
    </form>
    <br/>
    <h1>Экспорт</h1>
    <form action="#" method="post" enctype="multipart/form-data">
        <input type="hidden" name="action" value="cf_export_product">
        <label>
            Количество
            <input type="number" name="limit" value="100">
        </label>
        <br/>
        <label>
            Смещение
            <input type="number" name="offset" value="0">
        </label>
        <br/>
        <button type="submit" class="button action">Экспортировать товары</button>
    </form>
</div>
