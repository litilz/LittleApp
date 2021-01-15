<?php
require_once("../database/connection.php");
require_once("../database/curl_call.php");

if (!isset($_SESSION['id'])) {
    header('location:login.php');
}
$url = "$BaseURL/api/fetching.php/";
$content = json_encode(array('fetch' => 'category'), JSON_FORCE_OBJECT);
$response = curlcall($url, $content);

?>
<div>
    <section class="section">
        <div class="section-header">
            <h1>Category</h1>
        </div>
        <div class="section-body">
            <div id="productinfo" class="section-body">

                <div class="card">
                    <div class="card-header" style="display: block;">
                        <div class="form-group fa-pull-right">
                            <button type="button" class="btn btn-primary" style="border-radius:7px" data-toggle="modal" data-target="#categoriesmodel" id="addcategory">
                                Add
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        <div>
                            <div class="row">
                                <?php if ($response == '') { ?>
                                    <tr>
                                        <td colspan="3">No Categories To Display</td>
                                    </tr>
                                <?php   } else { ?>

                                    <?php foreach ($response as $row) { ?>

                                        <div class="col-lg-3 col-md-4 col-6">
                                            <div class="card">
                                                <img src="<?= @$row['image']; ?>" class="card-img-top" alt="" style="height:173px;width:auto;">
                                                <div class="card-body">
                                                    <div class="row">
                                                        <div class="col-md-8">
                                                            <h6 class="card-title"><?= @$row['category']; ?></h6>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <a onclick="getcategory('<?= @$row['id']; ?>','normal')" class="ml-3" id="categoryedit" href="javascript:void(0);">
                                                                edit
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                <?php   }
                                }
                                ?>

                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
<form id='categoriesform'>
    <div class="modal fade bd-example-modal-lg" id="categoriesmodel" tabindex="-1" role="dialog" aria-labelledby="categoriestitle" aria-hidden="true" data-keyboard="false" data-backdrop="static">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="categoriesmodeltitle">Category</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close" id="categoriesmodelclose1">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <input type="text" class="form-control" id="categorie" name="categorie" placeholder="categorie name">
                            </div>
                            <div class="form-group col-md-6">
                                <input type="text" class="form-control" id="image" name="image" placeholder="image url">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal" id="categoriesmodelclose2">Close</button>
                    <input type="hidden" id="categoryid" />
                    <button type="button" class="btn btn-primary" id="submitcategorie">Save</button>
                </div>
            </div>
        </div>
    </div>
</form>

<script>
    $(document).ready(function() {
        var validator = $("#categoriesform").validate({
            rules: {
                categorie: "required",
                image: "required"
            },
            messages: {
                categorie: "Please enter categorie",
                image: "Please enter image"
            }
        });

        $("#submitcategorie").click(function() {
            if ($("#categoriesform").valid()) {
                var id=$("#categoryid").val();
                categoryaction("normal",id);
            }

        });
        $("#addcategory").click(function() {
            $("#categoryid").val('');
        });


        $("#categoriesmodelclose1,#categoriesmodelclose2").click(function() {
            validator.resetForm();
            $('#categoriesform').find('input:text').val('');
        });
    })
</script>