<?php

?>

<div class="lumise_wrapper" id="lumise-<?php echo $section; ?>-page">
    <div class="lumise_content">
        <div class="search-category">
            <div class="row">
                <div class="input col-md-9">
                    <input type="text" id="category_name" placeholder="Kategori veya Ürün Arayınız" class="form-control">
                </div>
                <div class="submit">
                    <button class="category_search_button btn btn-success">Ara</button>
                </div>
            </div>
            <div class="category-items">
                <div class="row">
                    <div class="category-item col-md-3">
                        <div>
                            <span>Kategori Adı : </span>
                        </div>
                        <div>
                            <span>Kategori URL : </span>
                        </div>
                        <div>
                            <button class="add-item-to-menu btn btn-primary mt-2">Alanları Doldur</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row w-100">
            <div class="card border-primary mb-3 col-md-9 p-0">

                <div class="card-header bg-primary text-white">Edit item</div>
                <div class="card-body">
                    <form id="frmEdit" class="form-horizontal">
                        <div class="form-group">
                            <label for="text">Text</label>
                            <div class="input-group">
                                <input type="text" class="form-control item-name item-menu menu_text" name="text" id="text" placeholder="Text">
                                <div class="input-group-append">
                                    <button type="button" id="myEditor_icon" class="btn btn-outline-secondary"></button>
                                </div>
                            </div>
                            <input type="hidden" name="icon" class="item-menu">
                        </div>
                        <div class="form-group">
                            <label for="href">URL</label>
                            <input type="text" class="form-control item-menu menu_url" id="href" name="href" placeholder="URL">
                        </div>
                        <div class="form-group">
                            <label for="target">Target</label>
                            <select name="target" id="target" class="form-control item-menu">
                                <option value="_self">Self</option>
                                <option value="_blank">Blank</option>
                                <option value="_top">Top</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="title">Tooltip</label>
                            <input type="text" name="title" class="form-control item-menu menu_tooltip" id="title" placeholder="Tooltip">
                        </div>
                    </form>
                </div>
                <div class="card-footer">
                    <button type="button" id="btnUpdate" class="btn btn-primary" disabled><i class="fas fa-sync-alt"></i> Update</button>
                    <button type="button" id="btnAdd" class="btn btn-success"><i class="fas fa-plus"></i> Add</button>
                </div>
            </div>
            <ul id="myEditor" class="sortableLists list-group col-md-3 p-0">
            </ul>
        </div>
        <div class="save-menu">
            <span class="btn btn-success">Save Menu</span>
        </div>
    </div>
</div>