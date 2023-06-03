<?php

?>

<div class="lumise_wrapper">
    <div class="lumise_content">
        <div class="row w-100 m-auto">
            <div class="card border-primary mb-3 col-md-9 p-0">
                <div class="card-header bg-primary text-white">Create Page</div>
                <div class="card-body">
                    <form id="editPage" class="form-horizontal">
                        <div class="form-group">
                            <label for="text">Title</label>
                            <div class="input-group">
                                <input type="text" class="form-control item-name item-menu menu_text" name="text" id="text" placeholder="Text">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="href">URL</label>
                            <input type="text" class="form-control item-menu menu_url" id="href" name="href" placeholder="URL">
                        </div>
                        <div class="form-group">
                            <label for="href">Content</label>
                            <textarea class="form-control item-menu menu_tooltip" name="content" id="" cols="30" rows="10"></textarea>
                        </div>
                    </form>
                </div>
                <div class="card-footer">
                    <button type="button" id="btnUpdatePage" class="btn btn-primary" disabled><i class="fas fa-sync-alt"></i> Update</button>
                    <button type="button" id="btnAddPage" class="btn btn-success"><i class="fas fa-plus"></i> Add</button>
                </div>
            </div>
            <ul id="myPagesEditor" class="sortableLists list-group col-md-3 p-0">
            </ul>
        </div>
        <div class="save-page">
            <span class="btn btn-success">Save Page</span>
        </div>
    </div>
</div>