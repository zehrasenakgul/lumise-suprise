<?php

?>

<div class="lumise_wrapper">
    <div class="lumise_content">
        <div class="search-page">
            <div class="row">
                <div class="mb-3 col-md-9 p-0">
                    <div class="row">
                        <div class="col-10">
                            <div class="input mb-3">
                                <input type="text" id="page_name" placeholder="Search Page" class="form-control">
                            </div>
                        </div>
                        <div class="col-2">
                            <div class="submit">
                                <button class="page_search_button btn btn-success">Search</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="page-items">
                <div class="row">
                </div>
            </div>
        </div>
        <div class="row w-100">
            <div class="card border-primary mb-3 col-md-9 p-0">

                <div class="card-header bg-primary text-white">Edit item</div>
                <div class="card-body">
                    <form id="pageLinksForm" class="form-horizontal">
                        <div class="form-group">
                            <label for="target">Section</label>
                            <select name="section" id="section" class="form-control item-menu">
                                <option value="Useful Links">Useful Links</option>
                                <option value="Customer Service">Customer Service</option>
                                <option value="My Account">My Account</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="text">Text</label>
                            <div class="input-group">
                                <input type="text" class="form-control item-name item-menu menu_text" name="text" id="text" placeholder="Text">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="href">URL</label>
                            <input type="text" class="form-control item-menu menu_url" id="href" name="href" placeholder="URL">
                            <input type="hidden" class="form-control item-menu menu_slug" id="slug" name="slug" placeholder="URL">
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
                    <button type="button" id="btnUpdatePageLinks" class="btn btn-primary" disabled><i class="fas fa-sync-alt"></i> Update</button>
                    <button type="button" id="btnAddPageLinks" class="btn btn-success"><i class="fas fa-plus"></i> Add</button>
                </div>
            </div>
            <ul id="myPageLinksEditor" class="sortableLists list-group col-md-3 p-0">
            </ul>
        </div>
        <div class="save-page-links">
            <span class="btn btn-success">Save Page Links</span>
        </div>
    </div>
</div>