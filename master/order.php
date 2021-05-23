<?php
require_once("../database/connection.php");
require_once("../database/curl_call.php");

if (!isset($_SESSION['id'])) {
    header('location:login.php');
}
$url = "$BaseURL/api/fetching.php";
$content = json_encode(array('fetch' => 'allorders'), JSON_FORCE_OBJECT);
$response = curlcall($url, $content);


?>


<div>
    <section class="section">
        <div class="section-header">
            <h1>Grocery Orders</h1>

        </div>

        <div class="section-body">
            <div id="orders" class="section-body">
                <div class="card">
                    <div class="card-body">
                        <div class="card-body">

                            <div class="form-group fa-pull-left">
                                <input class="form-control py-2 bor" type="search" onkeyup="search('ordersearch','tblorders','0')" placeholder="search" id="ordersearch">
                            </div>
                            <table class="table" id="tblorders">
                                <thead>
                                    <tr>
                                        <th>Order Id</th>
                                        <th>User Id</th>
                                        <th>DeliveryBy</th>
                                        <th>Status</th>
                                        <th>Ordered Date</th>
                                    </tr>

                                </thead>
                                <tbody>
                                    <?php if ($response == '') { ?>
                                        <tr>
                                            <td colspan="5">No Orders To Display</td>
                                        </tr>
                                    <?php   } else { ?>
                                        <?php foreach ($response as $row) { ?>
                                            <tr>
                                                <td><a type="button" href="javascript:void(0)" name="<?= @$row['id']; ?>" value="<?= @$row['id']; ?>" id="vieworderedproduct" class="vieworderedproduct"><b><?= @$row['id']; ?></b></a></td>
                                                <td><?= @$row['phone']; ?></td>
                                                <td contenteditable="true" class="deliveryby" id="<?= @$row['id']; ?>" title="<?= @$row['deliveryby']; ?>">
                                                    <?= @$row['deliveryby']; ?>
                                                    <input type="hidden" id="prev_order_status_<?= @$row['id']; ?>" name="prev_order_status_" value="<?= @$row['status']; ?>">
                                                    <input type="hidden" id="order_id" name="order_id" value="<?php echo $row['id']; ?>"><label for="delivered"></label>
                                                </td>
                                                <td>
                                                    <select class="form-control" id="status_<?= @$row['id']; ?>" name="status" <?php if (@$row['status'] == "Cancelled" ||@$row['status'] == "Delivered" ) echo "disabled"; ?> onchange="updateorderStatus(<?= @$row['id']; ?>,this,'normal')">
                                                        <option value="">--select--</option>
                                                        <option style="color:#956f00;font-size:40px" value="Ordered" <?php if (@$row['status'] == "Ordered") echo "SELECTED"; ?>>Ordered</option>
                                                        <option style="color:#blue;font-size:40px" value="Inprogress" <?php if (@$row['status'] == "Inprogress") echo "SELECTED"; ?>>Inprogress</option>
                                                        <option style="color:#green;font-size:40px" value="Delivered" <?php if (@$row['status'] == "Delivered") echo "SELECTED"; ?>>Delivered</option>
                                                        <option style="color:red;font-size:40px" value="Cancelled" <?php if (@$row['status'] == "Cancelled") echo "SELECTED"; ?>>Cancelled</option>
                                                    </select>
                                                </td>
                                                <td><?= @$row['date_ordered']; ?></td>
                                            </tr>
                                    <?php   }
                                    } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <div class="modal fade bd-example-modal-lg" id="orderedproducts" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Ordered Products</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <table class="table" id="tblorderedproducts">
                        <thead>
                            <tr>
                                <th>Product Name</th>
                                <th>Quantity</th>
                                <th>Original Price</th>
                                <th>Selling Price</th>
                            </tr>
                        </thead>
                        <tbody>

                        </tbody>
                        <tfoot style="background-color: #e3eaef;">

                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
</div>

<script>
    $(document).ready(function() {
        var preText;
        $(".deliveryby").click(function(e) {
            preText='';
            preText = e.currentTarget.title;
        });

        $(".deliveryby").keydown(function(event) {
            if (13 == event.which) { // press ENTER-key
                var text = this.innerText;
                var id = this.id;
                var data = {
                    id: id,
                    name: text,
                }
                $.ajax({
                    url: BaseURL + "/api/orderactions.php",
                    method: "POST",
                    data: {
                        data: data,
                        action: "updatedeliveryby"
                    },
                    dataType: "json",
                    success: function(response) {
                        $.simplyToast(response, 'success');
                        pageload("master/order.php");
                    }
                });
                event.preventDefault();
                return false;
            } else if (27 == event.which) { // press ESC-key
                this.innerText= preText;
            }

        });
        $(".deliveryby").focusout(function(e) {
            e.currentTarget.innerText = preText;
        });
        $(".vieworderedproduct").click(function() {
           var id = this.name;
           vieworderedproducts(id);
       });
    });
</script>